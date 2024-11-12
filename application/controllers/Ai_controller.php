<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ai_controller extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Book_model');
        $this->load->model('Admin_model');
    }

    public function authentication()
    {
        $username = $this->input->get('username');
        $password = $this->input->get('password');
        $userData = $this->Admin_model->getUsername($username);

        if(password_verify($password, $userData['password'])){
            $id = 1;
            $books = $this->Book_model->getBook();

            header('Content-Type: application/json');
            
            echo json_encode($books, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        } else {
            $data = [
                'error' => 'Wrong Credentials'
            ];

            header('Content-Type: application/json');
            
            print_r(json_encode($data));
        }
    }

    public function book_request()
    {
        
    }
}