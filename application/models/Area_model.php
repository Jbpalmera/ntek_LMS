<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Area_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    public function getAreaSet(){
        $this->db->select('*');
        $this->db->from('tblarea');

        $query = $this->db->get();
        return $query;
    }
}