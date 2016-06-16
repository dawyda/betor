<?php

Class Betor_bets extends CI_Model {
    
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
    
    public function get_free_tips()
    {
		$tom = new DateTime('tomorrow');
		$tom = $tom->format('Y-m-d');
        $query = $this->db->select('*')->where("matchdate >=", date("Y-m-d", time())." 00:00:00")->where("matchdate <=", $tom." 02:00:00")->order_by('matchdate', 'ASC')->get('predictions');
        
        return $query;
    }
	
	public function get_yesterdays()
	{
		//fetch yesterdays free tips
		$this->db->select('*')->where("matchdate <", "CURDATE()",FALSE);
		$this->db->where("matchdate >=", "DATE_SUB(CURDATE(), INTERVAL 1 DAY)", FALSE);
		$query = $this->db->get("predictions");
		
		return $query;
	}
	
	public function fetch_unresulted()
	{
		$all_results = array();
		$fquery = $this->db->select("id, game")->where("result","")->where("matchdate <", date("Y-m-d H:m:i", time()))->order_by('matchdate', 'ASC')->get("predictions");
		foreach ($fquery->result() as $row)
		{
			array_push($all_results, $row);
		}
		return $all_results;
	}
}
    