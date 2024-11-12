<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Book_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getBook()
    {
        $this->db->select('*');
        $this->db->from('tblbooks');

        $query = $this->db->get()->result_array();
        return $query;
    }
    public function getBookSet()
    {
        $this->db->select('tblbooks.*, tblcategory.categoryName, tblauthors.authorName');
        $this->db->from('tblbooks');
        $this->db->join('tblcategory', 'tblbooks.catID = tblcategory.id', 'left');
        $this->db->join('tblauthors', 'tblbooks.authorID = tblauthors.id', 'left');

        $query = $this->db->get()->result_array();
        return $query;
    }
    public function getBookById($id)
    {
        $this->db->select('tblbooks.*, tblcategory.categoryName, tblauthors.authorName');
        $this->db->from('tblbooks');
        $this->db->join('tblcategory', 'tblbooks.catID = tblcategory.id', 'left');
        $this->db->join('tblauthors', 'tblbooks.authorID = tblauthors.id', 'left');
        
        $this->db->where('tblbooks.id', $id);

        $query = $this->db->get()->row_array();

        return $query;
    }
    public function getBookByStatus($status){
        $this->db->where('bookStatus', $status);
        $query = $this->db->get('tblbooks');
        return $query->result();
    }
    public function getBookByTag($nfc)
    {
        $this->db->select('*');
        $this->db->from('tblbooks');
        $this->db->join('tblcategory', 'tblbooks.catID = tblcategory.id', 'left');
        $this->db->join('tblauthors', 'tblbooks.authorID = tblauthors.id', 'left');
        $this->db->where('tblbooks.nfcTag', $nfc);

        $query = $this->db->get();

        return $query;
    }
}
