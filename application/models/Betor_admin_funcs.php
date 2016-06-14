<?php

Class Betor_admin_funcs extends CI_Model {
    
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
	
	public function add_free_tip($tip)
	{
		$tip["matchdate"] = "2016-".$tip["matchdate"].":00";
		if($this->db->insert("predictions",$tip))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	public function set_score($id, $result)
	{
		//fetch prediction first then check outcome.
		$query = $this->db->select("prediction")->where("id",$id)->get("predictions");
		$row = $query->row();
		$pred = $row->prediction;
		$goals = explode("-", $result);
		$home = (intval(trim($goals[0])) > intval(trim($goals[1])));
		$draw = (intval(trim($goals[0])) == intval(trim($goals[1])));
		$away = (intval(trim($goals[0])) < intval(trim($goals[1])));
		$outcome = false;
		while(1)
		{
			if(($pred == "1X" && $home) || ($pred == "1" && $home))
			{
				$outcome = TRUE;
				break;
			}
			else if(($pred == "X" && $draw) || ($pred == "1X" && $draw) || ($pred == "X2" && $draw))
			{
				$outcome = TRUE;
				break;
			}
			else if(($pred == "X2" && $away) || ($pred == "2" && $away))
			{
				$outcome = TRUE;
				break;
			}
			else if(($pred == "12" && $home) || ($pred == "12" && $away))
			{
				$outcome = TRUE;
				break;
			}
			else{
				break;
			}
		}
		$result = trim($goals[0])." - ".trim($goals[1]);
		$data = array(
			'result' => $result,
			'outcome' => $outcome
			);

		$this->db->where('id', $id);
		if($this->db->update('predictions', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	public function get_all_users()
	{
		$this->db->select("users.username, users.fullname, users.phone, users.email, users.confirmed, users.last_login, member_types.name")->from("users")->join("member_types","member_types.id = users.m_type");
		$query = $this->db->get();
		return $query;
	}
}
    