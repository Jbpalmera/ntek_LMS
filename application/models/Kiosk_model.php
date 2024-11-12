<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kiosk_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getIssuedBookInfo($bookID)
    {
        $this->db->select('tblissuedbookdetails.issuesDate, tblissuedbookdetails.expectedReturnDate, tblissuedbookdetails.returnDate, tblissuedbookdetails.returnStatus, 
        tblbooks.bookName, tblbooks.isbnNumber, tblbooks.accessionNumber, 
        tblauthors.authorName, 
        tblcategory.categoryName, 
        tblstudents.fullName, tblstudents.emailID, tblstudents.mobileNumber');
        $this->db->from('tblissuedbookdetails');
        $this->db->join('tblbooks', 'tblissuedbookdetails.bookID = tblbooks.id');
        $this->db->join('tblstudents', 'tblissuedbookdetails.studentID = tblstudents.studentID');
        $this->db->join('tblauthors', 'tblbooks.authorID = tblauthors.id');
        $this->db->join('tblcategory', 'tblbooks.catID = tblcategory.id');

        $this->db->where('tblbooks.isbnNumber', $bookID);
        $this->db->where('tblissuedbookdetails.returnStatus', 0);

        $query = $this->db->get()->row_array();

        return $query;
    }
    public function getBookInfo()
    {
        $this->db->select('*');
        $this->db->from('tblissuedbookdetails');

        $query = $this->db->get()->result_array();
        return $query;
    }
}
