<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
		/* if(!isset($_SESSION['logged']) || $this->session->logged == FALSE){
			$this->load->view('home');
		}
		else{
			//other session stuff here.
			redirect('home/profile/');
		} */
		$this->load->view('home');
	}
	
	public function profile()
	{
		$this->load->helper('form');
		
		if(!isset($_SESSION['logged']) || $_SESSION['logged'] == FALSE)
		{
			redirect('home/');
		}
		
		$this->load->model('betor_users');
		
		$user_info = $this->betor_users->get_user_info($_SESSION["username"]);
		$this->session->userid = $user_info["id"];
		$credit_info = $this->betor_users->get_user_credit($_SESSION["userid"]);
		$data["email"] = $user_info["email"];
		$data["fullname"] = $user_info["fullname"];
		$data["creation_date"] = $user_info["creation_date"];
		$data["avatar"] = $user_info["avatar"];
		$data["confirmed"] = $user_info["confirmed"];
		$data["last_login"] = $user_info["last_login"];
		$data["last_ip"] = $user_info["last_ip"];
		$data["balance"] = $credit_info["balance"];
		$data["expiry"] = $credit_info["expiry"];
		$data["last_trans_id"] = $credit_info["last_trans_id"];
		$data["acc_type"] = $this->betor_users->get_member_type($user_info["m_type"]);
		
		$this->load->view('profile', $data);
	}
	
	public function verify_account()
	{
		if($this->input->post('action') == "create")
		{
			$this->load->model('betor_users');
			$code = $this->_genCode();
			//save code in db
			$saved = $this->betor_users->create_email_code($this->session->userid, $code);
			if($saved)
			{
				//send email to user_error
				$this->load->library('email');

				$this->email->from('tips@betips.co.ke', 'Betips Kenya');
				$this->email->to($this->betor_users->get_user_email($this->session->userid));

				$this->email->subject('Betips.co.ke. Account Confirmation.');
				$text = 'Hi '.$_SESSION["username"].',\r\n';
				$text .= 'Your account verification code is: <b>'.$code.'</b>. Enter it to verify your account.\r\n';
				$text .= '<br />Kind Regards,\r\n<b>Betips.co.ke,</b> \r\nwww.betips.co.ke \r\nTerms and conditions apply.';
				$this->email->message($text);
				$this->email->reply_to('no-reply@betips.co.ke', 'No Reply Betips.co.ke');
				$this->email->send();
				
				$this->output->set_header('Content-Type: application/json');
				echo '{"success":1}';
			}
			else
			{
				$this->output->set_header('Content-Type: application/json');
				echo '{"success":0}';
			}
		}
		else if($this->input->post('action') == "check")
		{
			//verify code saved in db
			$this->load->model('betor_users');
			$code = sha1($this->input->post("code"));
			$code2 = $this->betor_users->get_email_code($this->session->userid);
			if($code == $code2)
			{
				//update account to confirmed
				$this->betor_users->confirm_user($this->session->userid);
				
				$this->output->set_header('Content-Type: application/json');
				echo '{"success":1}';
			}
			else{
				$this->output->set_header('Content-Type: application/json');
				echo '{"success":0}';
			}
		}
		else
		{
			$this->output->set_header('Content-Type: application/json');
			echo '{"success":0, "info":"request not defined on server!"}';
		}
	}
	
	public function _genCode(){
		$str = "1 2 3 4 5 6 7 8 9 0 a b c d e f g h k m n o p t";
		
		$temp = explode(" ", $str);
		$c1 = $temp[rand(1, 21)];
		$c2 = $temp[rand(1, 23)];
		$c3 = $temp[rand(1, 13)];
		$c4 = $temp[rand(1, 23)];
		$c5 = $temp[rand(1, 15)];
		$c6 = $temp[rand(1, 23)];
		
		$chars = $c1.$c2.$c3.$c4.$c5.$c6;
		
		return $chars;
	}
}
