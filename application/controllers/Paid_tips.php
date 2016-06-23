<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paid_tips extends CI_Controller {

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
	}
		
	//fetches bets by type id
	public function getbets()
	{
		$type_id = $this->input->get("id");
		
		if(!isset($_SESSION['logged']) || $_SESSION['logged'] == FALSE)
		{
			die("You are not logged in!");
		}
		else
		{
			$prem = ($_SESSION["m_type"] == 2 || $_SESSION["m_type"] == 4);
			$plat = ($_SESSION["m_type"] == 3 || $_SESSION["m_type"] == 5);
			if(!($prem || $plat))
			{
				die("You are not a premium user.");
			}
			//check user credits if 0.0 or past expiry sent message asking user to top up
			$this->load->model("betor_users");
			$cinfo = $this->betor_users->get_user_credit($_SESSION["userid"]);
			//dates init 
			$now = new DateTime(date('Y-m-d H:i:s', time()));
			$expiry = new DateTime($cinfo["expiry"]);
			
			$NE = ($expiry > $now);//credits not expired
			$HC = ($cinfo["balance"] > 0);//has more than 0 credits.
			
			if($NE && $HC)
			{
				$this->load->model("betor_pt");
				$SBs = $this->betor_pt->get_bets($type_id);
				//if empty die 
				if($SBs === FALSE){ die("<tr><td colspan='8' style='color:red; font-weight:bold;'>There are no sure bets added currently. Check again later.</td></tr>"); }
				
				$response = '';
				foreach($SBs->result() as $sb)
				{
					$saa = new DateTime($sb->matchdate);
					$saa = $saa->format("d-m, H:m");
					//$response .= '<tr class="data-tr"><td>'.$sb->id.'</td><td>'.$saa.'</td><td>'.$sb->country.'</td><td>'.$sb->league.'</td><td><b>'.$sb->game.'</b></td><td>'.$sb->weight.'</td><td title="Click view tip to see odds.">Redeem</td><td id="tip-td'.$sb->id.'"><a class="tip-anchor" //href="#" onclick="showTip(\''.$sb->id.'\', event);">View Tip</a></td></tr>';
					$response .= '<tr class="data-tr"><td>'.$sb->id.'</td><td>'.$saa.'</td><td>'.$sb->country.'</td><td>'.$sb->league.'</td><td><b>'.$sb->game.'</b></td><td>'.$sb->weight.'</td><td title="Click view tip to see odds.">Redeem</td><td id="tip-td'.$sb->id.'"><input type="button" value="View Tip" onclick="showTip(\''.$sb->id.'\', event);" /></td></tr>';
				}
				echo $response;
				exit(0);
			}
			else
			{
				die("<tr><td colspan='8' style='color:red; font-weight:bold;'>You have insufficient tips in your account to view these tips.</td></tr>");
			}
		}
	}
}
