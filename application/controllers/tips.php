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
		$this->load->view('home');
	}
	
	public function valuebets()
	{
		//check session and see if user is enrolled in premium/platinum
		//if free user display value bets with no tips
	}
	
	public function underdogs()
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
			foreach ($tips as $tip ) {
				$saa = new DateTime($tip->matchdate);
				$saa = $saa->format("m-d H:i");
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
								<li style="width:30px;" class="padli"><a href="#" id="3">'.$outcome.'</a></li>
							</ul>
						</div>';
			}
		}
		else
		{
			echo "There are no predictions to display.";
		}		
	}
}
