<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Membership_controller extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Student_model');
        $this->load->library('form_validation');
    }
    public function index()
	{
		$data['title'] = 'Membership';

        if (strlen($this->session->userdata('alogin')) == 0) {
            redirect('');
        }else{
            $this->load->library('form_validation');

            $this->form_validation->set_rules('membership', 'Membership', 'required');
            $this->form_validation->set_rules('category', 'Category', 'required');

        if($this->form_validation->run() == FALSE) {
            $this->load->view('Templates/head', $data);
            $this->load->view('Admin/Student/membership', $data);
            $this->load->view('Templates/foot');
        } else {
            $membership = $this->input->post('membership');
            $category = $this->input->post('category');
            $data = array(
                'membershipType' => $membership,
                'categoryID' => $category
            );
            
            $this->db->insert('tblmembership', $data);
            $rows = $this->db->affected_rows();
            if ($rows > 0) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Membership Type Added Successfully!</div>');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Failed to Add Membership Type!</div>');
            }
            redirect('Student_controller/reg_student');
        } 
        }
	}
}