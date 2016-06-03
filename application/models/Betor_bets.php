<?php

Class Betor_bets extends CI_Model {
    
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
    
    public function get_free_tips()
    {
        $query = $this->db->select('*')->where("matchdate >=", date("Y-m-d", time())." 00:00:00")->order_by('matchdate', 'ASC')->get('predictions');
        
        return $query;
    }
}
    