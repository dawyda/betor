<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signup extends CI_Controller {

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
    
		/* Load the libraries and helpers */
		$this->load->library("session");
		$this->load->helper(array('form','captcha'));
    }
	public function index()
	{
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
		$this->load->view('signup', $captcha);
	}
	
	public function adduser()
	{
		$this->load->library('form_validation');
		//form data validation first
		$this->form_validation->set_rules('fname', 'Fullname', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required|min_length[6]|max_length[10]');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('pass2', 'Password Confirmation', 'required|matches[password]');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('mobile', 'Phone', 'required');
		$this->form_validation->set_rules('captcha', 'Captcha', 'required|callback_captcha_check',
			array('callback_captcha_check' => 'You entered the wrong captcha.')); //captcha_check() validates the capture
		
		if($this->form_validation->run() == FALSE)
		{		
			$vals = array(
			'word' => $this->_rand_word(),
			'img_path' => 'assets/img/',
			'img_url' => base_url().'assets/img/',
			'id' => 'cap_img',
			);
			
			/* Generate the captcha */
			$captcha = create_captcha($vals);
			
			/* Store the captcha value (or 'word') in a session to retrieve later */
			$this->session->set_userdata('captchaWord', strtolower($captcha['word']));
			$this->load->view('signup', $captcha);
		}
		else{
			$newuser["username"] = $this->input->post('username');
			$newuser["password"] = $this->input->post('password');
			$newuser["phone"] = $this->input->post('mobile');
			$newuser["email"] = $this->input->post('email');
			$newuser["fullname"] = $this->input->post('fname');
			
			$this->load->model("betor_users");
			
			if($this->betor_users->add_new_user($newuser))
			{
				//user add success...take him to login page with message of successfull login.
				$this->load->view('home', array('disp_msg'=>"Account created."));
			}
			else{
				echo "Oops! Betips.co.ke failed to create your user account. <a href='".base_url()."signup'>Retry</a> again.";
			}
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
			return FALSE;
		}
	}
	
	public function _rand_word()
	{
		$word = array_merge(range('a', 'z'), range('A', 'Z'));
		shuffle($word);
		return substr(implode($word), 0, 6);
	}
}
