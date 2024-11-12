<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserProcess_controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('User_model');
        $this->load->model('BookDetails_model');
        $this->load->model('Student_model');
        $this->load->model('Membership_model');
        $this->load->model('Book_model');
        $this->load->helper('form'); 
        $this->load->database();
        $this->load->library('session');
    }
    public function index() 
    {  
        $data['title'] = 'Check Out Book';
        $loginEmail = $this->session->userdata('login');
        date_default_timezone_set("Asia/Manila");
        $dateToday = date('Y-m-d H:i:s', time());

        if (strlen($loginEmail) == 0) {
            redirect('');
        } else {
            $this->form_validation->set_rules('studentid', 'Student ID', 'required');
            $this->form_validation->set_rules('nfcTag', 'NFC Tag', 'required');
            $this->form_validation->set_rules('issued', 'Issuance', 'required');

            if ($this->form_validation->run() == FALSE) {

                $result = $this->User_model->getUsername($loginEmail);
                $data['studentInfo'] = $this->User_model->getUserById($result['studentID']);

                $this->load->view('Templates/head', $data);
                $this->load->view('User/Loggedin/Checkout', $data); 
                $this->load->view('Templates/foot');
            } else {
                $book = $this->Book_model->getBook();
                $nfcTag = $this->input->post('nfcTag');
                $filteredBooks = array_filter($book, function ($bookItem) use ($nfcTag) {
                    return $bookItem['nfcTag'] == $nfcTag;
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
                            <strong> Book </strong> has been Checked Out Successfully!</div>');
                        } else {
                            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                        Failed to add Book!</div>');
                        }
                        redirect('userDash');
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                        This book cannot be issued as its status is currently unavailable!</div>');
                        redirect('checkOut');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    The book with the given ID does not exist!</div>');
                    redirect('checkOut');
                }
            }
            
        }
    }
    public function scanNfcTag() 
    {
        $nfcTag = strtoupper($this->input->post('nfcTag'));
    
        $bookDetails = $this->BookDetails_model->getBookByNfcTag($nfcTag);
    
        if (!empty($bookDetails)) {
            if ($bookDetails['nfcTag'] == NULL) {
                echo "<span style='color:red'> No Book is Found with NFC Tag: </span>" . $nfcTag;
            } else {
                    echo "<b>Accession Number - </b>" . $bookDetails['accessionNumber'] . "<br />";
                    echo "<b>Book Name - </b>" . $bookDetails['bookName'];
                    echo "<script>$('#submit').prop('disabled',false);</script>";
            }
        } else {
            echo "<span style='color:red'> No Book is Found with NFC Tag: </span>" . $nfcTag;
        }
    }
    public function nfcScan()
    {
        $data['title'] = 'Check Out Book';
        $loginEmail = $this->session->userdata('login');
        if (strlen($loginEmail) == 0) {
            redirect('');
        } else {
            $result = $this->User_model->getUsername($loginEmail);
            $data['studentInfo'] = $this->User_model->getUserById($result['studentID']);
           
            if($this->input->post())
            {
                $id = $this->input->get('id');
                $book = $this->BookDetails_model->issuedBookById($id);
                $nfcTag = $this->input->post('nfcTag');
                if($book['nfcTag'] == $nfcTag){
                    redirect('returnBook?id=' . $id);
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Book Nfc Tag Does not Match!</div>');
                    redirect('userIssuedBook');
                }
            }

            $this->load->view('Templates/head', $data);
            $this->load->view('User/Loggedin/Nfcscan', $data); 
            $this->load->view('Templates/foot');
        } 
    }
    public function returnBook()
    {
        $data['title'] = 'Check Out Book';
        $loginEmail = $this->session->userdata('login');
        date_default_timezone_set("Asia/Manila");
        $dateToday = date('Y-m-d H:i:s', time());

        if (strlen($loginEmail) == 0) {
            redirect('');
        } else {
            $result = $this->User_model->getUsername($loginEmail);
            $data['studentInfo'] = $this->User_model->getUserById($result['studentID']);
            $id = $this->input->get('id');
            $data['issuedBooks'] = $this->BookDetails_model->issuedBookById($id);
            $bookInfo = $data['issuedBooks'];
            
            if($this->input->post()){
                if($dateToday <= $bookInfo['expectedReturnDate']){
                    $this->db->where(['id' => $id])->update('tblissuedbookdetails', ['fine' => 0, 'ReturnDate' => $dateToday, 'ReturnStatus' => 1]);
                    
                    $this->db->where('nfcTag', $bookInfo['nfcTag']);
                    $this->db->update('tblbooks', array('bookStatus' => 1));

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Book Returned Successfully! </div>');
                    redirect('userIssuedBook');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                     Already past the Expected Return Date! <br />
                     Please Return the book to the Librarian
                     </div>');
                    redirect('userIssuedBook');
                }
            }

            $this->load->view('Templates/head', $data);
            $this->load->view('User/Loggedin/ReturnBook', $data); 
            $this->load->view('Templates/foot');
        }
    }
    public function checkNfcTag() 
    {
        $nfcTag = strtoupper($this->input->post('nfcTag'));
    
        $bookDetails = $this->BookDetails_model->getBookByNfcTag($nfcTag);
    
        if (!empty($bookDetails)) {
            if ($bookDetails['nfcTag'] == NULL) {
                echo "<span style='color:red'> No Book is Found with NFC Tag: </span>" . $nfcTag;
            } else {
                if ($bookDetails['bookStatus'] == 0) {
                    echo "<span style='color:red'> Book is not Available </span>" . "<br />";
                    echo "<b>Book Name - </b>" . $bookDetails['bookName'];
                    echo "<script>$('#submit').prop('disabled',true);</script>";
                } else {
                    echo "<span style='color:green'> Book is Available </span>" . "<br />";
                    echo "<b>Accession Number - </b>" . $bookDetails['accessionNumber'] . "<br />";
                    echo "<b>Book Name - </b>" . $bookDetails['bookName'];
                    echo "<script>$('#submit').prop('disabled',false);</script>";
                }
            }
        } else {
            echo "<span style='color:red'> No Book is Found with NFC Tag: </span>" . $nfcTag;
        }
    }
    public function issuedBooks()
    {
        $data['title'] = 'Manage Issued Books';
        $loginEmail = $this->session->userdata('login');

        if (strlen($loginEmail) == 0) {
            redirect('');
        } else {
            $issuedStudentBook = $this->BookDetails_model->issuedBook()->result_array();
            
            $filteredStudent = array_filter($this->Student_model->getStudent()->result_array(), function ($student) use ($loginEmail) {
                return $student['emailID'] == $loginEmail;
            });
            $student = reset($filteredStudent);
            $studentId = $student['studentID'];
            
            $data['studentInfo'] = $this->Student_model->getStudentById($studentId);
            
            $data['issuedBook'] = array_filter($issuedStudentBook, function ($book) use ($studentId) {
                return $book['studentID'] == $studentId;
            });
            
            $this->load->view('Templates/head', $data);
            $this->load->view('User/Loggedin/Issuedbook', $data); 
            $this->load->view('Templates/foot');
        }
    }
}