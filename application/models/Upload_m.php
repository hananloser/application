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

	/**
	 * @return Json
	 * 
	 * For Data Table
	 * 
	 */
	// start datatables
	var $column_order = array(null, 'Company_Name', 'First_Name', 'Last_Name', 'Valid_Check', 'Uploaded_By', 'Created_At'); //set column field database for datatable orderable
	var $column_search = array('Company_Name', 'First_Name', 'Last_Name', 'Valid_Check', 'Uploaded_By', 'Created_At'); //set column field database for datatable searchable
	var $order = array('Company_Name' => 'asc'); // default order

	private function _get_datatables_query()
	{
		$this->db->from('data_uploaded');
		$i = 0;
		foreach ($this->column_search as $item) { // loop column
			if (@$_POST['search']['value']) { // if datatable send POST for search
				if ($i === 0) { // first loop
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				} else {
					$this->db->or_like($item, $_POST['search']['value']);
				}
				if (count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}

		// if (isset($_POST['order'])) { // here order processing
		// 	$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		// } else if (isset($this->order)) {
		// 	$order = $this->order;
		// 	$this->db->order_by(key($order), $order[key($order)]);
		// }
	}

	// Ini Untuk User
	function get_datatables()
	{
		$this->_get_datatables_query();
		if (@$_POST['length'] != -1)
			$this->db->limit(@$_POST['length'], @$_POST['start']);
			$this->db->where('Uploaded_By' , $this->session->userdata('username'));
			$query = $this->db->get();
			return $query->result();
	}


	function get_datatables_admin()
	{
		$this->_get_datatables_query();
		if (@$_POST['length'] != -1)
			$this->db->limit(@$_POST['length'], @$_POST['start']);
			$query = $this->db->get();
			return $query->result();
	}





	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}
	function count_all()
	{
		$this->db->from('data_uploaded');
		return $this->db->count_all_results();
	}


	/**
	 * @return Json
	 * 
	 * For Data Table
	 * 
	 */

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
		$this->db->where('ID', $id);
		$this->db->delete('data_uploaded');
	}
	public function update($where, $data, $table)
	{
		$this->db->where($where);
		$this->db->update($table, $data);
	}
}
