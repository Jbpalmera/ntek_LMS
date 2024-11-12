<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Author_controller extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Author_model');
        $this->load->library('form_validation');
    }
	public function index()
	{
		$this->load->view('Admin/dashboard');
	}
    public function add_author()
    {
        $data['title'] = 'Add Author';

        if (strlen($this->session->userdata('alogin')) == 0) {
            redirect('');
        }else
        {
            $this->form_validation->set_rules('author', 'Author', 'required');
            if ($this->form_validation->run() == false) {
                    $this->load->view('Templates/head', $data);
                    $this->load->view('Admin/Author/add-author');
                    $this->load->view('Templates/foot');
            }else
            {
                    $author = ['authorName' => $this->input->post('author')];
                    $this->db->insert('tblauthors', $author);
                    $rows = $this->db->affected_rows();
                    if ($rows > 0) {
                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                            An <strong> Author </strong> has been added Successfully!</div>');
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                            Failed to add New Author!</div>');
                    }
                    redirect('Author_controller/add_author');
            }
        }
    }
    public function edit_author()
    {
        $data['title'] = 'Edit Author';

        if (strlen($this->session->userdata('alogin')) == 0) {
            redirect('');
        } else
        {
            $author_id = $this->input->get('id');
            if($author_id)
            {
                $data['author_info'] = $this->db->get_where('tblauthors', ['id' => $author_id])->result_array();
                
                if ($this->input->post()) {
                    $authorName = $this->input->post('author');
                    $this->db->where(['id' => $author_id])->update('tblauthors', ['authorName' => $authorName]);

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Update Successful! </div>');
                    redirect('Author_controller/manage_author');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Failed to Edit Category!</div>');;
                }
                $this->load->view('Templates/head', $data);
                $this->load->view('Admin/Author/edit-author');
                $this->load->view('Templates/foot');
            } else 
            {
                echo "Author ID not provided";
            }
        }
    }
    public function manage_author()
    {
        $data['title'] = 'Manage Author';

        if (strlen($this->session->userdata('alogin')) == 0) {
            redirect('');
        }else
        {
            $data['author_info'] = $this->Author_model->getAuthor();
            
            $this->load->view('Templates/head', $data);
            $this->load->view('Admin/Author/manage-author', $data);
            $this->load->view('Templates/foot');
        }
    }
    public function delete_author()
    {
        $id = $this->input->get('id');
        $this->db->delete('tblauthors', ['id' => $id]);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Author has been Removed!</div>');
        redirect('Author_controller/manage_author');
    }
}