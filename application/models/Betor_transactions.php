<?php

Class Betor_transactions extends CI_Model {
    
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
	
	
}