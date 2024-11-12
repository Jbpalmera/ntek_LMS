<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    public function getUsername($email)
    {
        $this->db->select('*');
        $this->db->from('tblstudents');
        $this->db->where('emailID', $email);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
        return null; 
    }
    }
    public function updatePassword($email, $newPassword)
    {
        $this->db->where('emailID', $email);
        $this->db->update('tblstudents', array('password' => $newPassword));
    }
    public function getUserById($studentId)
    {
        $this->db->select('*');
        $this->db->from('tblstudents'); 
        $this->db->where('studentID', $studentId);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return null; 
        }
    }
    public function verifyEmail($email, $mobile)
    {
        $this->db->select('*');
        $this->db->from('tblstudents');
        $this->db->where('emailID', $email);
        $this->db->where('mobileNumber', $mobile);

        $query = $this->db->get();
        return $query;
    }

    public function updateStudentPassword($email, $newPass)
    {
        $data = array('password' => password_hash($newPass, PASSWORD_DEFAULT));
        $this->db->where('emailID', $email);
        $this->db->update('tblstudents', $data);
    }
}
