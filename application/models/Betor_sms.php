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
		$msgitems["t_code"] = substr($this->text, 0, 9); //get transaction code.
		
		$pos = strpos($this->text, "Ksh") + 3;
		$pos2 = strpos($this->text, " from");
		$len = $pos2 - $pos;
		$amt = explode(",", substr($this->text, $pos, $len));
		list($s1, $s2) = $amt;
		$amt = $s1.$s2;
		$msgitems["amount"] = (float) $amt; //get amount paid.
		
		$pos = strpos($this->text, "from") + 5;
		$pos2 = strpos($this->text, " 07");
		$len = $pos2 - $pos;
		$msgitems["sender_name"] = substr($this->text, $pos, $len); //get name of payer.
		
		$pos = strpos($this->text, " 07");
		$msgitems["sender_num"] = "+".substr($this->text, $pos, 12); //get number of payer.
        
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
    
    //get SMS to send to clients.
    public function get_pending_sms()
    {
        $query = $this->db->select("id,phone,sms")->where("status","new")->limit(10);->get("pending_sms");
        return $query;
    }
	
	//update from phone on outgoing message status
	public function update_sms_status($id, $status)
	{
		$this->db->set("status", $status)->where("id",$id)->update("pending_sms");
	}
}
    