<?php
defined('BASEPATH') OR exit ('No direct scripts allowed');

class BookDrop_controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('BookDetails_model');
    }
    public function index(){
        $rfid = $this->input->get('rfid');
        $studentData = $this->BookDetails_model->getBooksByStudentID($rfid)->result_array();
        print_r(json_encode($studentData));
    }
    
    // API for getting all of the issued books to student
    public function getBorrowedBooks()
    {
        $rfid = $this->input->get('rfid');

        // Check if RFID is provided
        if (empty($rfid)) {
            // No RFID is provided
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(230, '230');
        }

        // Fetch the student data using the RFID
        $studentData = $this->BookDetails_model->getRfid($rfid)->row_array();

        // Check if student data is found
        if (!$studentData) {
            // No Student data found
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(220, '220');
        }

        // Fetch the borrowed books using the student ID
        $borrowedBooks = $this->BookDetails_model->getBooksByStudentID($studentData['studentID'])->result_array();
        
        // Initialize response
        $response = [];

        // Iterate through the borrowed books and build the response
        foreach ($borrowedBooks as $book) {
            if ($book['returnStatus'] == 0) {
                $response[] = [
                    'id' => $book['issuedBookID'],
                    'bookName' => $book['bookName'],
                    'issuesDate' => $book['issuesDate'],
                    'expectedReturnDate' => $book['expectedReturnDate'],
                ];
            }
        }

        // Check if any books were found with returnStatus == 0
        if (!empty($response)) {
            // Return the response
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode($response));
        } else {
            // No Borrowed Book Found
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(210, '210');
        }
    }

    // API for book return
    public function bookReturn()
    {
        // Set the timezone
        date_default_timezone_set("Asia/Manila");
        $dateToday = date('Y-m-d H:i:s');

        // Get the 'id' parameter from the request
        $id = $this->input->get('id');
        
        if ($id) {
            // Retrieve the issued book details
            $returnBook = $this->db->get_where('tblissuedbookdetails', ['id' => $id])->row_array();
            
            if ($returnBook) {
                // Update the return details in tblissuedbookdetails
                $this->db->where('id', $id)->update('tblissuedbookdetails', [
                    'returnDate' => $dateToday, 
                    'returnStatus' => 1, 
                    'fine' => 0 
                ]);
                
                // Update the book status in tblbooks
                $this->db->where('id', $returnBook['bookID'])->update('tblbooks', [
                    'bookStatus' => 1
                ]);
                
                // Check if any rows were affected by the update
                if ($this->db->affected_rows() > 0) {
                    // Return success response
                    return $this->output
                        ->set_content_type('application/json')
                        ->set_status_header(200) 
                        ->set_output(json_encode(['success' => 'Book Returned Successfully']));
                } else {
                    // Return error response if no rows were affected
                    return $this->output
                        ->set_content_type('application/json')
                        ->set_status_header(210, '210');
                        // ->set_output(json_encode(['error' => 'Failed to update the database.']));
                }
            } else {
                // Return error response if the book id is invalid
                return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(220, '220');
                    // ->set_output(json_encode(['error' => 'Invalid book ID.']));
            }
        } else {
            // Return error response if 'id' parameter is missing
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(230, '230'); 
                // ->set_output(json_encode(['error' => 'Book ID is required.']));
        }
    }

}