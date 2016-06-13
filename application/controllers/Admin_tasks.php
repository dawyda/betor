<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_tasks extends CI_Controller {

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
		redirect(base_url()."admin");
	}
	
	public function addFreeTips()
	{
		//check session first
		if(!isset($_SESSION['adlogged']) || $_SESSION['adlogged'] == FALSE)
		{
			redirect('admin/');
		}
		if($this->input->post("addtip") !== null)
		{
			$tips = json_decode($this->input->post("data"));
			//var_dump($tips[0]->match."1");
			$this->load->model("betor_admin_funcs");
			$added = FALSE;
			for($i = 0; $i < count($tips); $i++)
			{
				if($tips[$i]->match !== ""){
					$tip = array(
						"matchdate" => $tips[$i]->matchdate,
						"game" => $tips[$i]->match,
						"prediction" => $tips[$i]->prediction,
						"weight" => $tips[$i]->weight,
						"home" => $tips[$i]->home,
						"draw" => $tips[$i]->draw,
						"away" => $tips[$i]->away
						);
					$added = $this->betor_admin_funcs->add_free_tip($tip);
				}
			}
			if($added)
			{
				$this->output->set_header('Content-Type: application/json');
				echo '{"success":"1"}';
			}
			else{
				$this->output->set_header('Content-Type: application/json');
				echo '{"success":"0"}';
			}
		}
		else{
			$this->load->view("add_free_tip");
		}		
	}
}
