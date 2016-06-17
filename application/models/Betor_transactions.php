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
            return TRUE;
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
}