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
		$this ->db->select('user_id,user_firstname,user_lastname,user_picture');
		$this ->db->from('tblusers');
		$query = $this->db->get();
		return $query->result();
	}

	function insert_chat($arr)
	{
		$this->db->insert('message',$arr);
		return $this->db->insert_id();
	}

	function get_one_chat($id)
	{
		$this->db->select('*');
		$this->db->from('message');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->row();
	}

	function get_chats($message_thread_id)
	{
		$this->db->select('id,sender_id,receiver_id,message,created_at');
		$this->db->from('message');
		$this->db->where('message_thread_id',$message_thread_id);
		$query = $this->db->get();
		return $query->result();
	}

	function get_thread($sender_id, $receiver_id)
	{
		$this->db->select('message_thread_id');
		$this->db->from('message');
		$this->db->where('sender_id',$sender_id);
		$this->db->where('receiver_id',$receiver_id);
		$query = $this->db->get();
		return $query->result();
	}

	function get_sender_picture($id)
	{
		$this->db->select('user_picture');
		$this->db->from('tblusers');
		$this->db->where('user_id',$id);
		$query = $this->db->get();
		return $query->row();
	}

}
