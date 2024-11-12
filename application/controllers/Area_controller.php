<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Area_controller extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Author_model');
        $this->load->model('Area_model');
        $this->load->library('form_validation');
    }
    public function index()
    {
        $data['title'] = 'Add Room';

        if (strlen($this->session->userdata('alogin')) == 0) {
            redirect('');
        }else{
            $this->form_validation->set_rules('floor', 'Floor', 'required');
            $this->form_validation->set_rules('roomName', 'Rooom Name', 'required');
            $this->form_validation->set_rules('seatCount', 'Seat Count', 'required');
            $this->form_validation->set_rules('openTime', 'Open Time', 'required');
            $this->form_validation->set_rules('closeTime', 'Close Time', 'required');
            $this->form_validation->set_rules('minReserve', 'Min Reserve', 'required');
            $this->form_validation->set_rules('maxReserve', 'Max Reserve', 'required');

            if($this->form_validation->run() == false) {
                $this->load->view('Templates/head', $data);
                $this->load->view('Admin/Area/add-area');
                $this->load->view('Templates/foot');
            } else
            {
                $data = [
                    'floor' => $this->input->post('floor'),
                    'room' => $this->input->post('roomName'),
                    'slotNumber' => $this->input->post('seatCount'),
                    'openTime' => $this->input->post('openTime'),
                    'closeTime' => $this->input->post('closeTime'),
                    'minReserve' => $this->input->post('minReserve'),
                    'maxReserve' => $this->input->post('maxReserve'),
                ];
                $this->db->insert('tblarea', $data);
                $rows = $this->db->affected_rows();
                if ($rows > 0) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                        <strong> Area </strong> has been added Successfully!</div>');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Failed to add Area!</div>');
                }
                redirect('Area_controller/manage_area');
            }
        }
    }
    public function manage_area(){
        $data['title'] = 'Manage Area';

        if (strlen($this->session->userdata('alogin')) == 0) {
            redirect('');
        }else{
        $data['area'] = $this->Area_model->getAreaSet()->result_array();
        
        $this->load->view('Templates/head', $data);
        $this->load->view('Admin/Area/manage-area', $data);
        $this->load->view('Templates/foot');
        }
    }
    public function edit_area(){
        $data['title'] = 'Edit Area';

        if (strlen($this->session->userdata('alogin')) == 0) {
            redirect('');
        } else
        {
            $area_id = $this->input->get('id');
            if($area_id)
            {
                $data['area_info'] = $this->db->get_where('tblarea', ['id' => $area_id])->result_array();

                if ($this->input->post()) {
                    $update = [
                        'floor' => $this->input->post('floor'),
                        'room' => $this->input->post('areaName'),
                        'slotNumber' => $this->input->post('seatCount'),
                        'openTime' => $this->input->post('openTime'),
                        'closeTime' => $this->input->post('closeTime'),
                        'minReserve' => $this->input->post('minReserve'),
                        'maxReserve' => $this->input->post('maxReserve'),
                    ];
                    $this->db->where(['id' => $area_id])->update('tblarea', $update);
                    $rows = $this->db->affected_rows();
                    if ($rows > 0) {
                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                        <strong> Area </strong> has been Updated Successfully!</div>');
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Failed to Update Area Information!</div>');
                    }
                    redirect('manageArea');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> 
                    Failed to Update Area Information!</div>');;
                }
                $this->load->view('Templates/head', $data);
                $this->load->view('Admin/Area/edit-area');
                $this->load->view('Templates/foot');
            } else {
                echo 'Area ID is not Provided';
            }
        }
    }
    public function delete_area(){
        $id = $this->input->get('id');
        $this->db->delete('tblarea', ['id' => $id]);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Area has been Removed!</div>');
        redirect('manageArea');
    }
}