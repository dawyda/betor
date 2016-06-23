<?php

Class Betor_pt extends CI_Model {
    
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
    
	public function get_bets($tip_type)
	{
		//surebets id is 9;
		$this->db->select("*")->where("tip_type", $tip_type)->where("matchdate >=", "DATE_ADD(NOW(), INTERVAL 30 DAY_MINUTE)", FALSE)->where("matchdate <=", "DATE_ADD(NOW(), INTERVAL 8 DAY_HOUR)", FALSE);
		$query = $this->db->get("prem_tips");
		if($query->num_rows() > 0){
			return $query;
		}
		else{
			return FALSE;
		}
	}
}
    