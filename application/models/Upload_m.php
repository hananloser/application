<?php defined('BASEPATH') or exit('No direct script access allowed');
/*
	// 
	//Author 	: Abdul Karim AL-H.
	//Country 	: Indonesia
	//Copyright @2020
	//Please Subscribe

	//Note 		: for Describe 
	//For Developer  : 
	//this modell is help you to handle communicate between Authentication system and Your Database
	//if you has a problem.... please contact our developer.! 
*/
class Upload_m extends CI_Model
{

	public function insert_multiple($data)
	{
		$this->db->insert_batch('data_uploaded', $data);
	}
	public function view_list()
	{
		return $this->db->get('data_uploaded');
	}
	public function view_by_date()
	{
		return $this->db->get('data_uploaded');
	}
	public function get($id = NULL)
	{
		$this->db->from('data_uploaded');
		if ($id != NULL) {
			$this->db->where('ID', $id);
		}
		$query = $this->db->get();
		return $query;
	}
	public function get_by_date($tgl1, $tgl2)
	{

		$condition = $this->db->where("Created_At BETWEEN '$tgl1' AND '$tgl2'");
		return $this->db->get('data_uploaded');
	}
	public function get_by_user($where)
	{
		$this->db->where('Uploaded_By', $where);
		return $this->db->get('data_uploaded');
	}
	public function del($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('data_uploaded');
	}
	public function update($where, $data, $table)
	{
		$this->db->where($where);
		$this->db->update($table, $data);
	}
}
