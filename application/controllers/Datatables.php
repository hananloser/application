<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Datatables extends CI_Controller
{


    public function index()
    {
        $this->load->library('datatables');
        $this->datatables->select('*');
        $this->datatables->from('data_uploaded');
        return print_r($this->datatables->generate());
    }
}
