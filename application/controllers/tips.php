<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tips extends CI_Controller {

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
		if(!(isset($_SESSION["logged"]) && $_SESSION["logged"]))
		{
			redirect("home");
			exit(0);
		}
		//check user account type
		$this->load->model("betor_users");
		$cinfo = $this->betor_users->get_user_credit($_SESSION["userid"]);
		//save to session for later use;
		$this->session->m_type = $cinfo["m_type"];
		
		if($cinfo["m_type"] === 1) //free user
		{
			redirect("home");
			exit(0);
		}
		else if($cinfo["m_type"] === 2) //premium user
		{
			//do premium stuff
			
		}
		else if($cinfo["m_type"] === 3) //platinum user
		{
			//do platinum stuff
			
		}
		else{//default to free user
			redirect("home");
			exit(0);
		}
	}
	
	public function valuebets()
	{
	}
	
	public function underdogs()
	{
		
	}
	
	//default view
	public function premium()
	{
	}
	
	//free predictions displayed on home page.
	public function free()
	{
		//load model bets
		$this->load->model("betor_bets");
		$qres = $this->betor_bets->get_free_tips();
		$tips = $qres->result();
		if(count($tips) > 0)
		{
			$addcounter = 0;
			foreach ($tips as $tip ) {
				$addcounter ++;
				$saa = new DateTime($tip->matchdate);
				$saa = $saa->format("d-m, H:i");
				$outcome;
				if($tip->outcome == NULL || $tip->outcome == "")
				{
					$outcome = "";
				}
				else{
					$outcome = $tip->outcome == TRUE ? '<div class="win"></div>':'<div class="lose"></div>';
				}
				echo '<div class="listdiv" style="color:#000;">
							<ul class="match_list_ul">
								<li style="width:110px; padding-top:10px;">'.$saa.'</li>
								<li style="width:260px; text-decoration:underline;" class="padli"><a href="#" id="3"><span style="font-family: Verdana, Arial, Helvetica, sans-serif;">'.$tip->game.'</span></a></li>
								<li style="width:80px;" class="padli"><a href="#" id="3" style="font-weight:bold; font-size:9.5pt; color:#F7950C;">'.$tip->prediction.'</a></li>
								<li style="width:80px;" class="padli"><a href="#" id="3">'.$tip->weight.'</a></li>
								<li style="width:70px;" class="padli"><a href="#">'.$tip->home.'</a></li>
								<li style="width:70px;" class="padli"><a href="#">'.$tip->draw.'</a></li>
								<li style="width:70px;" class="padli"><a href="#">'.$tip->away.'</a></li>
								<li style="width:100px;" class="padli"><a href="#" id="3">'.$tip->result.'</a></li>
								<li style="width:60px;" class="padli"><a href="#" id="3">'.$outcome.'</a></li>
							</ul>
						</div>';
				if($addcounter == rand(3,8))
				{
					echo '<div style="color:#000; display:block; margin:0px; padding:0px; position:relative; left:-40px;">
                    	<ul style="width:960px; height:65px;">
                        	<img src="'.base_url().'assets/img/premium-anime.gif" style="border-bottom:1px solid #2cb5ff;" width="960" height="65" alt="premium-ad-betips.co.ke" />
                        </ul>
                    </div>';
				}
			}
		}
		else
		{
			echo "There are no predictions to display.";
		}		
	}//end of free()
	
	//get yesterdays free
	public function yesterday()
	{
		//load model bets
		$this->load->model("betor_bets");
		$qres = $this->betor_bets->get_yesterdays();
		$tips = $qres->result();
		if(count($tips) > 0)
		{
			foreach ($tips as $tip ) {
				$saa = new DateTime($tip->matchdate);
				$saa = $saa->format("d-m, H:i");
				$outcome;
				if($tip->outcome == NULL || $tip->outcome == "")
				{
					$outcome = "";
				}
				else{
					$outcome = $tip->outcome == TRUE ? '<div class="win"></div>':'<div class="lose"></div>';
				}
				echo '<div class="listdiv" style="color:#000;">
							<ul class="match_list_ul">
								<li style="width:110px; padding-top:10px;">'.$saa.'</li>
								<li style="width:260px; text-decoration:underline;" class="padli"><a href="#" id="3"><span style="font-family: Verdana, Arial, Helvetica, sans-serif;">'.$tip->game.'</span></a></li>
								<li style="width:80px;" class="padli"><a href="#" id="3" style="font-weight:bold; font-size:9.5pt; color:#F7950C;">'.$tip->prediction.'</a></li>
								<li style="width:80px;" class="padli"><a href="#" id="3">'.$tip->weight.'</a></li>
								<li style="width:70px;" class="padli"><a href="#">'.$tip->home.'</a></li>
								<li style="width:70px;" class="padli"><a href="#">'.$tip->draw.'</a></li>
								<li style="width:70px;" class="padli"><a href="#">'.$tip->away.'</a></li>
								<li style="width:100px;" class="padli"><a href="#" id="3">'.$tip->result.'</a></li>
								<li style="width:60px;" class="padli"><a href="#" id="3">'.$outcome.'</a></li>
							</ul>
						</div>';
			}
		}
		else
		{
			echo "Error: Failed to fetch yesterday's!";
		}		
	}//end of yesterday's free
}
