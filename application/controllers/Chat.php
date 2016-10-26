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
			$this->load->view('Admin/user_header',$header);
		}

		$data['users'] = $this->Chat_model->get_users();
		$this->load->view('Chat/users_list',$data);
	}


}
