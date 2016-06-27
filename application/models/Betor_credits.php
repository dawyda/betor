<?php

Class Betor_credits extends CI_Model {
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
    
	/**
	*@ gets user credit info;
	**/
    public function get_user_credit($user_id)
    {
        $this->db->select('balance, expiry, last_trans_id');
        $this->db->from('credits');
        $this->db->where('user_id',$user_id);
        $query = $this->db->get();
        return $row = $query->row_array();
    }
	
	//deduct user credit balance.
	public function redeem_user_credit($user_id, $trans_id)
	{
		$this->db->set("balance", "balance - 1", FALSE);
		$this->db->set("last_trans_id", $trans_id);
		$this->db->where("user_id", $user_id);
		$this->db->update("credits");
		return TRUE;
	}
	
	//topup user credits after payment received
	public function topup($user_id, $credits, $trans_id)
	{
		//and also expiry
		$query = $this->db->select("balance")->where("user_id", $user_id)->get("credits");
		$bal = $query->row();
		$bal = $bal->balance;
		$bal += $credits;
		$this->db->set("balance", $bal, FALSE);
		$this->db->set("expiry","DATE_ADD(NOW(), INTERVAL 31 DAY)",FALSE);
		$this->db->set("last_trans_id", $trans_id);
		$this->db->where("user_id", $user_id);
		$this->db->update("credits");
	}
}