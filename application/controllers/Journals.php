<?php
defined('BASEPATH') OR exit ('No direct scripts allowed');

class Journals extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('form_validation');
    }

    public function index() {
        $response = [
            "status" => "success",
            "data" => "Journals List View"
        ];

        return $this->output
        ->set_content_type('application/json')
        ->set_status_header(200)
        ->set_output(json_encode($response));
    }

    //APIs(POST, GET, PUT, DELETE)
    public function view() {
        $data = $this->db->select('*')->from('tbljournal')->get()->result_array();

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
        $this->form_validation->set_rules('title', 'Title','required|trim');
        $this->form_validation->set_rules('author', 'Author','required|trim');
        $this->form_validation->set_rules('subject', 'Subject','required|trim');
        $this->form_validation->set_rules('publicationDate', 'Publication Date','required|trim');
        $this->form_validation->set_rules('code', 'Code','required|trim');

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
                'title' => $this->input->post('title'),
                'author' => $this->input->post('author'),
                'subject' => $this->input->post('subject'),
                'publicationDate' => $this->input->post('publicationDate'),
                'code' => $this->input->post('code')
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
        $this->form_validation->set_rules('title', 'Title','required|trim');
        $this->form_validation->set_rules('author', 'Author','required|trim');
        $this->form_validation->set_rules('subject', 'Subject','required|trim');
        $this->form_validation->set_rules('publicationDate', 'Publication Date','required|trim');
        $this->form_validation->set_rules('code', 'Code','required|trim');
    
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
                'title' => $this->input->post('title'),
                'author' => $this->input->post('author'),
                'subject' => $this->input->post('subject'),
                'publicationDate' => $this->input->post('publicationDate'),
                'code' => $this->input->post('code')
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