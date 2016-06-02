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
	
	public function set_last_login($time,$userid)
	{
		$this->db->set('last_login', $time);
		$this->db->where('id', $userid);
		$this->db->update('users');
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