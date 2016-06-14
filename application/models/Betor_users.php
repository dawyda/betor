<?php

Class Betor_Users extends CI_Model {
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
    
    public function login($data)
    {
        //fetch date_created first then hash with sha1
        $query = $this->db->select('creation_date')->where('username',$data['username'])->get('users');
        $row = $query->row();
        if(isset($row->creation_date)){
            //echo $row->creation_date;
            $password = sha1($data["password"].$row->creation_date);
            //echo $password;
            $data["password"] = $password;
            $query = $this->db->select('id')->where($data)->get('users');
            if($query->num_rows() > 0){
                // user exists
                
                return TRUE;
            }
            else{
                return FALSE;
            }
        }
        else{ return FALSE; }
    }
    
    public function get_user_email($userid)
    {
        $query = $this->db->select("email")->where("id",$userid)->get("users");
        $row = $query->row();
        return $row->email;
    }
    
    //email verification code saved to db
    public function create_email_code($userid, $code)
    {
        $data["user_id"] = $userid;
        $data["code"] = sha1($code);
        $this->db->set('expiry', 'DATE_ADD(NOW(), INTERVAL 5 DAY)', FALSE);
        $success = $this->db->insert("pending_codes", $data);
        return $success;
    }
    
    public function get_email_code($userid)
    {
        $query = $this->db->select("code")->where("user_id",$userid)->get("pending_codes");
        $row = $query->row();
        return $row->code;
    }
    
    /**
    * @ confirm user...set confirmed = 1
    */
    public function confirm_user($userid)
    {
        $data["confirmed"] = TRUE;
        $this->db->where("id", $userid);
        $this->db->update("users", $data);
        
        //delete row from pending codes
        $this->db->where("user_id", $userid);
        $this->db->delete("pending_codes");
    }
	
	public function set_last_login($time,$userid,$ip)
	{
        $data = array(
        'last_login' => $time,
        'last_ip' => $ip
        );
		$this->db->where('id', $userid);
		$this->db->update('users', $data);
	}
    
    public function get_user_info($username){
        $query = $this->db->select('*')->where('username', $username)->get('users');
        return $row = $query->row_array();
    }
    
    public function get_user_credit($user_id)
    {
        $this->db->select('balance, expiry, last_trans_id');
        $this->db->from('credits');
        $this->db->where('user_id',$user_id);
        $query = $this->db->get();
        return $row = $query->row_array();
    }
	
	public function get_member_type($mtype)
	{
		$query = $this->db->select("name")->where("id",$mtype)->get("member_types");
		$row = $query->row();
		return $row->name;
	}
    
    public function add_new_user($user)
    {
        $temp_pass = $user["password"];
        $user["password"] = "tempholder";
        
        if($this->db->insert("users", $user))
        {
            $userid = $this->db->insert_id();
            $query = $this->db->select('creation_date')->where('id', $userid)->get('users')->row();
            //run update with hashed password.
            $this->db->set('password', sha1($temp_pass.$query->creation_date));
            $this->db->where('id', $userid);
            $this->db->update('users');
            
            return TRUE;
        }
        else{ return FALSE; }        
    }
}