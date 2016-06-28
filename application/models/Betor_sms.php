<?php

Class Betor_sms extends CI_Model {
    
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
    
    //takes raw sms as input and returns array with items neccesary.
    public function get_msg_parts($sms){
        $mesgitems = array();
        
        $msgitems["raw_msg"] = $sms;
		$msgitems["t_code"] = substr($sms, 0, 10); //get transaction code.
		
		$pos = strpos($sms, "Ksh") + 3;
		$pos2 = strpos($sms, " from");
		$len = $pos2 - $pos;
		$amt = explode(",", substr($sms, $pos, $len));
		list($s1, $s2) = $amt;
		$amt = $s1.$s2;
		$msgitems["amount"] = (float) $amt; //get amount paid.
		
		$pos = strpos($sms, "from") + 5;
		$pos2 = strpos($sms, " 07");
		$len = $pos2 - $pos;
		$msgitems["sender_name"] = substr($sms, $pos, $len); //get name of payer.
		
		$pos = strpos($sms, " 07");
		$msgitems["sender_num"] = substr($sms, $pos + 1, 10); //get number of payer.
        
        return $msgitems;
	}
	
	public function add_sms($data)
	{
		if($this->db->insert("pending_sms", $data))
        {
            return TRUE;
        }
        else{
            return FALSE;
        }
	}
	
	/**
	*@ check duplicate sms func
	**/
	public function is_duplicate($code)
	{
		$query = $this->db->select("id")->where("t_code",$code)->get("payments");
		if($query->num_rows() > 0)
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
    
    //get SMS to send to clients.
    public function get_pending_sms()
    {
        $query = $this->db->select("id,phone,sms")->where("status","new")->limit(10)->get("pending_sms");
		if($query->num_rows() > 0)
		{
			return $query;
		}
		else{
			return FALSE;
		}
    }
	
	//update from phone on outgoing message status
	public function update_sms_status($id, $status)
	{
		$this->db->set("status", $status)->where("id",$id)->update("pending_sms");
	}
}
    