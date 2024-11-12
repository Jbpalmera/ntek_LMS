<?php
defined('BASEPATH') OR exit ('No direct scripts allowed');

class Members extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('form_validation');
    }

    public function index() {
        $response = [
            "status" => "success",
            "data" => "Members List View"
        ];

        return $this->output
        ->set_content_type('application/json')
        ->set_status_header(200)
        ->set_output(json_encode($response));
    }

    //APIs(POST, GET, PUT, DELETE)
    public function view() {
        $data = $this->db->select('*')->from('tblstudents')->get()->result_array();

        $response = [
            "data" => $data
        ];

        return $this->output
        ->set_content_type('application/json')
        ->set_status_header(200)
        ->set_output(json_encode($response));
    }

    //For validation of Phone Number (Phillipine Phone number format)
    function validate_phonenumber($str)
    {
        if (preg_match('/^(09|\+639|\+63 9)\d{9}$/', $str)) {
            return true;
        } else {
            $this->form_validation->set_message('validate_phonenumber', 'The %s field must be a valid Philippine mobile number.');
            return false;
        }
    }

    //POST Method API for adding data
    public function create() {
        $this->form_validation->set_rules('studentID', 'ID','required|trim');
        $this->form_validation->set_rules('fullName', 'Name','required|trim');
        $this->form_validation->set_rules('emailID', 'Email','required|valid_email|trim');
        $this->form_validation->set_rules('mobileNumber', 'Mobile Number','required|callback_validate_phonenumber');
        $this->form_validation->set_rules('address', 'Address','required|trim');

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
                'studentID' => $this->input->post('studentID'),
                'fullName' => $this->input->post('fullName'),
                'emailID' => $this->input->post('emailID'),
                'mobileNumber' => $this->input->post('mobileNumber'),
                'address' => $this->input->post('address')
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
        $this->form_validation->set_rules('studentID', 'ID','required|trim');
        $this->form_validation->set_rules('fullName', 'Name','required|trim');
        $this->form_validation->set_rules('emailID', 'Email','required|valid_email|trim');
        $this->form_validation->set_rules('mobileNumber', 'Mobile Number','required|callback_validate_phonenumber');
        $this->form_validation->set_rules('address', 'Address','required|trim');
    
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
                'studentID' => $data['studentID'],
                'fullName' => $data['fullName'],
                'emailID' => $data['emailID'],
                'mobileNumber' => $data['mobileNumber'],
                'address' => $data['address']
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
        $this->db->delete('tblstudents', ['id' => $id]);
        if ($this->db->affected_rows() > 0) {
            $code = 200;
            $response = [
                "status" => "success",
                "message" => "Successfully deleted member data!"
            ];

        } else {
            $code = 400;
            $response = [
                "status" => "error",
                "message" => "Failed to delete member data!"
            ];
        }

        return $this->output
        ->set_content_type('application/json')
        ->set_status_header($code)
        ->set_output(json_encode($response));
    }
}