<?php

Class Betor_pt extends CI_Model {
    
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
    
	public function get_bets($tip_type)
	{
		//surebets id is 9;
		$this->db->select("*")->where("tip_type", $tip_type)->where("matchdate >=", "DATE_ADD(NOW(), INTERVAL 30 DAY_MINUTE)", FALSE)->where("matchdate <=", "DATE_ADD(NOW(), INTERVAL 11 DAY_HOUR)", FALSE);
		$query = $this->db->get("prem_tips");
		if($query->num_rows() > 0){
			return $query;
		}
		else{
			return FALSE;
		}
	}
	
	public function get_redeemed($user_id)
	{
		$query = $this->db->query("SELECT r.date_redeemed,p.matchdate,p.game,t.name, p.prediction,p.weight,p.odds,p.result FROM prem_tips as p INNER JOIN redeemed_tips as r ON p.id = r.tip_id INNER JOIN tip_types t ON p.tip_type = t.id WHERE r.user_id = ".$user_id);
		if($query->num_rows() > 0)
		{
			return $query;
		}
		return false;
	}
	
	public function get_tip_types()
	{
		$query = $this->db->select("id,name")->get("tip_types");
		return $query;
	}
	
	public function add_tip($tip)
	{
		$tip["matchdate"] = "2016-".$tip["matchdate"].":00";
		if($this->db->insert("prem_tips",$tip))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	public function check_already_viewed($userid, $tipid)
	{
		$query = $this->db->select("id")->where("user_id", $userid)->where("tip_id", $tipid)->get("redeemed_tips");
		if($query->num_rows() > 0)
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	public function redeem_tip($tipid, $userid, $flag)
	{
		$query = $this->db->select("prediction, odds")->where("id",$tipid)->get("prem_tips");
		if($query->num_rows() > 0)
		{
			//add to redeemed
			if(!$flag){
				$this->db->insert("redeemed_tips",array("user_id" => $userid, "tip_id" => $tipid));
			}
			return $query->row();
		}
		else
		{
			return NULL;
		}
	}
}
    