<?php
defined('BASEPATH') OR exit ('No direct scripts allowed');

class Transactions extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('form_validation');
    }

    public function index() {
        $this->load->view('Admin/dashboard');
    }

    //APIs(POST, GET, PUT, DELETE)
    public function view() {
        $data = $this->db->select('*')->from('tblissuedbookdetails')->get()->result_array();

        $response = [
            "data" => $data
        ];

        return $this->output
        ->set_content_type('application/json')
        ->set_status_header(200)
        ->set_output(json_encode($response));
    }

    //POST Method API for adding data
    public function create() {
        $this->form_validation->set_rules('studentid', 'Student Id', 'required|trim');
        $this->form_validation->set_rules('bookid', 'Book Id', 'required|trim');
        $this->form_validation->set_rules('issued', 'Issued', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $response = [
                "status" => 400,
                "message" => validation_errors()
            ];

            return $this->output
            ->set_content_type('application/json')
            ->set_status_header(400)
            ->set_output(json_encode($response));
        }
        else {
            $data = array(
                'studentid' => $this->input->post('studentid'),
                'bookid' => $this->input->post('bookid'),
                'issued' => $this->input->post('issued'),
            );

            return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode($data));
        }
    }

    //PUT Method API for updating data
    public function update($id) {
        // Get JSON data from request body
        $json_data = file_get_contents('php://input');
        
        // Decode JSON data
        $data = json_decode($json_data, true);
        
        // Validate JSON data
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('studentid', 'Student Id', 'required|trim');
        $this->form_validation->set_rules('bookid', 'Book Id', 'required|trim');
        $this->form_validation->set_rules('issued', 'Issued', 'required|trim');
    
        if ($this->form_validation->run() == FALSE) {
            $response = [
                "status" => 400,
                "message" => validation_errors()
            ];
    
            return $this->output
            ->set_content_type('application/json')
            ->set_status_header(400)
            ->set_output(json_encode($response));
        }
        else {
            $data = array(
                'studentid' => $this->input->post('studentid'),
                'bookid' => $this->input->post('bookid'),
                'issued' => $this->input->post('issued')
            );
    
            // Perform update operation using $id
            // Example: $this->your_model->update_data($id, $data);
    
            return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode($data));
        }
    }
    

    public function delete($id) {
        $this->db->delete('tbljournal', ['id' => $id]);
        if ($this->db->affected_rows() > 0) {
            $code = 200;
            $response = [
                "status" => "success",
                "message" => "Successfully deleted journal data!"
            ];

        } else {
            $code = 400;
            $response = [
                "status" => "error",
                "message" => "Failed to delete journal data!"
            ];
        }

        return $this->output
        ->set_content_type('application/json')
        ->set_status_header($code)
        ->set_output(json_encode($response));
    }
}