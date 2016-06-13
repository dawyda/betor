<?php

Class Betor_admin_funcs extends CI_Model {
    
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
	
	public function add_free_tip($tip)
	{
		$tip["matchdate"] = "2016-".$tip["matchdate"].":00";
		if($this->db->insert("predictions",$tip))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
}
    