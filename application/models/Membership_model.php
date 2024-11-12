<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Membership_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getMembership()
    {
        $this->db->select('*');
        $this->db->from('tblmembership');

        $query = $this->db->get();
        return $query;
    }
    public function getMembershipType()
    {
        $this->db->select('tblmembership.*, tblstudents.*');
        $this->db->from('tblmembership');
        $this->db->join('tblstudents', 'tblstudents.membershipID = tblmembership.id');

        $query = $this->db->get();
        return $query;
    }
    public function getMembershipTypeDesc()
    {
        $this->db->select('tblmembership.*, tblstudents.*');
        $this->db->from('tblmembership');
        $this->db->join('tblstudents', 'tblstudents.membershipID = tblmembership.id');
        $this->db->order_by('tblstudents.id', 'DESC');

        $query = $this->db->get();
        
        return $query;
    }

    public function getMembershipTypeByID($id)
    {
        $this->db->select('tblmembership.*, tblstudents.*');
        $this->db->from('tblmembership');
        $this->db->join('tblstudents', 'tblstudents.membershipID = tblmembership.id');

        $this->db->where('tblstudents.id', $id);

        $query = $this->db->get();
        return $query;
    }
}
