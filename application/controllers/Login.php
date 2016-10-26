<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{
	function __construct()
	{
    parent::__construct();
		$this->load->model('Login_model');
  }

	public function index()
	{
		if($this->session->userdata('logged_in') == 1)
		{
			redirect('Admin');
		}
		else if($this->session->userdata('logged_in_user')==1)
		{
			redirect('user');
		}
		else
		{
			$data['departments'] = $this->Login_model->get_departments();
			$this->load->view('Login/Login_page', $data);
		}
	}

	function doRegister()
	{
		$data = array('user_firstname'=>$this->input->post('firstname'),
									'user_middlename'=>$this->input->post('middlename'),
									'user_lastname'=>$this->input->post('lastname'),
									'user_username'=>$this->input->post('username'),
									'user_password'=>password_hash($this->input->post('password'), PASSWORD_DEFAULT),
									'user_department'=>$this->input->post('department'),
                  'user_picture'=>"./assets/images/avatars/avatar2.png",
									'user_isadmin'=>0
								);
		$duplicate_username = $this->Login_model->check_username_duplicate($this->input->post('username'));
		if($duplicate_username)
		{
			echo 0;
		}
		else
		{
			 $this->Login_model->insert_user($data);
				echo 1;
		}
	}

	function doLogin()
	{
		$data['hashisadmin'] = $this->Login_model->get_hash_isadmin($this->input->post('username'));
		if($data['hashisadmin'])
		{
			foreach($data['hashisadmin'] as $h)
			{
				$hash = $h->user_password;
				$isadmin = $h->user_isadmin;
			}

				if (password_verify($this->input->post('password'), $hash))
				{
					if($isadmin == 1)
					{
						$data = array('username'=>$this->input->post('username'),
													'success'=>1);
						$this->session->set_flashdata('username', $this->input->post('username'));
						echo json_encode($data);
					}
					if($isadmin == 0)
					{
						$data = array('username'=>$this->input->post('username'),
													'success'=>2);
						$this->session->set_flashdata('username', $this->input->post('username'));
						echo json_encode($data);
					}
				}
				else
				{
						echo 3;
				}
		}
		else
		{
			echo 0;
		}
	}

	function logout()
	{
		session_destroy();
    redirect(base_url().'Login');
	}
}
