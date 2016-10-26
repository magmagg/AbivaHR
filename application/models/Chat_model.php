<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat_model extends CI_Model
{
	function __construct()
	{
    parent::__construct();
	}

	function get_users()
	{
		$this ->db->select('user_id,user_firstname,user_lastname');
		$this ->db->from('tblusers');
		$query = $this->db->get();
		return $query->result();
	}

}
