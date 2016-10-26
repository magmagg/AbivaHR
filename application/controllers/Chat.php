<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat extends CI_Controller
{
	function __construct()
	{
    parent::__construct();
		if($this->session->userdata('logged_in') == 1 || $this->session->userdata('logged_in_user')==1)
		{
			$this->load->model('Chat_model');
		}
		else
		{
			redirect('Login');
		}
  }

	public function index()
	{
		$header['active_head'] = 'messages';
		$header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");

		if($this->session->userdata('logged_in') == 1)
		{
			$this->load->view('Admin/admin_header',$header);
		}
		else if($this->session->userdata('logged_in_user')==1)
		{
			$this->load->view('User/user_header',$header);
		}

		$data['users'] = $this->Chat_model->get_users();
		$this->load->view('Chat/users_list',$data);
	}

	function send_message()
	{
		$arr['sender_id'] = $this->input->post('sender_id');
		$arr['receiver_id'] = $this->input->post('receiver_id');
		$arr['message'] = $this->input->post('message');

		$use['message'] = $this->Chat_model->get_thread($arr['sender_id'],$arr['receiver_id']);
		if($use['message'])
		{
			$data['message'] = $use['message'];
		}
		else
		{
			$data['message'] = $this->Chat_model->get_thread($arr['receiver_id'],$arr['sender_id']);
		}

		if($data['message'])
		{
			foreach($data['message'] as $d)
			{
				$arr['message_thread_id'] = $d->message_thread_id;
			}
		}
		else
		{
			$arr['message_thread_id'] = md5(uniqid());
		}

		$id = $this->Chat_model->insert_chat($arr);

		$detail = $this->Chat_model->get_one_chat($id);
		$picture = $this->Chat_model->get_sender_picture($arr['sender_id']);

		$arr['sender_id'] = $detail->sender_id;
		$arr['receiver_id'] = $detail->receiver_id;
		$arr['created_at'] = $detail->created_at;
		$arr['message'] = $detail->message;
		$arr['user_picture'] = $picture->user_picture;
		$arr['id'] = $detail->id;
		$arr['new_count_message'] = $this->db->where('read_status',0)->count_all_results('message');
		$arr['success'] = true;
		$arr['notif'] = '<div class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 alert alert-success" role="alert"> <i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Message sent ...</div>';

		echo json_encode($arr);
	}

	function load_chat()
	{
		$sender_id = $this->uri->segment(3);
		$receiver_id = $this->uri->segment(4);

		$use['message'] = $this->Chat_model->get_thread($sender_id,$receiver_id);
		if($use['message'])
		{
			$use['message'] = $use['message'];
		}
		else
		{
			$use['message'] = $this->Chat_model->get_thread($receiver_id,$sender_id);
		}

		$message_thread_id = 0;
		if($use['message'])
		{
			foreach($use['message'] as $d)
			{
				$message_thread_id =  $d->message_thread_id;
			}
		}
		if($message_thread_id !== 0)
		{
			$data['message'] = $this->Chat_model->get_chats($message_thread_id);
		}
		else
		{
			$data['message'] = array();
		}
		$data['sender_id'] = $sender_id;
		$data['receiver_id'] = $receiver_id;
		$data['users'] = $this->Chat_model->get_users();
		$this->load->view('Chat/load_chat',$data);
	}

	function random()
	{
		echo md5(uniqid());
	}


}
