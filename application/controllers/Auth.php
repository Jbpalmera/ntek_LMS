<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('admin_model');
        $this->load->helper('form'); 
        $this->load->database();
        $this->load->library('session');
    }
    public function index() 
    {   
        $this->isLoggedIn();
        $data['title'] = 'Library Management System';
        
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
       
        if ($this->form_validation->run() == false) {
            $this->load->view('Templates/head', $data);
            $this->load->view('Auth/Signin');
            $this->load->view('Templates/foot');
          } else {
            $this->adminLogin();
          }
    }
    public function isLoggedIn()
    {
        if($this->session->userdata('alogin')){
            redirect('dash');
        }
    }
    public function adminLogin() 
    {
        $this->load->library('session');
        $this->load->helper('url');
        
        // Get the captcha value from the form
        $captchaValue = $this->input->post('vercode');
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        // echo $username . ":" . $password . ":" . $captchaValue;
        
        if ($captchaValue != $this->session->userdata('vercode') || $this->session->userdata('vercode') == '')
        {
            $this->session->set_flashdata('message', 'Incorrect verification code');
            redirect('');
        } 
        else
        {
            $result = $this->admin_model->getUsername($username);

            if(!empty($result))
            {
                // echo $password;
                if(password_verify($password, $result['password']))
                {
                    $this->session->set_userdata('alogin', $username);
                    redirect('dash');
                }
                else
                {
                    $this->session->set_flashdata('message', 'Incorrect Password');
                    redirect('');
                }
            }
            else
            {
                $this->session->set_flashdata('message', 'Invalid Details');
                redirect('');
            }
        }
   
    }
    public function logout()
    {
        $this->load->library('session');

        $this->session->sess_destroy();

        redirect('admin');
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
