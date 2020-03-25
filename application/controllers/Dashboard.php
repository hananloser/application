<?php defined('BASEPATH') or exit('No direct script access allowed');
/*
	// 
	//Author 	: Abdul Karim AL-H.
	//Country 	: Indonesia
	//Copyright @2020
	//Please Subscribe

	//Note 		: for Describe 
	//For Develeoper  : 
	//this controller to handle Dashboard in system 
*/
class Dashboard extends CI_Controller
{

	public function index()
	{
		check_not_login();
		$this->template->load('template', 'v_dashboard');
	}
	public function go_upload()
	{
		redirect('upload');
	}
	public function view_list()
	{
		redirect('view/userview');
	}
	public function manage_user()
	{
		redirect('user');
	}
	public function add_user()
	{
		redirect('data_user');
	}
	public function edit_user()
	{
		redirect('edit');
	}
	public function manage_data()
	{
		redirect('data');
	}
}
