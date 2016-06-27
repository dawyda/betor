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
	
	//redeems premtip by id 
	public function redeem()
	{
		if(!isset($_SESSION['logged']) || $_SESSION['logged'] == FALSE)
		{
			die("You are not logged in!");
		}
		else{
			if($this->input->post("action") == NULL)
			{
				redirect("home");
			}
			$this->load->model("betor_users");
			$cinfo = $this->betor_users->get_user_credit($_SESSION["userid"]);
			//dates init 
			$now = new DateTime(date('Y-m-d H:i:s', time()));
			$expiry = new DateTime($cinfo["expiry"]);
			
			$NE = ($expiry > $now);//credits not expired
			$HC = ($cinfo["balance"] > 0);//has more than 0 credits.
			
			if($NE && $HC)
			{
				$tipid = $this->input->post("tipid");
				if($tipid == null)
				{
					die('{"success":0, "msg":"tip not set."}');
				}
				$this->load->model("betor_pt");
				$already_viewed = $this->betor_pt->check_already_viewed($_SESSION["userid"], $tipid);
				$tip = $this->betor_pt->redeem_tip($tipid, $_SESSION["userid"], $already_viewed);
				if($tip !== NULL){
					//deduct user bal and set trans
					//check first if earlier redeemed.
					if(!$already_viewed){
						$this->load->model("betor_transactions");
						$trans_id = $this->betor_transactions->record_transaction(array("username"=>$_SESSION["username"], "narrative"=>"You redeemed 1 tip for tipid: ".$tipid, "tips"=>1, "trans_type"=>"redeem"));
						
						$this->load->model("betor_credits");
						$this->betor_credits->redeem_user_credit($_SESSION["userid"], $trans_id);
					}
					
					$this->output->set_header("Content-Type: application/json");
					echo '{"success":1, "tip":"'.$tip->prediction.' ('.$this->get_tip_name($tip->prediction).')","odds":"'.$tip->odds.'"}';
				}
				else{
					$this->output->set_header("Content-Type: application/json");
					echo '{"success":0, "msg":"Tip not found. Contact support."}';
				}
			}
			else{
				$this->output->set_header("Content-Type: application/json");
				echo '{"success":0, "msg":"Insufficient tips or past due date. Top-up."}';
			}
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
					$response .= '<tr class="data-tr"><td>'.$sb->id.'</td><td>'.$saa.'</td><td>'.$sb->country.'</td><td>'.$sb->league.'</td><td><b>'.$sb->game.'</b></td><td>'.$sb->weight.'</td><td id="odd'.$sb->id.'" title="Click view tip to see odds.">Redeem</td><td id="tip-td'.$sb->id.'"><input type="button" value="View Tip" onclick="showTip(\''.$sb->id.'\', event);" /></td></tr>';
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
	
	private function get_tip_name($tip)
	{
		switch ($tip) {
			case '1':
				return "Home win";
				break;
			case 'GG':
				return "BTTS yes";
				break;
			case 'NG':
				return "BTTS no";
				break;
			case '2':
				return "Away win";
				break;
			case 'X':
				return "Draw";
				break;
			case '1X':
				return "DC-Home/Draw";
				break;
			case 'X2':
				return "DC-Draw/Away";
				break;
			case '12':
				return "DC-Home/Away";
				break;
			case 'Ov2.5':
				return "Over 2.5 Goals";
				break;
			case 'Un2.5':
				return "Under 2.5 Goals";
				break;
			default:
				return "";
				break;
		}
	}
}
