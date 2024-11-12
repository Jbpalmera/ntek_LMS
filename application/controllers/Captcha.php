<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Captcha extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
    }
    public function index() {
        var_dump($_SESSION);
        $text = rand(10000, 99999);
        $this->session->set_userdata('vercode', $text);

        $height = 25;
        $width = 65;

        $image_p = imagecreate($width, $height);
        $black = imagecolorallocate($image_p, 0, 0, 0);
        $white = imagecolorallocate($image_p, 255, 255, 255);
        $font_size = 14;

        imagestring($image_p, $font_size, 5, 5, $text, $white);

        header('Content-Type: image/jpeg');
        imagejpeg($image_p, null, 80);
        imagedestroy($image_p);

        
    }
}
