<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Security extends CI_Controller {

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
		redirect('home');
	}
	
	//change password. 
	public function changepwd(){
		if($this->session->logged !== NULL || $this->session->logged){
			if($this->input->post('action') !== NULL)
			{
				$userid = $this->session->userid;
				$old_pass = $this->input->post("oldpass");
				$pass = $this->input->post("password");
				$pass2 = $this->input->post("password2");
				
				//load model
				$this->load->model("betor_users");
				
				//compare new passwords
				if(($pass == $pass2) && (strlen($pass) > 5))
				{
					//check old pass then update else reject.
					$info = $this->betor_users->get_user_info($_SESSION["username"]);
					$old_pass = sha1($old_pass.$info["creation_date"]);
					if($old_pass === $info["password"])
					{
						//update password
						$this->betor_users->update_user_pwd($userid, $pass);
						
						echo '1';
					}
					else
					{
						echo '0';
					}
				}
				else
				{
					echo '-1';
				}
			}
			else
			{
				//load passwd change view
				$this->load->view('pwdchange');
			}
		}
		else
		{
			redirect('home');
		}
	}
	//end change password;
}
