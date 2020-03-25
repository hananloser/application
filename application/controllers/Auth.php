<?php defined('BASEPATH') or exit('No direct script access allowed');
/*
	// 
	//Author 	: Abdul Karim AL-H.
	//Country 	: Indonesia
	//Copyright @2020
	//Please Subscribe

	//Note 		: for Describe 
	//For Develeoper  : 
	//this controller to handle Authentication system
	//if you has a problem.... please contact our developer.! 
*/
class Auth extends CI_Controller
{

	public function login()
	{
		check_already_login();
		$this->load->view('v_login');
	}
	public function process_login()
	{
		$post = $this->input->post(null, TRUE);
		if (isset($post['login'])) {
			$this->load->model('user_m');
			$query = $this->user_m->login($post);
			if ($query->num_rows() > 0) {
				$row = $query->row();
				$params = array(
					'userid' => $row->user_id,
					'username' => $row->user_username,
					'level' => $row->user_level
				);
				$this->session->set_userdata($params);
				echo
					"<script>
				alert('selamat!, Login Berhasil');
				window.location='" . site_url('dashboard') . "';
				</script>";
			} else {
				echo
					"<script>
				alert('Maaf! Login Gagal, Username / Password Salah');
				window.location='" . site_url('auth/login') . "';
				</script>";
			}
		}
	}
	public function logout()
	{
		$params = array('userid', 'level');
		$this->session->unset_userdata($params);
		redirect('auth/login');
	}
}
