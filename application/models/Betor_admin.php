<?php

Class Betor_admin extends CI_Model {
    
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
    
    public function login($logins)
    {
        //fetch date_created first then hash with sha1
        $query = $this->db->select('creation_date')->where('username',$logins['username'])->get('admin');
        $row = $query->row();
        if(isset($row->creation_date)){
            //echo $row->creation_date;
            $password = sha1($logins["password"].$row->creation_date);
            //echo $password;
            $logins["password"] = $password;
			$query = $this->db->select('id')->where($logins)->get('admin');
            if($query->num_rows() > 0){
                // user exists
				//echo "user exists!";
                return TRUE;
            }
            else{
				//echo "user does NOT exist!";
                return FALSE;
            }
        }
        else{ return FALSE; }
    }
	
	public function get_admin_info($username)
	{
		$query = $this->db->select('*')->where('username', $username)->get('admin');
        return $row = $query->row_array();
	}
	
	public function set_last_login($time, $userid, $ip)
	{
        $data = array(
        'last_login' => $time,
        'last_ip' => $ip
        );
		$this->db->where('id', $userid);
		$this->db->update('admin', $data);
	}
}
    