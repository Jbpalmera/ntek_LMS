<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function issuedBook()
    {
        $this->db->select('tblissuedbookdetails.id, tblstudents.fullName, tblbooks.bookName, tblbooks.isbnNumber,tblbooks.accessionNumber, tblissuedbookdetails.issuesDate, 
        tblissuedbookdetails.returnDate, tblissuedbookdetails.studentID, tblissuedbookdetails.fine, tblissuedbookdetails.returnStatus, tblissuedbookdetails.bookID');
        $this->db->from('tblissuedbookdetails');
        $this->db->join('tblstudents', 'tblstudents.studentID = tblissuedbookdetails.studentID');
        $this->db->join('tblbooks', 'tblbooks.id = tblissuedbookdetails.bookID');
        
        $query = $this->db->get();

        return $query;
    }
}
