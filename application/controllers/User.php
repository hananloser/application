<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;

defined('BASEPATH') or exit('No direct script access allowed');
class User extends CI_Controller


{
    //index 
    public function index()
    {
        check_not_login();
        $this->load->model('user_m');
        $data['row'] = $this->user_m->get();
        $this->template->load('template', 'v_user', $data);
    }
}
