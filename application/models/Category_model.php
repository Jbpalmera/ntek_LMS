<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getCategory()
    {
        $this->db->select('*');
        $this->db->from('tblcategory');

        $query = $this->db->get()->result_array();
        return $query;
    }
}
