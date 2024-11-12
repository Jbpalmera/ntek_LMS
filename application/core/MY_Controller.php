<?php
class MY_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();

        // Check if user is not logged in and not on the designated allowed pages
        $allowed_pages = array('auth', 'public_page'); // Add pages that don't require login
        $current_page = $this->uri->segment(1);

        if (!$this->session->userdata('username') && !in_array($current_page, $allowed_pages)) {
            redirect('auth'); // Redirect to the login page by default
        }
        if (!$this->session->userdata('username') && $current_page == 'admin') {
            redirect('auth'); // Redirect to the login page for the admin controller
        }
    }
}
