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
	
	public function Premium()
	{
		echo "Not yet!";
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
	
	public function setResults()
	{
		//fetch from predictions
		//fetch from value bets
		//fetch from underdogs, draws(where predic is X) etc
		//check session first
		if(!isset($_SESSION['adlogged']) || $_SESSION['adlogged'] == FALSE)
		{
			redirect('admin/');
		}
		if($this->input->post("setres") !== null)
		{
			$this->load->model("betor_admin_funcs");
			
			$set = $this->betor_admin_funcs->set_score($this->input->post("id"), $this->input->post("result"));
			
			if($set)
			{
				$this->output->set_header('Content-Type: application/json');
				echo '{"success":"1"}';
			}
			else
			{
				$this->output->set_header('Content-Type: application/json');
				echo '{"success":"0"}';
			}
		}
		else
		{
			$this->load->model("betor_bets");
			$matches = $this->betor_bets->fetch_unresulted();
			$html = "";
			if(count($matches) < 1)
			{
				$html .= "<li>No games to load</li>";
			}
			else
			{
				foreach($matches as $match)
				{
					$html.='<li id="lig'.$match->id.'" style="margin-bottom:5px; padding-bottom:3px; border-bottom:1px solid #CCCCCC; width:350px; display:block;"><span style="margin-right:15px; font-size:13px;">'.$match->game.'</span><input type="text" id="sg'.$match->id.'" style="width:50px; margin-right:15px;" placeholder="0-0" value=""><input type="button" value="set" onclick="setResult(\''.$match->id.'\');"></li>';
				}
			}
			$data["html"] = $html;
			$this->load->view("set_results", $data);
		}
	}
	
	public function addPaidTips()
	{
		//check session first
		if(!isset($_SESSION['adlogged']) || $_SESSION['adlogged'] == FALSE)
		{
			redirect('admin/');
		}
		
		if($this->input->post("addtip") !== NULL)
		{
			$tips = json_decode($this->input->post("data"));
			//var_dump($tips[0]->match."1");
			$this->load->model("betor_pt");
			$added = FALSE;
			for($i = 0; $i < count($tips); $i++)
			{
				if($tips[$i]->match !== ""){
					$tip = array(
						"matchdate" => $tips[$i]->matchdate,
						"game" => $tips[$i]->match,
						"prediction" => $tips[$i]->prediction,
						"weight" => $tips[$i]->weight,
						"odds" => $tips[$i]->odds,
						"country" => $tips[$i]->country,
						"league" => $tips[$i]->league,
						"tip_type" => $tips[$i]->tip_type
						);
					$added = $this->betor_pt->add_tip($tip);
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
			//get tip types
			$data["options"] = '';
			$this->load->model("betor_pt");
			$types = $this->betor_pt->get_tip_types();
			foreach($types->result() as $type)
			{
				$data["options"] .= '<option value="'.$type->id.'">'.$type->name.'</option>';
			}
			$this->load->view("add_paid_tip", $data);
		}
	}
	
	public function listUsers()
	{
		//check session first
		if(!isset($_SESSION['adlogged']) || $_SESSION['adlogged'] == FALSE)
		{
			redirect('admin/');
		}
		//list all users and another list users created today.
		$this->load->model("betor_admin_funcs");
		
		$users = $this->betor_admin_funcs->get_all_users();
		$table = '';
		foreach($users->result() as $user)
		{
			$time = new DateTime($user->last_login);
			$time = $time->format("d-m H:m");
			$table .= '<tr><td style="padding:0px 0px 0px 5px; text-align:left;"><input type="checkbox" style="margin-right:5px;" /><span style="width:110px; position: relative;">'.$user->username.'</span></td><td>'.$user->fullname.'</td><td>'.$user->phone.'</td><td>'.$user->email.'</td><td>'.($user->confirmed == true ? "Confirmed":"Not Confirmed").'</td><td>'.$time.'</td><td>'.$user->name.'</td><td> - </td></tr>';
		}
		$this->load->view("all_users", array("html"=>$table));
	}
}
