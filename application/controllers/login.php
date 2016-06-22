<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
	}
	
	public function index()
	{
		$this->load->helper('form');
		$this->load->view('home');
	}
	
	public function auth()
	{
		$logins["username"] = trim($this->input->post('username'));
		$logins["password"] = trim($this->input->post('password'));
		$this->load->helper('form');
		if(strlen($logins['username']) > 3 && strlen($logins['password']) > 3)
		{
			$this->load->model('betor_users');
			$pass = $this->betor_users->login($logins);
			if($pass){
				$this->session->logged_time = date("Y-m-d H:i:s", time());
				$this->session->user_ip = $this->input->ip_address();
				$this->session->logged = TRUE;
				$this->session->username = $logins["username"];
				redirect('home/profile/');
			}
			else{
				$data['disp_msg'] = 'Wrong logins! Try again or '.anchor('login/pswdreset','&nbsp;Reset Password?','style="text-decoration:none; color:#42f4ff;"');
				$this->load->view('home',$data);
			}
		}
		else{
			$data['disp_msg'] = "user/password too short!";
			$this->load->view('home',$data);
		}
	}
	
	//resetting user password
	public function pswdreset()
	{
		if($this->input->post('action') == "create")
		{
			$phone = $this->input->post('phone');
			$this->load->model('betor_users');
			$info = $this->betor_users->get_user_from_num($phone);
			if($info !== NULL)
			{
				//create code save in session send in sms
				$code = $this->_genCode();
				$sms = "Dear user, Use the following code to reset your password: ".$code;
				$this->session->reset_code = $code;
				$this->session->userid = $info["id"];
				$this->load->model('betor_sms');
				$this->betor_sms->add_sms(array("phone"=>$info["phone"], "sms"=>$sms));
				
				$this->output->set_header("Content-Type: application/json");
				echo '{"success":"1"}';
			}
			else
			{
				$this->output->set_header("Content-Type: application/json");
				echo '{"success":"0", "msg":"Phone not found in catalog!"}';
			}
		}
		else if($this->input->post('action') == "validate")
		{
			if($this->input->post('code') == NULL || $this->session->reset_code == NULL)
			{
				echo "Missing form vars & session!";
				exit(0);
			}
			$code = $this->input->post('code');
			if($code == $this->session->reset_code)
			{
				$this->session->code_entered = TRUE;
				unset($this->session->reset_code);
				$this->output->set_header("Content-Type: application/json");
				echo '{"success":"1"}';
			}
			else
			{
				$this->session->code_entered = FALSE;
				$this->output->set_header("Content-Type: application/json");
				echo '{"success":"0", "msg":"Invalid code entered!"}';
			}
		}
		else if($this->input->post('action') == "update")
		{
			//security first
			if($this->session->userid == NULL || $this->session->code_entered == NULL || $this->session->code_entered == FALSE)
			{
				$this->output->set_header("Content-Type: application/json");
				echo '{"success":"-1", "msg":"Password reset session not found!"}';
				exit(0);
			}
			unset($this->session->code_entered);
			//update pwd
			$passwd = $this->input->post('password');
			$passwd2 = $this->input->post('password2');
			if($passwd == $passwd2 && $passwd !== "")
			{
				$this->load->model("betor_users");
				$changed = $this->betor_users->update_user_pwd($this->session->userid, $passwd);
				if($changed){
					unset($this->session->userid);
					$this->output->set_header("Content-Type: application/json");
					echo '{"success":"1", "msg":"OK"}';
				}
				else
				{
					unset($this->session->userid);
					$this->output->set_header("Content-Type: application/json");
					echo '{"success":"0", "msg":"Password update failed!"}';
				}
			}
			else
			{
				$this->output->set_header("Content-Type: application/json");
				echo '{"success":"0", "msg":"Passwords do not match!"}';
			}
		}
		else
		{
			//display pwd reset page.
			$this->load->view('pswdreset');
		}
	} // password reset ends here.
	
	private function _genCode(){
		$str = "1 2 3 4 6 7 8 9 a b c d e f g h k m n P t";
		
		$temp = explode(" ", $str);
		$c1 = $temp[rand(1, 20)];
		$c2 = $temp[rand(1, 11)];
		$c3 = $temp[rand(1, 13)];
		$c4 = $temp[rand(1, 20)];
		$c5 = $temp[rand(1, 18)];
		$c6 = $temp[rand(1, 20)];
		
		$chars = $c1.$c2.$c3.$c4.$c5.$c6;
		
		return strtolower($chars);
	}
}
