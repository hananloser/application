<?php defined('BASEPATH') or exit('No direct script access allowed');
/*
	// controller to handle proses
	//Author 	: Abdul Karim AL-H.
	//Country 	: Indonesia
	//Copyright @2020
	//Please Subscribe

	//Note 		: for Describe 
	//For Develeoper  : 
	//this controller to handle Dashboard in system 
*/
class Data_user extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model('user_m');
	}
	public function index()
	{
		$this->template->load('template', 'v_add_user');
	}
	public function add_process()
	{
		$post = $this->input->post(null, TRUE);
		$this->user_m->add($post);
		if ($this->db->affected_rows() > 0) {
			# code...
			echo "<script>
			alert('success');
			</script>";
		}
		echo
			"<script>
		window.location='" . site_url('user') . "';
		</script>";
	}
	public function del_process()
	{
		$id = $this->input->post('user_id');
		$this->user_m->del($id);
		if ($this->db->affected_rows() > 0) {
			# code...
			echo "<script>
			alert('success');
			</script>";
		}
		echo
			"<script>
		window.location='" . site_url('user') . "';
		</script>";
	}
	public function edit($id)
	{
		check_not_login();
		$this->load->model('user_m');
		$data['row'] = $this->user_m->get($id)->row_array();
		// var_dump($data);
		// die;
		$this->template->load('template', 'v_edit_user', $data);
	}
	public function edit_process()
	{
		$id = $this->input->post('user_id');
		$user_username = $this->input->post('user_username');
		$user_email = $this->input->post('user_email');
		$user_company_name = $this->input->post('user_company_name');
		$user_password = $this->input->post('user_password');

		$data = array(
			'user_username' => $user_username,
			'user_email' => $user_email,
			'user_company_name' => $user_company_name,
			'user_password' => $user_password
		);
		$where = array('user_id' => $id);
		$this->user_m->edit_process($where, $data, 'user');
		if ($this->db->affected_rows() > 0) {
			# code...
			echo "<script>
			alert('update success');
			</script>";
		}
		echo
			"<script>
		window.location='" . site_url('user') . "';
		</script>";
	}
}
