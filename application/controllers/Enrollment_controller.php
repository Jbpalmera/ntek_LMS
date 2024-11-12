<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Enrollment_controller extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Book_model');
    }
    public function index()
    {
        $this->form_validation->set_rules('bookname', 'Book Name', 'required');
        $this->form_validation->set_rules('category', 'Category', 'required');
        $this->form_validation->set_rules('author', 'Author', 'required');
        $this->form_validation->set_rules('accessionNumber', 'Accession Number', 'required');
        $this->form_validation->set_rules('isbn', 'Isbn', 'required');
        $this->form_validation->set_rules('publisher', 'Publisher', 'required');
        $this->form_validation->set_rules('publication', 'Publication', 'required');
       
        $data['category'] = $this->db->get_where('tblcategory', ['status' => 1])->result_array();
        $data['author'] = $this->db->get('tblauthors')->result_array();

        if($this->form_validation->run() == false) {
            $this->load->view('Templates/head');
            $this->load->view('Enrollment/BookEnrollment', $data);
            $this->load->view('Templates/foot');
        } else {
            $data = [
                'bookName' => $this->input->post('bookname'),
                'catID' => $this->input->post('category'),
                'authorID' => $this->input->post('author'),
                'accessionNumber' => $this->input->post('accessionNumber'),
                'isbnNumber' => $this->input->post('isbn'),
                'publisher' => $this->input->post('publisher'),
                'publication' => $this->input->post('publication'),
                'bookStatus' => 1
            ];
            $this->db->insert('tblbooks', $data);
            $rows = $this->db->affected_rows();
            if ($rows > 0) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    <strong> Book </strong> has been added Successfully!</div>');
              } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                  Failed to add Book!</div>');
              }
            redirect('Enrollment_controller/index');
        }
    }
    public function bookPadReader()
    {
        $nfc = $this->input->post('nfc');
        $data = []; // Ensure $data is initialized
        if($nfc) {
            $book = $this->Book_model->getBookByTag($nfc)->row_array();
            if (!empty($book)) {
                $data['bookData'] = $book;
                print_r(json_encode($data['bookData']));
            } else {
                $data['bookData'] = null;
            }
        } else {
            $data['bookData'] = null;
            // No need for a separate echo, handle it inside the view.
        }

        // Render views
        $this->load->view('Templates/head');
        $this->load->view('Enrollment/BookPadReader', $data);
        $this->load->view('Templates/foot');
    }

}