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
				$this->session->logged = TRUE;
				$this->session->username = $logins["username"];
				$this->session->userid = $logins["id"];
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
}
