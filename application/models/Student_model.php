<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getStudent()
    {
        $this->db->select('*');
        $this->db->from('tblstudents');

        $query = $this->db->get();
        return $query;
    }
    public function getStudentById($studentId)
    {
        $this->db->select('*');
        $this->db->from('tblstudents');
        $this->db->where('studentID', $studentId);

        $query = $this->db->get()->row_array();
        return $query;
    }
    public function getStudentByRfid($rfid)
    {
        $this->db->select('*');
        $this->db->from('tblstudents');
        $this->db->where('rfid', $rfid);

        $query = $this->db->get();

        return $query;
    }
}
