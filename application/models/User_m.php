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
