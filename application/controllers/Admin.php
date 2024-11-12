<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Book_model');
        $this->load->model('BookDetails_model');
        $this->load->model('Membership_model');
        $this->load->model('Student_model');
        $this->load->model('Author_model');
        $this->load->model('Category_model');
        $this->load->model('Admin_model');
        $this->load->library('form_validation');
    }
	public function index()
	{
		$this->dashboard();
	}
    public function dashboard()
    {
        $data['title'] = 'Dashboard';

        if (strlen($this->session->userdata('alogin')) == 0) {
            redirect('');
        }else{

            $issuedBooks = $this->BookDetails_model->issuedBook()->result_array();

            usort($issuedBooks, function($a, $b) {
                return strtotime($b['issuesDate']) - strtotime($a['issuesDate']);
            });
            
            $data['issuedBooks'] = array_slice($issuedBooks, 0, 10);

            $data['bookByStatus'] = count($this->Book_model->getBookByStatus(0));

            $bookDetails = $this->BookDetails_model->getBookDetails();

            $monthlyData = array_fill(0, 12, 0); 

            foreach ($bookDetails as $book) {
                $month = date('n', strtotime($book['issuesDate'])) - 1; 
                $monthlyData[$month]++;
            }

            $data['monthlyData'] = json_encode($monthlyData);

            $data['book'] = count($this->Book_model->getBook());
            $data['bookDetails'] = count($this->BookDetails_model->getBookDetails());
            $data['bookReturn'] = count($this->BookDetails_model->returnBook());
            $data['studentCount'] = count($this->Student_model->getStudent()->result_array());
            $data['authorCount'] = count($this->Author_model->getAuthor());
            $data['categoryCount'] = count($this->Category_model->getCategory());

        $this->load->view('Templates/head', $data);
        $this->load->view('Admin/dash', $data);
        $this->load->view('Templates/foot');
        }
        
    }
    public function change_passwords()
    {
        $data['title'] = 'Change Password';

        if (strlen($this->session->userdata('alogin')) == 0) {
            redirect('');
        } else {
            
            if ($this->input->post('change')) {
                $password = $this->input->post('password');
                $newpassword = $this->input->post('newpassword');
            }
            $this->load->view('Templates/head', $data);
            $this->load->view('Admin/change-password', $data);
            $this->load->view('Templates/foot');
        }
    }
    public function change_password()
    {
        $data['title'] = 'Change Password';

        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper('url');

        // Check if user is logged in
        if (!$this->session->userdata('alogin')) {
            redirect('');
        }

        // Validate form input
        $this->form_validation->set_rules('current_password', 'Current Password', 'required');
        $this->form_validation->set_rules('new_password', 'New Password', 'required|min_length[6]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[new_password]');

        if ($this->form_validation->run() == FALSE) {
            // Load the change password view
            $this->load->view('Templates/head', $data);
            $this->load->view('Admin/change-password');
            $this->load->view('Templates/foot');
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password');
            $username = $this->session->userdata('alogin');

            $result = $this->Admin_model->getUsername($username);
            // print_r($result);

            if (password_verify($current_password, $result['password'])) {
                $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);
                $this->Admin_model->updatePassword($username, $hashed_new_password);

                // $this->session->set_flashdata('message', 'Password changed successfully');
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Password changed successfully! </div>');
                redirect('admin/change_password');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Incorrect current password! </div>');
                // $this->session->set_flashdata('message', 'Incorrect current password');
                redirect('admin/change_password');
            }
        }
    }
    public function attendance()
    {
        $data['title'] = 'Attendance';

        if (strlen($this->session->userdata('alogin')) == 0) {
            redirect('');
        } else {
            $membership = $this->Membership_model->getMembershipType()->result_array();
            
            usort($membership, function($a, $b) {
                return $b['id'] - $a['id'];
            });

            $data['studentData'] = $membership;

            $this->load->view('Templates/head', $data);
            $this->load->view('Admin/Attendance/Attendance', $data);
            $this->load->view('Templates/foot');
        }
    }
    public function fetchData() {
        $apiUrl = 'https://demo-admin.catalyst-koha.com.au/api/v1/patrons';
        // Koha API credentials
        $username = 'staff';
        $password = 'staff1';

        // Create the basic authentication string
        $authString = base64_encode("$username:$password");

        // Initialize cURL session
        $ch = curl_init();

        // Set cURL options
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Authorization: Basic $authString"
        ));

        // Execute cURL session and fetch the response
        $response = curl_exec($ch);

        // Check for cURL errors
        if ($response === false) {
            echo 'cURL Error: ' . curl_error($ch);
        } else {
            // Decode JSON response
            $data = json_decode($response, true);

            // Check if the response contains an error
            if (isset($data['error'])) {
                echo 'Error: ' . $data['error'];
            } else {
                // Prepare data to pass to view
                $datas['fetch'] = $data;
                print_r(json_encode($datas['fetch']));
                // Load the view and pass the data to it
                // $this->load->view('Admin/dash', $datas);
                return $datas;
            }
        }

        // Close cURL session
        curl_close($ch);
    }
}
