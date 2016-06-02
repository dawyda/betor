<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {

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
		if(!isset($_SESSION['logged']) || $_SESSION['logged'] == FALSE)
		{
			redirect('home/');
		}
		else{
			//update last login
			$this->load->model("betor_users");
			$this->betor_users->set_last_login($this->session->logged_time, $_SESSION["userid"]);
			//unset session data
			unset($_SESSION['logged'],
				$_SESSION['username'],
				$_SESSION['userid'],
				$_SESSION["logged_time"]
			);
			redirect('home/');
		}
	}
}
