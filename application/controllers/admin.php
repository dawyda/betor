<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

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
		$this->load->library("session");
	}
	
	public function index()
	{
		if(!isset($_SESSION['adlogged']) || $_SESSION['adlogged'] == FALSE)
		{
			$this->load->helper("captcha");
			$this->load->helper('form');
			$vals = array(
				'word' => $this->_rand_word(),
			'img_path' => 'assets/img/captchas/',
			'img_url' => base_url().'assets/img/captchas',
			'id' => 'cap_img',
			);
			
			/* Generate the captcha */
			$captcha = create_captcha($vals);
			
			/* Store the captcha value (or 'word') in a session to retrieve later */
			$this->session->set_userdata('captchaWord', strtolower($captcha['word']));
			$this->session->set_userdata('accessed_index', TRUE);
			
			$this->load->view('admin_login', $captcha);
		}
		else
		{
			redirect("admin/home/");
		}
	}
	
	public function login()
	{
		if(!isset($_SESSION["accessed_index"]) || !$_SESSION["accessed_index"]){
			 redirect(base_url().'admin');
			 exit(0); 
		}
		if(($this->input->post('captcha') !== null) && $this->captcha_check(strtolower($this->input->post('captcha')))){
			$logins["username"] = $this->input->post('username');
			$logins["password"] = $this->input->post('password');
			
			$this->load->model("betor_admin");
			if($this->betor_admin->login($logins))
			{
				//set admin session data and redirect to admin home admin/home/
				$this->session->admin_username = $logins["username"];
				$this->session->adlogged = TRUE;
				$this->session->last_login = date("Y-m-d H:i:s", time());
				$this->session->last_ip = $this->input->ip_address();
				
				//redirect to admin home
				redirect(base_url()."admin/home/");
			}
			else{
				$this->load->helper("captcha");
				$vals = array(
					'word' => $this->_rand_word(),
				'img_path' => 'assets/img/captchas/',
				'img_url' => base_url().'assets/img/captchas',
				'id' => 'cap_img',
				);
        
				/* Generate the captcha */
				$captcha = create_captcha($vals);
		
				/* Store the captcha value (or 'word') in a session to retrieve later */
				$this->session->set_userdata('captchaWord', strtolower($captcha['word']));
				$this->session->set_userdata('accessed_index', TRUE);
		
				$this->load->helper('form');
				$this->load->view("admin_login", array("login_errors" => "Wrong username or password!", "image" => $captcha["image"]));
			}
		}
		else{
			//no captcha
			$this->load->helper("captcha");
			$vals = array(
				'word' => $this->_rand_word(),
			'img_path' => 'assets/img/captchas/',
			'img_url' => base_url().'assets/img/captchas',
			'id' => 'cap_img',
			);
	
			/* Generate the captcha */
			$captcha = create_captcha($vals);
	
			/* Store the captcha value (or 'word') in a session to retrieve later */
			$this->session->set_userdata('captchaWord', strtolower($captcha['word']));
			$this->session->set_userdata('accessed_index', TRUE); 
			$this->load->helper('form');
			$this->load->view("admin_login", array("login_errors" => "Captcha inavlid/not set!", "image" => $captcha["image"]));
		}
	}
	
	public function home()
	{
		//admin home page load here
		if(!isset($_SESSION['adlogged']) || $_SESSION['adlogged'] == FALSE)
		{
			redirect('admin/');
		}
		
		$this->load->model("betor_admin");
		$admin_info = $this->betor_admin->get_admin_info($this->session->admin_username);
		$this->session->admin_id = $admin_info["id"];
		$this->session->admin_email = $admin_info["email"];
		
		$this->load->view("admin_home");
	}
	
	public function logout()
	{
		if(!isset($_SESSION["adlogged"]) || !$_SESSION["adlogged"])
		{
			redirect(base_url()."admin");
		}
		else{
			//update last login and ip
			$this->load->model("betor_admin");
			$this->betor_admin->set_last_login($this->session->last_login, $_SESSION["admin_id"], $_SESSION["last_ip"]);
			unset(
				$_SESSION["adlogged"],
				$_SESSION["admin_id"],
				$_SESSION["admin_username"],
				$_SESSION["admin_email"],
				$_SESSION["last_login"],
				$_SESSION["last_ip"]
			);
			redirect(base_url()."admin");
		}
	}
	
	public function captcha_check($str)
	{
		if ($str == $this->session->captchaWord)
		{
			unset($_SESSION['captchaWord']);
			return TRUE;
		}
		else {
			unset($_SESSION['captchaWord']);
			return FALSE;
		}
	}
	
	public function _rand_word()
	{
		$word = array_merge(range('a', 'z'), range('A', 'Z'), range(1,9));
		shuffle($word);
		return substr(implode($word), 0, 6);
	}
}
