<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// application/controllers/PythonIntegration.php

class PythonIntegration extends CI_Controller {

    public function index() {
        $this->load->view('integration_view');
    }

    public function query_python() {
        $query = $this->input->post('query');

        // Send the query to the Python server and get the response
        // You'll need to use a library like cURL or Guzzle to send POST requests to your Python server

        // Example using cURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://192.168.1.103:8000');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(['query' => $query]));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(['response' => $response]));
        // $data['response'] = json_decode($response, true);

        // $this->load->view('integration_view', $data);
    }
}
