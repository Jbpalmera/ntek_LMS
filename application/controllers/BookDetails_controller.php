<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BookDetails_controller extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('BookDetails_model');
        $this->load->model('Book_model');
        $this->load->library('form_validation');
        $this->load->helper('date');
    }
	public function index()
	{
		$this->load->view('Admin/dashboard');
	}
    public function issue_book()
    {
        $data['title'] = 'Issue Book';
        date_default_timezone_set("Asia/Manila");
        $dateToday = date('Y-m-d H:i:s', time());

        if (strlen($this->session->userdata('alogin')) == 0) {
            redirect('');
        } else {
            $this->form_validation->set_rules('studentid', 'Student Id', 'required');
            // $this->form_validation->set_rules('accession', 'Accession', 'required');
            $this->form_validation->set_rules('nfcTag', 'NfcTag', 'required');
            $this->form_validation->set_rules('issued', 'Issued', 'required');

            if ($this->form_validation->run() == false) {
                $this->load->view('Templates/head', $data);
                $this->load->view('Admin/BookDetail/issue-book', $data);
                $this->load->view('Templates/foot');
            } else {
                $book = $this->Book_model->getBook();
                // $ISBN = $this->input->post('accession');
                $ISBN = $this->input->post('nfcTag');
                $filteredBooks = array_filter($book, function ($bookItem) use ($ISBN) {
                    // return $bookItem['accessionNumber'] == $ISBN;
                    return $bookItem['nfcTag'] == $ISBN;
                });

                $foundBook = reset($filteredBooks);
            
                if ($foundBook) {
                    if ($foundBook['bookStatus'] != 0) {
                        $this->db->where('id', $foundBook['id']);
                        $this->db->update('tblbooks', array('bookStatus' => 0));

                        $dateTodayTimestamp = strtotime($dateToday);
                        $expectedReturnDate = $this->input->post('issued');
                        $expectedReturnTimestamp = $dateTodayTimestamp + ($expectedReturnDate * 24 * 60 * 60); 

                        $expectedReturnDateFormatted = date('Y-m-d H:i:s', $expectedReturnTimestamp);
                    
                        $bookData = [
                            'bookID' => $foundBook['id'],
                            'studentID' => $this->input->post('studentid'),
                            'issuesDate' => $dateToday,
                            'expectedReturnDate' => $expectedReturnDateFormatted,
                            'returnStatus' => 0
                        ];
                        $this->db->insert('tblissuedbookdetails', $bookData);
                        $rows = $this->db->affected_rows();
                        if ($rows > 0) {
                            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                            <strong> Book </strong> has been added Successfully!</div>');
                        } else {
                            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                        Failed to add Book!</div>');
                        }
                        redirect('manageIssuedBook');
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                        This book cannot be issued as its status is currently unavailable!</div>');
                        redirect('manageBook');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    The book with the given ID does not exist!</div>');
                    redirect('manageBook');
                }
            }
        }
    }
    public function manage_issued_books()
    {
        $data['title'] = 'Manage Issued Book';
        if (strlen($this->session->userdata('alogin')) == 0) {
            redirect('');
        } else {
            $issuedBooks = $this->BookDetails_model->issuedBook()->result_array();

            usort($issuedBooks, function($a, $b) {
                return strtotime($b['issuesDate']) - strtotime($a['issuesDate']);
            });

            $data['issuedBooks'] = $issuedBooks;
            // print_r(json_encode($data['issuedBooks']));
            $this->load->view('Templates/head', $data);
            $this->load->view('Admin/BookDetail/manage-issued-books', $data);
            $this->load->view('Templates/foot');
        }
    }
    public function edit_issued_book()
    {
        $data['title'] = 'Manage Issued Book';
        date_default_timezone_set("Asia/Manila");
        $dateToday = date('Y-m-d H:i:s', time());

        if (strlen($this->session->userdata('alogin')) == 0) {
            redirect('');
        }else{

            $id = $this->input->get('id');
            $data['info'] = $this->BookDetails_model->issuedBookById($id);
            // print_r($data['info']);
           
            if($this->input->post())
            {
                $fine = $this->input->post('fine');
                $this->db->where(['id' => $id])->update('tblissuedbookdetails', ['fine' => $fine, 'ReturnDate' => $dateToday, 'ReturnStatus' => 1]);

                $isbnNumber = $data['info']['isbnNumber']; 
                $this->db->where('isbnNumber', $isbnNumber);
                $this->db->update('tblbooks', array('bookStatus' => 1));

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Update Successful! </div>');
                redirect('manageIssuedBook');
            } else {
                // $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Failed to Update!</div>');
            }
            $this->load->view('Templates/head', $data);
            $this->load->view('Admin/BookDetail/edit-issued-book', $data);
            $this->load->view('Templates/foot');
        }
    }
    public function checkStudent() {
        $studentid = strtoupper($this->input->post('studentid'));

        $studentDetails = $this->BookDetails_model->getStudentDetails($studentid);

        if (!empty($studentDetails)) {
            foreach ($studentDetails as $result) {
                if ($result->Status == 0) {
                    echo "<span style='color:red'> Student ID Blocked </span>" . "<br />";
                    echo "<b>Student Name-</b>" . $result->fullName;
                    echo "<script>$('#submit').prop('disabled',true);</script>";
                } else {
                    echo htmlentities($result->fullName);
                    echo "<script>$('#submit').prop('disabled',false);</script>";
                }
            }
        } else {
            echo "<span style='color:red'> Invalid Student Id. Please Enter Valid Student id.</span>";
            echo "<script>$('#submit').prop('disabled',true);</script>";
        }
    }
    public function checkAccession() {
        $accession = strtoupper($this->input->post('accession'));
        
        $bookDetails = $this->BookDetails_model->getBookByAccession($accession);
        if (!empty($bookDetails)) {
            if($bookDetails['bookStatus'] == 0){
                echo "<span style='color:red'> Book is not Available </span>" . "<br />";
                echo "<b>Book Name - </b>" . $bookDetails['bookName'];
                echo "<script>$('#submit').prop('disabled',true);</script>";
            } else {
                echo "<span style='color:green'> Book is Available </span>" . "<br />";
                echo htmlentities($bookDetails['bookName']);
                echo "<script>$('#submit').prop('disabled',false);</script>";
            }
            
        } else {
            echo "<span style='color:red'> No Book is Found with Accession Number: </span>" . $accession;
        }
    }
    
    
}