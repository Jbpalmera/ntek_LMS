<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_controller extends CI_Controller {

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
        $this->isLoggedIn();
        $data['title'] = 'Library Management System';
        
        $this->form_validation->set_rules('emailid', 'EmailId', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
       
        if ($this->form_validation->run() == false) {
            $this->load->view('Templates/head', $data);
            $this->load->view('User/Signin/Userlogin');
            $this->load->view('Templates/foot');
          } else {
            
            $this->userLogin();
          }
    }
    public function userDashboard()
    {
        $data['title'] = 'Library Management System';
        
        $loginEmail = $this->session->userdata('login');

        if (strlen($this->session->userdata('login')) == 0) {
            redirect('');
        } else {
            $result = $this->User_model->getUsername($this->session->userdata('login'));
            $user = $this->User_model->getUserById($result['studentID']);
            
            $data['book'] = count($this->Book_model->getBook());

            if ($user) {
                $data['user'] = $user;
                $studentId = $data['user']['studentID'];

                $data['studentInfo'] = $this->Student_model->getStudentById($studentId);

                $issuedBooks = $this->BookDetails_model->getBookDetails();

                $studentIds = array();

                $matchingStudentInfo = array_filter($issuedBooks, function($book) use ($studentId) {
                    return $book['studentID'] == $studentId;
                });
                
                $data['countedBook'] = count($matchingStudentInfo);
                

                $returnStatus = array_filter($issuedBooks, function($book) use ($studentId) {
                    return $book['studentID'] == $studentId && $book['returnStatus'] == 0;
                });

                $data['unreturnedBook'] = count($returnStatus);

                $issuedStudentBook = $this->BookDetails_model->issuedBookDesc()->result_array();
            
                $filteredStudent = array_filter($this->Student_model->getStudent()->result_array(), function ($student) use ($loginEmail) {
                    return $student['emailID'] == $loginEmail;
                });
                $student = reset($filteredStudent);
                $studentId = $student['studentID'];
                
                $data['studentInfo'] = $this->Student_model->getStudentById($studentId);

                $borrowerData = array_filter($issuedStudentBook, function ($book) use ($studentId) {
                    return $book['studentID'] == $studentId;
                });
                
                $data['issuedBook'] = array_slice($borrowerData, 0, 5);

                $this->load->view('Templates/head', $data);
                $this->load->view('User/Loggedin/Dashboard', $data); 
                $this->load->view('Templates/foot');
            } else {
                redirect('');
            }
        }
    }
    public function isLoggedIn()
    {
        if($this->session->userdata('login')){
            redirect('userDash');
        }
    }
    public function userLogin()
    {
        $this->load->helper('url');
        
        $captchaValue = $this->input->post('vercode');
        $email = $this->input->post('emailid');
        $password = $this->input->post('password');

        if ($captchaValue != $this->session->userdata('vercode') || $this->session->userdata('vercode') == '')
        {
            $this->session->set_flashdata('message', 'Incorrect verification code');
            redirect('');
        } 
        else
        {
            $result = $this->User_model->getUsername($email);
            
            if(!empty($result))
            {
                if(password_verify($password, $result['password']))
                {
                    if($result['status'] == 1)
                    {
                    $this->session->set_userdata('login', $email);
                    redirect('User_controller/userDashboard');
                    } 
                    else
                    {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Your Account has been Blocked! Please contact Admin </div>');
                        redirect('');
                    }
                }
                else
                {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Incorrect Password! </div>');
                    redirect('');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Email and Password does not Match!</div>');
                redirect('');
            }
        }
    }
    public function navBar()
    {
        $loginEmail = $this->session->userdata('login');

        if(empty($loginEmail)){
            echo 'Error';
        } else {
            $result = $this->User_model->getUsername($loginEmail);
            if(!empty($result)){
                $studentId = $result['studentID'];
                $data['studentInfo'] = $this->Student_model->getStudentById($studentId);
                $this->load->view('Templates/userNavbar', $data);

                $this->userDashboard();
            }
        }
    }
    public function profile()
    {
        $data['title'] = 'Student Profile';

        $loginEmail = $this->session->userdata('login');
        
        if (empty($loginEmail)) {
            redirect('');
        } else {
            $result = $this->User_model->getUsername($loginEmail);

            if (!empty($result)) {
                $studentId = $result['studentID'];

                $data['studentInfo'] = $this->Student_model->getStudentById($studentId);
                if($this->input->post())
                {
                    $info = array(
                        'fullName' => $this->input->post('fullname'),
                        'mobileNumber' => $this->input->post('mobileno')
                    );
                    $this->db->where(['emailID' => $loginEmail])->update('tblstudents', $info);

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Update Successful! </div>');
                    redirect('User_controller/userDashboard');
                } else {
                    // $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Failed to Update!</div>');
                $this->load->view('Templates/head', $data);
                $this->load->view('User/Loggedin/Profile', $data); 
                $this->load->view('Templates/foot');
                }

                
            } else {
                redirect('');
            }
        }
    }
    
    public function books()
    {
        $data['title'] = 'Books';
        $loginEmail = $this->session->userdata('login');
        if (strlen($loginEmail) == 0) {
            redirect('');
        } else {
            $result = $this->User_model->getUsername($loginEmail);
            
            $studentId = $result['studentID'];

            $data['studentInfo'] = $this->Student_model->getStudentById($studentId);

            $data['books'] = $this->Book_model->getBookSet();
            // print_r($data['books']);
            $this->load->view('Templates/head', $data);
            $this->load->view('User/Loggedin/Books', $data); 
            $this->load->view('Templates/foot');
        }
    }
    public function logout()
    {
        $this->load->library('session');

        $this->session->sess_destroy();

        redirect('login');
    }
    public function chatBot()
    {
        $data['title'] = 'ChatBot';
        
        $this->load->view('Templates/header', $data);
        $this->load->view('Templates/topbar_user');
        $this->load->view('User/Chatbot');
        $this->load->view('Templates/footer');
    }
    public function botprocessing()
    {
        $msg = $this->input->post('msg');

        exec("python ". APPPATH . "pyserver/ailita.py " . escapeshellarg($msg), $output, $result_code);

        // Concatenate output lines into a single string
        $botResponse = implode("\n", $output);

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(['response' => $botResponse]));
    }

    public function changePass()
    {
        $data['title'] = 'Change Password';

        $loginEmail = $this->session->userdata('login');

        if (strlen($this->session->userdata('login')) == 0) {
            redirect('');
        } else {
            $this->form_validation->set_rules('password', 'Current Password', 'required');
            $this->form_validation->set_rules('newpassword', 'New Password', 'required|min_length[6]');
            $this->form_validation->set_rules('confirmpassword', 'Confirm Password', 'required|min_length[6]');
            if ($this->form_validation->run() == FALSE) {

                $result = $this->User_model->getUsername($loginEmail);
            
                $studentId = $result['studentID'];

                $data['studentInfo'] = $this->Student_model->getStudentById($studentId);

                $this->load->view('Templates/head', $data);
                $this->load->view('User/Loggedin/Changepass', $data);
                $this->load->view('Templates/foot');
            } else {
                $password = $this->input->post('password');
                $newPassword = $this->input->post('newpassword');

                $result = $this->User_model->getUsername($loginEmail);
               
                if ($result && password_verify($password, $result['password'])) {
                    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                    $this->User_model->updatePassword($loginEmail, $hashedPassword);

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Password changed successfully! </div>');
                    redirect('userChangePass');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Incorrect current password! </div>');
                    redirect('userChangePass');
                }
            }
        }
    }
    public function forgotPass()
    {
        $data['title'] = 'Forgot Password';

        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('mobile', 'Mobile', 'required');
        $this->form_validation->set_rules('newpassword', 'New Password', 'required');
        $this->form_validation->set_rules('confirmpassword', 'Confirm Password', 'required|matches[newpassword]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('Templates/head', $data);
            $this->load->view('User/Signin/Forgotpass');
            $this->load->view('Templates/foot');
        } else {
            $captchaValue = $this->input->post('vercode');

            if ($captchaValue != $this->session->userdata('vercode') || $this->session->userdata('vercode') == '')
            {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                <strong>Incorrect</strong> Verification Code!</div>');
                redirect('forgotPass');
            } 
            else
            {
                $email = $this->input->post('email');
                $mobile = $this->input->post('mobile');
                $newPass = $this->input->post('newpassword');

                $result = $this->User_model->verifyEmail($email, $mobile);

                if ($result->num_rows() > 0) {
                    $this->User_model->updateStudentPassword($email, $newPass);
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Password changed successfully! </div>');
                    redirect('forgotPass');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Password changed Failed! </div>');
                    redirect('forgotPass');
                }
            }
        }
    }
    public function signUp()
    {
        $data['title'] = 'Sign Up';
        $membership = $this->Membership_model->getMembership()->result_array();
        $exclude = 'Admin';

        $data['membership'] = array_filter($membership, function($row) use ($exclude) {
            return $row['membershipType'] !== $exclude;
        });
        
        $this->load->library('form_validation');

        $this->form_validation->set_rules('fullname', 'Full Name', 'required');
        $this->form_validation->set_rules('mobileno', 'Mobile Number', 'required');
        $this->form_validation->set_rules('membership', 'Membership', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('confirmpassword', 'Confirm Password', 'required|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('Templates/head', $data);
            $this->load->view('User/Signin/Signup');
            $this->load->view('Templates/foot');
        } else 
        {
            $captchaValue = $this->input->post('vercode');

            if ($captchaValue != $this->session->userdata('vercode') || $this->session->userdata('vercode') == '')
            {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                <strong>Incorrect</strong> Verification Code!</div>');
                redirect('userSignup');
            } 
            else
            {
                $latestStudentId = $this->db->select_max('StudentId')->get('tblstudents')->row()->StudentId;

                $numericPart = (int) substr($latestStudentId, 3);
                $newNumericPart = $numericPart + 1;

                $newStudentId = 'SID' . sprintf('%03d', $newNumericPart);

                $data = array(
                    'studentID' => $newStudentId,
                    'fullName' => $this->input->post('fullname'),
                    'mobileNumber' => $this->input->post('mobileno'),
                    'membershipID' => $this->input->post('membership'),
                    'emailID' => $this->input->post('email'),
                    'status' => '1',
                    'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
                );

                $this->db->insert('tblstudents', $data);
                $rows = $this->db->affected_rows();

                if ($rows > 0) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                        An <strong> Account </strong> has been Created Successfully!</div>');
                        redirect('userLogin');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                        Failed to Create New Account!</div>');
                }
                redirect('userSignup');
            }
        }
    }

    public function captcha()
    {
        $this->load->library('session');

        // Code for captcha generation
        $text = rand(10000, 99999);
        $this->session->set_userdata('vercode', $text);
        $height = 25;
        $width = 65;
    
        $image_p = imagecreate($width, $height);
        $black = imagecolorallocate($image_p, 0, 0, 0);
        $white = imagecolorallocate($image_p, 255, 255, 255);
        $font_size = 14;
    
        imagestring($image_p, $font_size, 5, 5, $text, $white);
    
        // Send the appropriate header and output the image
        header('Content-Type: image/jpeg');
        imagejpeg($image_p, null, 80);
    
        // Free up memory
        imagedestroy($image_p);
    }
}