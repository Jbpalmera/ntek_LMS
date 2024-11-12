<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_controller extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Book_model');
        $this->load->model('BookDetails_model');
        $this->load->model('Student_model');
        $this->load->model('Author_model');
        $this->load->model('Category_model');
        $this->load->model('Admin_model');
        $this->load->model('Report_model');
        $this->load->library('form_validation');
    }
	public function index()
    {
        $data['title'] = 'Daily Report';

        if (strlen($this->session->userdata('alogin')) == 0) {
            redirect('');
        } else {

            date_default_timezone_set("Asia/Manila");
            $dateToday = date('Y-m-d', time());
            $data['dateToday'] = $dateToday;
            
            $issuedBook = $this->Report_model->issuedBook()->result_array();
            // print_r(json_encode($issuedBook));
            $data['filteredBooks'] = array_filter($issuedBook, function ($book) use ($dateToday) {
                return substr($book['issuesDate'], 0, 10) == $dateToday;
            });
            
            $this->load->view('Templates/head', $data);
            $this->load->view('Admin/Reports/daily-report', $data);
            $this->load->view('Templates/foot');
        }
    }
    public function monthlyReport()
    {
        $data['title'] = 'Monthly Report';

        if (strlen($this->session->userdata('alogin')) == 0) {
            redirect('');
        } else {

            date_default_timezone_set("Asia/Manila");
            $dateToday = date('Y-m-d', time());
            $data['dateToday'] = $dateToday;

            $issuedBook = $this->Report_model->issuedBook()->result_array();

            $data['filteredBooks'] = array_filter($issuedBook, function ($book) use ($dateToday) {
                $issueDate = substr($book['issuesDate'], 0, 10);
                $startOfMonth = date('Y-m-01', strtotime($dateToday));
                $endOfMonth = date('Y-m-t', strtotime($dateToday));
                return ($issueDate >= $startOfMonth && $issueDate <= $endOfMonth);
            });
            $this->load->view('Templates/head', $data);
            $this->load->view('Admin/Reports/monthly-report', $data); 
            $this->load->view('Templates/foot');
        }
    }

}