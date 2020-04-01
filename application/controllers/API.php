<?php


defined('BASEPATH') or exit('No direct script access allowed');

class API extends CI_Controller
{

    public function index()
    {
        echo $this->session->userdata('username');
    }
}

/* End of file API.php */
