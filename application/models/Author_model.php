<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Author_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getAuthor()
    {
        $this->db->select('*');
        $this->db->from('tblauthors');

        $query = $this->db->get()->result_array();
        return $query;
    }
}
