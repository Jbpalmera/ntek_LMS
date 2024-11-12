<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_controller extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Category_model');
        $this->load->library('form_validation');
    }
	public function index()
	{
		$this->load->view('Admin/dashboard');
	}
    public function add_category()
    {
        $data['title'] = 'Add Category';

        if (strlen($this->session->userdata('alogin')) == 0) {
            redirect('');
        }else{

        $this->form_validation->set_rules('category', 'Category', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('Templates/head', $data);
            $this->load->view('Admin/Category/category-add', $data);
            $this->load->view('Templates/foot');
        }else
        {
            $data = array(
                'categoryName' => $this->input->post('category'),
                'status' => $this->input->post('status')
            );
            $this->db->insert('tblcategory', $data);
            $rows = $this->db->affected_rows();
            if ($rows > 0) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    <strong> Category </strong> has been added Successfully!</div>');
              } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                  Failed to add Category!</div>');
              }
            redirect('Category_controller/add_category');
        }
        }
    }
    public function edit_category()
    {
        $data['title'] = 'Manage Category';

        if (strlen($this->session->userdata('alogin')) == 0) {
            redirect('');
        } else {
            $category_id = $this->input->get('id');
            if ($category_id) {
                
                // $data['category_id'] = $category_id;
                $data['category_info'] = $this->db->get_where('tblcategory', ['id' => $category_id])->result_array();
                if ($this->input->post()) {
                    $stats = $this->input->post('status');
                    $catName = $this->input->post('category');
                    $this->db->where(['id' => $category_id])->update('tblcategory', ['status' => $stats, 'categoryName' => $catName]);
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Update Successful! </div>');
                    redirect('Category_controller/manage_categories');
                } else {
                    // $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Failed to Edit Category!</div>');;
                }

                $this->load->view('Templates/head', $data);
                $this->load->view('Admin/Category/edit-category', $data);
                $this->load->view('Templates/foot');
            } else 
            {
                echo "Category ID not provided";
            }
        }
    }
    public function manage_categories()
    {
        $data['title'] = 'Manage Category';

        if (strlen($this->session->userdata('alogin')) == 0) {
            redirect('');
        }else{
        $data['category'] = $this->Category_model->getCategory();
        
        $this->load->view('Templates/head', $data);
        $this->load->view('Admin/Category/manage-category', $data);
        $this->load->view('Templates/foot');
        }
    }
    public function delete_category()
    {
        $id = $this->input->get('id');
        $this->db->delete('tblcategory', ['id' => $id]);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Room has been Removed!</div>');
        redirect('Category_controller/manage_categories');
    }
}