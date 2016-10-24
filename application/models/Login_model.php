<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model
{
	function __construct()
	{
    parent::__construct();
	}

	function insert_user($data)
	{
	    $this->db->insert('tblusers',$data);
		return $this->db->affected_rows();
	}

	function get_departments()
	{
		$this ->db->select('*');
		$this ->db->from('tbldepartments');
		$query = $this->db->get();
		return $query->result();
	}

	function check_username_duplicate($email)
	{
		$this ->db->select('*');
		$this ->db->from('tblusers');
		$this->db->where('user_username', $email);
		$query = $this->db->get();
		return $query->result();
	}

	function get_hash_isadmin($username)
	{
		$this ->db->select('user_password,user_isadmin');
		$this ->db->from('tblusers');
		$this->db->where('user_username', $username);
		$query = $this->db->get();
		return $query->result();
	}
}
