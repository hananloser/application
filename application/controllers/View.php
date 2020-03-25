<?php
defined('BASEPATH') or exit('No direct script access allowed');
class View extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('upload_m');
        $this->load->helper('url');
    }
    public function index()
    {
        // $this->load->model('upload_m');
        $data['row'] = $this->upload_m->view_list()->result();
        $this->template->load('template', 'v_view', $data);
    }
    public function userview()
    {
        // $this->load->model('upload_m');
        $where = $this->session->userdata('username');
        $data['row'] = $this->upload_m->get_by_user($where)->result();
        $this->template->load('template', 'v_view', $data);
    }
}
