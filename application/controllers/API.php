<?php


defined('BASEPATH') or exit('No direct script access allowed');

class API extends CI_Controller
{

    public function index()
    {
        $this->load->library('datatables');
        $this->datatables->select("*", true);
        $this->datatables->from('data_uploaded');
        return print_r($this->datatables->generate());
    }
}

/* End of file API.php */
