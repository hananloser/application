<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class API extends CI_Controller {

    public function index()
    {
        $this->load->library('datatables');

        $this->datatables->select('*');

        $this->datatables->from('data_uploaded'); 

        echo json_encode($this->datatables->generate());

    }

}

/* End of file API.php */
