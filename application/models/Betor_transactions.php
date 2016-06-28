<?php

Class Betor_transactions extends CI_Model {
    
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
	
	public function record_transaction($data)
	{
		if($this->db->insert("transactions", $data))
        {
            return $this->db->insert_id();
        }
        else{
            return FALSE;
        }
	}
	
	//save to payments table
    public function save_payment($data)
    {
       if($this->db->insert("payments", $data))
        {
            return TRUE;
        }
        else{
            return FALSE;
        }
    }
    
    //save mismatched pays
    public function add_mismatched($data)
    {
        if($this->db->insert("mismatched_pays", $data))
        {
            return TRUE;
        }
        else{
            return FALSE;
        }
    }
}