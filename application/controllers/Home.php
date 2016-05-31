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
		
		$this->load->view('profile', $data);
	}
}
