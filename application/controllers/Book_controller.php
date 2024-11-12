<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Book_controller extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Book_model');
        $this->load->model('Category_model');
        $this->load->model('Author_model');
        $this->load->library('form_validation');
    }
	public function index()
	{
		$this->load->view('Admin/dashboard');
	}
    public function add_book()
    {
        $data['title'] = 'Add Book';

        if (strlen($this->session->userdata('alogin')) == 0) {
            redirect('');
        }else{

        $this->form_validation->set_rules('bookname', 'Book Name', 'required');
        $this->form_validation->set_rules('category', 'Category', 'required');
        $this->form_validation->set_rules('author', 'Author', 'required');
        $this->form_validation->set_rules('accessionNumber', 'Accession Number', 'required');
        $this->form_validation->set_rules('isbn', 'Isbn', 'required');
        $this->form_validation->set_rules('nfcTag', 'NFC Tag', 'required');
        $this->form_validation->set_rules('publisher', 'Publisher', 'required');
        $this->form_validation->set_rules('publication', 'Publication', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required');

        $data['category'] = $this->db->get_where('tblcategory', ['status' => 1])->result_array();
        $data['author'] = $this->db->get('tblauthors')->result_array();
            // print_r($data['author']);
        if($this->form_validation->run() == false) {
            $this->load->view('Templates/head', $data);
            $this->load->view('Admin/Book/add-book', $data);
            $this->load->view('Templates/foot');
        } else
        {
            $data = [
                'bookName' => $this->input->post('bookname'),
                'catID' => $this->input->post('category'),
                'authorID' => $this->input->post('author'),
                'accessionNumber' => $this->input->post('accessionNumber'),
                'isbnNumber' => $this->input->post('isbn'),
                'nfcTag' => $this->input->post('nfcTag'),
                'publisher' => $this->input->post('publisher'),
                'publication' => $this->input->post('publication'),
                'bookPrice' => $this->input->post('price'),
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
            redirect('Book_controller/manage_book');
        }
        }
        
    }
    public function manage_book()
    {
        $data['title'] = 'Manage Book';
        
        if (strlen($this->session->userdata('alogin')) == 0) {
            redirect('');
        }else{
        $data['book'] = $this->Book_model->getBookSet();
        
        $this->load->view('Templates/head', $data);
        $this->load->view('Admin/Book/manage-book');
        $this->load->view('Templates/foot');
        }
    }
    public function edit_book()
    {
        $data['title'] = 'Edit Book';

        if (strlen($this->session->userdata('alogin')) == 0) {
            redirect('');
        } else {
            $id = $this->input->get('id');

            $data['info'] = $this->Book_model->getBookById($id);
            $data['category'] = $this->Category_model->getCategory();
            $data['author'] = $this->Author_model->getAuthor();
            if($this->input->post())
            {
                $updateBook = [
                    'bookName' => $this->input->post('bookname'),
                    'catID' => $this->input->post('category'),
                    'authorID' => $this->input->post('author'),
                    'publication' => $this->input->post('publication'),
                    'publisher' => $this->input->post('publisher'),
                    'accessionNumber' => $this->input->post('accessionNumber'),
                    'isbnNumber' => $this->input->post('isbn'),
                    'bookPrice' => $this->input->post('price')
                ];
    
                $this->db->where('id', $id);
                $this->db->update('tblbooks', $updateBook);
    
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                        <strong> Book </strong> has been Updated Successfully!</div>');
                        redirect('Book_controller/manage_book');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                      Failed to add Book!</div>');
                }
            }
            

            $this->load->view('Templates/head', $data);
            $this->load->view('Admin/Book/edit-book', $data);
            $this->load->view('Templates/foot');
        }
    }
    public function delete_book()
    {
        $id = $this->input->get('id');
        $this->db->delete('tblbooks', ['id' => $id]);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Book has been Removed!</div>');
        redirect('Book_controller/manage_book');
    }
}