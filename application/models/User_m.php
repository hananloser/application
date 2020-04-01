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
class User_m extends CI_Model
{
    // start datatables
    var $column_order = array(null, 'user_username', 'user_company_name', 'user_email', 'user_address', 'user_level'); //set column field database for datatable orderable
    var $column_search = array('user_username', 'user_company_name', 'user_email', 'user_address', 'user_level'); //set column field database for datatable searchable
    var $order = array('user_username' => 'asc'); // default order

    private function _get_datatables_query()
    {
        // $this->db->select('data_uploaded');
        $this->db->from('user');
        // $this->db->join('p_category', 'p_item.category_id = p_category.category_id');
        // $this->db->join('p_unit', 'p_item.unit_id = p_unit.unit_id');
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
    function get_datatables()
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
        $this->db->from('user');
        return $this->db->count_all_results();
    }
    // end datatables
    public function login($post)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('user_username', $post['username']);
        $this->db->where('user_password', $post['password']);
        $query = $this->db->get();
        return $query;
    }
    public function get($id = NULL)
    {
        $this->db->from('user');
        if ($id != NULL) {
            $this->db->where('user_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }
    public function add($post)
    {
        $params['user_username'] = $post['user_username'];
        $params['user_email'] = $post['user_email'];
        $params['user_company_name'] = $post['user_company_name'];
        $params['user_password'] = $post['user_password'];
        $params['user_level'] = $post['user_level'];
        $this->db->insert('user', $params);
    }
    public function del($id)
    {
        $this->db->where('user_id', $id);
        $this->db->delete('user');
    }
    public function edit_process($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
}
