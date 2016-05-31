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
                //user exists
                return TRUE;
            }
            else{
                return FALSE;
            }
        }
        else{ return FALSE; }
    }
    
    public function get_user_info($username){
        $query = $this->db->select('*')->where('username',$username)->get('users');
        return $row = $query->row_array();
    }
    
    public function get_user_credit_bal($user_id)
    {
        $query = $this->db->select('balance,last_pay_id')->where('user_id', $user_id)->get('credits');
        return $row = $query->row();
    }
}