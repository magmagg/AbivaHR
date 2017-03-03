
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminDept extends CI_Controller
{
	function __construct()
	{
    parent::__construct();

    if($this->session->userdata('logged_in_admin') == 1)
    {
      $this->load->model('AdminDept_model');
    }
    else
    {
      if($this->session->flashdata('username'))
      {
        $this->load->model('AdminDept_model');
        $username = $this->session->flashdata('username');
        $data['details'] = $this->AdminDept_model->get_user_details($username);
        foreach($data['details'] as $row)
        {

        $sessiondata = array('id'=>$row->user_id,
                            'user_name'=>$row->user_username,
                            'firstname'=>$row->user_firstname,
                             'middlename'=>$row->user_middlename,
                             'lastname'=>$row->user_lastname,
                             'department'=>$row->user_department,
                             'picture'=>$row->user_picture,
                             'team'=>$row->user_teams_id_fk,
                             'logged_in_admin'=>true
                            );
        }
        $this->session->set_userdata($sessiondata);
      }
      else
      {
  		   redirect('Login', 'refresh');
      }
    }
  }
//========================DASHBOARD=====================//
  function index()
  {
    $header['active_head'] = '';
    $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
    $hasunread = $this->AdminDept_model->get_unread_messages($this->session->userdata['id']);
    if($hasunread)
      $header['ihasunread'] = 1;
    else
      $header['ihasunread'] = 0;
    $this->session->set_flashdata('notify',"<script>
    		new PNotify({
        title: 'Regular Success',
        text: 'That thing that you were trying to do worked!',
        type: 'success'
    	});
    </script>");
    $ID = $this->session->userdata['id'];
    $data['todolist'] = $this->AdminDept_model->get_todolist($ID);

    $this->load->view('AdminDept/admin_header',$header);
    $this->load->view('AdminDept/admin_index', $data);
  }

  function submit_todolist()
  {
    $data = array(
                  'todo_title'=>$this->input->post('title'),
                  'todo_employee_id_fk'=>$this->session->userdata['id'],
                  'todo_isfinished'=>0
                );

      $this->AdminDept_model->submit_todolist($data);
      redirect(base_url().'Admin');

  }

  function delete_one_todo()
  {
    $ID = $this->uri->segment(3);
    $this->AdminDept_model->delete_one_todo($ID);
  }

  function process_todo()
  {
    $ID = $this->uri->segment(3);

    $data['details'] = $this->AdminDept_model->todo_check($ID);
    foreach($data['details'] as $row)
    {
      if($row->todo_isfinished == 1)
      {
        $data = array('todo_isfinished'=>0);
      }else
      {
        $data = array('todo_isfinished'=>1);
      }
    }
    $this->AdminDept_model->process_todo($data,$ID);
  }
  //============================PROFILE===================================//
  function user_profile()
  {
    $header['active_head'] = '';
    $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
    $hasunread = $this->AdminDept_model->get_unread_messages($this->session->userdata['id']);
    if($hasunread)
      $header['ihasunread'] = 1;
    else
      $header['ihasunread'] = 0;

    $ID = $this->session->userdata['id'];
		$data['userDetails'] = $this->AdminDept_model->get_one_user($ID);
      //var_dump($this->session->all_userdata());
    $this->load->view('AdminDept/admin_header',$header);
    $this->load->view('AdminDept/admin_user_profile',$data);
  }

  function submit_edit_one_user()
  {
      $id = $this->input->post('id');

      $uname = $this->input->post('uname');
      $firstname = $this->input->post('fname');
      $middlename = $this->input->post('mname');
      $lastname = $this->input->post('lname');
      $bday = $this->input->post('bday');
      $gender = $this->input->post('gender');
      $aboutme = $this->input->post('aboutme');
      $email = $this->input->post('email');
      $address = $this->input->post('address');
      $phone = $this->input->post('phone');
      $googleplus = $this->input->post('googleplus');
      $linkedin = $this->input->post('linkedin');
      $wordpress = $this->input->post('wordpress');

      $check = $this->input->post('check');

      if($check == 0)
      {
        $this->session->unset_userdata('user_name');
        $this->session->unset_userdata('firstname');
        $this->session->unset_userdata('middlename');
        $this->session->unset_userdata('lastname');

        $data = array('user_username'=>$uname,
                      'user_firstname'=>$firstname,
                      'user_middlename'=>$middlename,
                      'user_lastname'=>$lastname,
                      'user_birthday'=>$bday,
                      'user_gender'=>$gender,
                      'user_aboutme'=>$aboutme,
                      'user_email'=>$email,
                      'user_address'=>$address,
                      'user_cpnumber'=>$phone,
                      'user_google'=>$googleplus,
                      'user_linkedin'=>$linkedin,
                      'user_wordpress'=>$wordpress
                    );
          $this->session->set_userdata('user_name',$uname);
          $this->session->set_userdata('firstname',$firstname);
          $this->session->set_userdata('middlename',$middlename);
          $this->session->set_userdata('lastname',$lastname);

          //setall
          $this->AdminDept_model->edit_one_user_profile($data, $id);
        //var_dump($check);
        redirect(base_url().'AdminDept/user_profile');
        print_r($this->session->userdata());
      }

      else if ($check == 1)
      {
            $config['upload_path']          = './assets/files/profile_pictures/';
            $config['allowed_types']        = 'gif|jpg|png';


            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('display_pic'))
            {
                    $error = array('error' => $this->upload->display_errors());
                    var_dump($error);
            }
            else
            {
                $this->session->unset_userdata('username');
                $this->session->unset_userdata('firstname');
                $this->session->unset_userdata('middlename');
                $this->session->unset_userdata('lastname');
                $this->session->unset_userdata('picture');

                $success = array('upload_data' => $this->upload->data());

                $add = './assets/files/profile_pictures/';

                $data = array('user_username'=>$uname,
                              'user_firstname'=>$firstname,
                              'user_middlename'=>$middlename,
                              'user_lastname'=>$lastname,
                              'user_birthday'=>$bday,
                              'user_gender'=>$gender,
                              'user_aboutme'=>$aboutme,
                              'user_email'=>$email,
                              'user_address'=>$address,
                              'user_cpnumber'=>$phone,
                              'user_google'=>$googleplus,
                              'user_linkedin'=>$linkedin,
                              'user_wordpress'=>$wordpress,
                              'user_picture'=>$add.$success['upload_data']['raw_name'].$success['upload_data']['file_ext']
                            );

                            $picture = $add.$success['upload_data']['raw_name'].$success['upload_data']['file_ext'];


                            $this->session->set_userdata('username',$username);
                            $this->session->set_userdata('firstname',$firstname);
                            $this->session->set_userdata('middlename',$middlename);
                            $this->session->set_userdata('lastname',$lastname);
                            $this->session->set_userdata('picture',$picture);

                            var_dump($success);
                            $this->AdminDept_model->edit_one_user_profile($data, $id);
                            redirect(base_url().'AdminDept/user_profile');
                            print_r($this->session->all_userdata());
              }
      }

      }

      function change_password()
    	{
    		$data['password'] = $this->AdminDept_model->check_password($this->input->post('userid'));
    		if($data['password'])
    		{
    			foreach($data['password'] as $h)
    			{
    				$hash = $h->user_password;
    			}

          if ($this->input->post('oldpassword')==$this->input->post('newpassword'))
          {
            echo 2;
          }
          else {
            if (password_verify($this->input->post('oldpassword'), $hash))
            {

              $id = $this->input->post('userid');
              $data = array('user_password'=>password_hash($this->input->post('newpassword'), PASSWORD_DEFAULT));

              $this->AdminDept_model->update_password($data,$id);

              echo 1;
             }else
              {
                echo 0;
              }
            }
    	}

  }

  function view_other_profile()
  {
    $header['active_head'] = '';
    $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
    $hasunread = $this->AdminDept_model->get_unread_messages($this->session->userdata['id']);
    if($hasunread)
      $header['ihasunread'] = 1;
    else
      $header['ihasunread'] = 0;

    $ID = $this->uri->segment(3);
		$data['userDetails'] = $this->AdminDept_model->get_one_user($ID);
      //var_dump($this->session->all_userdata());
    $this->load->view('AdminDept/admin_header',$header);
    $this->load->view('AdminDept/admin_view_other_profile',$data);
  }
  //============================MESSAGES===================================//
  function messages()
  {
    $header['active_head'] = 'messages';
    $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");

    $data['recipients'] = $this->AdminDept_model->get_list_employees();

    $this->load->view('AdminDept/admin_header',$header);
    $this->load->view('AdminDept/admin_messages',$data);
  }

  function do_message()
  {
    $id =$this->AdminDept_model->get_thread_number();

    $sender = $this->session->userdata['id'];
    $subject = $this->input->post('subject');
    $recipient = $this->input->post('recipient');
    $message = $this->input->post('message');

    $data = array('message_subject'=>$subject,
                  'message_id'=>$id,
                  'message_receiver'=>$recipient,
                  'message'=>$message,
                  'message_sender'=>$sender,
                  'thread_id_fk'=>$id
                );

    $this->AdminDept_model->submit_one_message($data, $id);
  }

  function test_message()
  {
    $header['active_head'] = 'messages';
    $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
    $data['messages'] = $this->AdminDept_model->get_all_messages();
    $this->load->view('AdminDept/admin_header',$header);
    $this->load->view('AdminDept/admin_messages_test',$data);
  }



  //============================EMPLOYEES===================================//
  function employees()
  {
    $header['active_head'] = 'employees';
    $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
    $hasunread = $this->AdminDept_model->get_unread_messages($this->session->userdata['id']);
    if($hasunread)
      $header['ihasunread'] = 1;
    else
      $header['ihasunread'] = 0;
    $data['employees'] = $this->AdminDept_model->get_employees_department();

    //Should be row id
    $ID = $this->session->userdata('id');
		$data_modal['employee'] = $this->AdminDept_model->get_one_employee($ID);
    $data_modal['departments'] = $this->AdminDept_model->get_departments();

    $this->load->view('AdminDept/admin_header',$header);
    $this->load->view('AdminDept/admin_employee_edit_modal',$data_modal);
    $this->load->view('AdminDept/admin_employees_view',$data);

  }

  function edit_one_employee()
  {
    $header['active_head'] = 'employees';
    $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
    $hasunread = $this->AdminDept_model->get_unread_messages($this->session->userdata['id']);
    if($hasunread)
      $header['ihasunread'] = 1;
    else
      $header['ihasunread'] = 0;
    $ID = $this->uri->segment(3);
		$data['employee'] = $this->AdminDept_model->get_one_employee($ID);
    $data['departments'] = $this->AdminDept_model->get_departments();

    $this->load->view('AdminDept/admin_header',$header);
    $this->load->view('AdminDept/admin_employee_edit_one',$data);
  }

  function submit_edit_employee()
  {
    $id = $this->input->post('id');

    $username = $this->input->post('uname');
    $firstname = $this->input->post('fname');
    $middlename = $this->input->post('mname');
    $lastname = $this->input->post('lname');
    $email = $this->input->post('email');
    $department = $this->input->post('department');

    $data = array('user_username'=>$username,
                  'user_firstname'=>$firstname,
                  'user_middlename'=>$middlename,
                  'user_lastname'=>$lastname,
                  'user_email'=>$email,
                  'user_department'=>$department
                );

    $this->AdminDept_model->submit_one_employee($data, $id);

    $this->session->set_flashdata('notify',"<script>
        new PNotify({
        title: 'Success!',
        text: 'Employee has been edited',
        type: 'success'
      });
    </script>");


    redirect(base_url().'AdminDept/employees');
  }

  function delete_one_employee()
	{
			$ID = $this->uri->segment(3);
			$this->AdminDept_model->delete_one_employee($ID);
			redirect(base_url().'AdminDept/employees');
	}

function add_employees()
{
  $header['active_head'] = 'employees';
  $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
  $hasunread = $this->AdminDept_model->get_unread_messages($this->session->userdata['id']);
  if($hasunread)
    $header['ihasunread'] = 1;
  else
    $header['ihasunread'] = 0;
  $data['departments'] = $this->AdminDept_model->get_departments();

  $this->load->view('AdminDept/admin_header',$header);
  $this->load->view('AdminDept/admin_employees_add',$data);
}

function submit_add_employee()
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

  $duplicate_username = $this->AdminDept_model->check_username_duplicate($this->input->post('username'));
  if($duplicate_username)
  {
    echo 0;
  }
  else
  {
     $this->AdminDept_model->insert_user($data);
      echo 1;
  }
}

function deactivate_user()
{
  $ID = $this->uri->segment(3);
  $data = array('user_active'=>0);
  $this->AdminDept_model->process_activation($data,$ID);
  echo 0;
}

function activate_user()
{
  $ID = $this->uri->segment(3);
  $data = array('user_active'=>1);
  $this->AdminDept_model->process_activation($data,$ID);
  echo 1;
}

function submit_import_employees()
{
        $data['error'] = '';    //initialize image upload error array to empty
        $config['upload_path'] = './assets/files/csv/';
        $config['allowed_types'] = 'csv';
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        // If upload failed, display error
        if (!$this->upload->do_upload('file'))
        {
          echo 0;

                        $error = array('error' => $this->upload->display_errors());
var_dump($error);
        }
        else
        {
            $file_data = $this->upload->data();
            $file_path =  './assets/files/csv/'.$file_data['file_name'];
            $data['departments'] = $this->AdminDept_model->get_departments();
            if ($this->csvimport->get_array($file_path))
            {
                $csv_array = $this->csvimport->get_array($file_path);
                foreach ($csv_array as $row)
                {
                  $department = '';
                  foreach($data['departments'] as $d)
                  {
                    if($d->department_name == $row['Department'])
                    {
                      $department = $d->department_id;
                    }
                  }

                  if($department == '')
                  {
                    continue;
                  }
                  else
                  {
                    $insert_data = array('user_firstname'=>$row['First name'],
                                        'user_middlename'=>$row['Middle name'],
                                        'user_lastname'=>$row['Last name'],
                                        'user_username'=>$row['Username'],
                                        'user_password'=>password_hash('password', PASSWORD_DEFAULT),
                                        'user_department'=>$department,
                                        'user_picture'=>"./assets/images/avatars/avatar2.png",
                                        'user_isadmin'=>1
                                      );
                    $this->AdminDept_model->insert_user($insert_data);
                  }
                }
                echo 1;

            }
          }
  }


  //============================GALLERY===================================//
  function gallery()
  {
    $header['active_head'] = 'gallery';
    $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
    $hasunread = $this->AdminDept_model->get_unread_messages($this->session->userdata['id']);
    if($hasunread)
      $header['ihasunread'] = 1;
    else
      $header['ihasunread'] = 0;
    $data['gallery'] = $this->AdminDept_model->get_all_gallery();
    $this->load->view('AdminDept/admin_header',$header);
    $this->load->view('AdminDept/admin_gallery',$data);
  }

  function view_gallery()
  {
    $header['active_head'] = 'gallery';
    $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
    $hasunread = $this->AdminDept_model->get_unread_messages($this->session->userdata['id']);
    if($hasunread)
      $header['ihasunread'] = 1;
    else
      $header['ihasunread'] = 0;
    $id = $this->uri->segment(3);
    $data['gallery'] = $this->AdminDept_model->get_specific_gallery($id);
    foreach($data['gallery'] as $d)
    {
      $data['galleryname'] = $d->gfolder_name;
    }
    $data['galleryid'] = $id;
    $data['users'] = $this->AdminDept_model->get_users();
    $this->load->view('AdminDept/admin_header',$header);
    $this->load->view('AdminDept/admin_gallery_view',$data);
  }

  function upload_pictures()
  {
    $header['active_head'] = 'gallery';
    $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
    $hasunread = $this->AdminDept_model->get_unread_messages($this->session->userdata['id']);
    if($hasunread)
      $header['ihasunread'] = 1;
    else
      $header['ihasunread'] = 0;
    $use['gallery'] = $this->AdminDept_model->get_gallery_names();
    $data['gallery'] = array();
    foreach($use['gallery'] as $key => $value)
    {
      $data['gallerynew'][] = $value->gfolder_name;
    }

    $use['galleryid'] = $this->uri->segment(3);
    $use['galleryname'] = $this->AdminDept_model->get_gallery_name($use['galleryid']);
    foreach($use['galleryname'] as $u)
    {
      $data['galleryname'] = $u->gfolder_name;
    }
    $this->load->view('AdminDept/admin_header',$header);
    $this->load->view('AdminDept/admin_gallery_upload', $data);
  }


  function do_Upload_gallery()
   {
     $this->load->helper('inflector');
     $gallery = $this->input->post('gallery');
     $count = 1;
     $data['check'] = $this->AdminDept_model->check_existing_gallery($gallery);
     if($data['check'])
     {
       foreach($data['check'] as $d)
       {
         $gfolder_id = $d->gfolder_id;
       }
     }
     else
     {
       $data = array('gfolder_name'=>$gallery);
       $gfolder_id = $this->AdminDept_model->insert_new_gfolder($data);
     }

     if (!file_exists( './assets/files/gallery/'.$gallery))
     {
      mkdir( './assets/files/gallery/'.$gallery, 0777, true);
    }

     foreach($_FILES['file']['tmp_name'] as $index => $f)
     {
     $target_dir =  './assets/files/gallery/'.$gallery."/";
     $target_file = $target_dir . basename($_FILES["file"]["name"][$index]);
     $uploadOk = 1;
     $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
     $newname = $_FILES["file"]["name"][$index];
     $files_name = $_FILES["file"]["name"][$index];
     // Check if image file is a actual image or fake image
     if(isset($_POST["submit"])) {
         $check = getimagesize($_FILES["file"]["tmp_name"][$index]);
         if($check !== false) {
             echo "File is an image - " . $check["mime"] . ".";
             $uploadOk = 1;
         } else {
             echo "File is not an image.";
             $uploadOk = 0;
         }
     }
     // Check if file already exists
     if (file_exists($target_file)) {
       $name = $_FILES['file']['name'][$index];
       $actual_name = pathinfo($name,PATHINFO_FILENAME);
       $original_name = $actual_name;
       $extension = pathinfo($name, PATHINFO_EXTENSION);

       $i = 1;
       while(file_exists($target_dir.$actual_name.".".$extension))
       {
           $actual_name = (string)$original_name.'_'.$i;
           $files_name = $actual_name;
           $target_file = $target_dir.$actual_name.".".$extension;
           $i++;
       }
         $uploadOk = 1;
     }
     // Check if $uploadOk is set to 0 by an error
     if ($uploadOk == 0) {
         echo "Sorry, your file was not uploaded.";
     // if everything is ok, try to upload file
     } else {

         if (move_uploaded_file($_FILES["file"]["tmp_name"][$index], $target_file)) {

            $this->create_thumbnail($target_file);
             $data = array('picture_name'=>$newname,
                            'picture_path'=>$target_file,
                            'picture_uploader_id'=>$this->session->userdata['id'],
                            'gfolder_id_fk'=>$gfolder_id);

              $this->AdminDept_model->insert_gallery_pictures($data);
              if($count == 1)
              {
                echo $gfolder_id;
              }
              else
              {
                //Do nothing
              }
              $count++;
         } else {
             echo "Sorry, there was an error uploading your file.";
         }
     }
   }

   }

     function create_thumbnail($target_file)
     {
       $this->load->library('image_lib');
       $config['image_library'] = 'gd2';
       $config['source_image'] = $target_file;
       $config['create_thumb'] = TRUE;
       $config['width']         = 500;
       $config['height']       = 500;

       $this->image_lib->initialize($config);
       $this->image_lib->resize();
     }

     function delete_one_picture()
     {
       $id = $this->uri->segment(3);
       $data['details'] = $this->AdminDept_model->get_one_picture($id);
       foreach($data['details'] as $d)
       {
         $path = $d->picture_path;
       }
       unlink($path);
       $this->AdminDept_model->delete_one_picture_model($id);
     }

     function delete_album()
     {
       $id = $this->uri->segment(3);

       $data['details'] = $this->AdminDept_model->get_gallery_by_folder($id);
       foreach($data['details'] as $d)
       {
         unlink($d->picture_path);
         $withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $d->picture_path);
          $ext = pathinfo($d->picture_path, PATHINFO_EXTENSION);
          $picture_name = $withoutExt.'_thumb.'.$ext;
          unlink($picture_name);
       }
       $this->AdminDept_model->delete_gallery_pictures($id);
       $this->AdminDept_model->delete_gallery_album($id);
       redirect('AdminDept/gallery');
     }

     function manage_gallery()
     {
       $header['active_head'] = 'gallery';
       $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
       $hasunread = $this->AdminDept_model->get_unread_messages($this->session->userdata['id']);
       if($hasunread)
         $header['ihasunread'] = 1;
       else
         $header['ihasunread'] = 0;
       $id = $this->uri->segment(3);
       $data['gallery'] = $this->AdminDept_model->get_specific_gallery($id);
       if($data['gallery'])
       {
         foreach($data['gallery'] as $d)
         {
           $data['galleryname'] = $d->gfolder_name;
         }
         $data['galleryid'] = $id;
         $this->load->view('AdminDept/admin_header',$header);
         $this->load->view('AdminDept/admin_gallery_manage',$data);
       }
       else
       {
         redirect('AdminDept/gallery');
       }
     }

     function delete_pictures()
     {
       foreach($this->input->post('pictures') as $id)
       {
         $data['details'] = $this->AdminDept_model->get_one_picture($id);
         foreach($data['details'] as $d)
         {
           $path = $d->picture_path;
           $withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $d->picture_path);
           $ext = pathinfo($d->picture_path, PATHINFO_EXTENSION);
           $picture_name = $withoutExt.'_thumb.'.$ext;
           unlink($picture_name);
           unlink($path);
         }
         $this->AdminDept_model->delete_one_picture_model($id);
       }
       redirect('AdminDept/manage_gallery/'.$this->input->post('return'));
     }

  //===============================VIDEOS=======================================//
  function upload_videos()
  {
    $header['active_head'] = 'gallery';
    $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
    $hasunread = $this->AdminDept_model->get_unread_messages($this->session->userdata['id']);
    if($hasunread)
      $header['ihasunread'] = 1;
    else
      $header['ihasunread'] = 0;
    $use['vfolder_name'] = $this->AdminDept_model->get_videos_folder();
    $data['vfolder_name'] = array();
    foreach($use['vfolder_name'] as $key => $value)
    {
      $data['vfolder_name'][] = $value->vfolder_name;
    }

    $use['vfolder_id'] = $this->uri->segment(3);
    $use['vfoldername'] = $this->AdminDept_model->get_videos_folder_name($use['vfolder_id']);
    foreach($use['vfoldername'] as $u)
    {
      $data['vfoldername'] = $u->vfolder_name;
    }
    $this->load->view('AdminDept/admin_header',$header);
    $this->load->view('AdminDept/admin_videos_upload', $data);
  }

  function do_upload_videos()
   {
     $this->load->helper('inflector');
     $videofolder = $this->input->post('gallery');
     $count = 1;
     $data['check'] = $this->AdminDept_model->check_existing_video_folder($videofolder);
     if($data['check'])
     {
       foreach($data['check'] as $d)
       {
         $vfolder_id = $d->vfolder_id;
       }
     }
     else
     {
       $data = array('vfolder_name'=>$videofolder);
       $vfolder_id = $this->AdminDept_model->insert_new_vfolder($data);

     }

     if (!file_exists('./assets/files/videos/'.$videofolder))
     {
     mkdir( './assets/files/videos/'.$videofolder, 0777, true);
    }

     foreach($_FILES['file']['tmp_name'] as $index => $f)
     {
     $target_dir =  './assets/files/videos/'.$videofolder."/";
     $target_file = $target_dir . basename($_FILES["file"]["name"][$index]);
     $uploadOk = 1;
     $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
     $newname = $_FILES["file"]["name"][$index];
     $files_name = $_FILES["file"]["name"][$index];
     $actual_name = pathinfo($newname,PATHINFO_FILENAME);
     // Check if image file is a actual image or fake image
     // Check if file already exists
     if (file_exists($target_file)) {
       $name = $_FILES['file']['name'][$index];
       $actual_name = pathinfo($name,PATHINFO_FILENAME);
       $original_name = $actual_name;
       $extension = pathinfo($name, PATHINFO_EXTENSION);

       $i = 1;
       while(file_exists($target_dir.$actual_name.".".$extension))
       {
           $actual_name = (string)$original_name.'_'.$i;
           $files_name = $actual_name;
           $target_file = $target_dir.$actual_name.".".$extension;
           $i++;
       }
         $uploadOk = 1;
     }
     // Check file size

     // Check if $uploadOk is set to 0 by an error
     if ($uploadOk == 0) {
         echo "Sorry, your file was not uploaded.";
     // if everything is ok, try to upload file
     } else {

         if (move_uploaded_file($_FILES["file"]["tmp_name"][$index], $target_file)) {

           $this->create_thumbnail_videos($target_file, $target_dir.$actual_name.'.png');

             $data = array('video_name'=>$newname,
                            'video_path'=>$target_file,
                            'video_uploader_id'=>$this->session->userdata['id'],
                            'vfolder_id_fk'=>$vfolder_id);

              $this->AdminDept_model->insert_videos($data);
              if($count == 1)
              {
                echo $vfolder_id;
              }
              else
              {
                //Do nothing
              }
              $count++;
         } else {
             echo "Sorry, there was an error uploading your file.";
         }
     }
   }

   }

   function create_thumbnail_videos($target_file,$destFile)
   {
     // Change the path according to your server.
      $ffmpeg_path = './assets/ffmpeg/bin/';
      $target_file = '"'.$target_file.'"';
      $destFile = '"'.$destFile.'"';
      $output = array();

      $cmd = sprintf('%sffmpeg -i %s -an -ss 00:00:05 -r 1 -vframes 1 -y %s',
          $ffmpeg_path, $target_file, $destFile);
      if (strtoupper(substr(PHP_OS, 0, 3) == 'WIN'))
          $cmd = str_replace('/', DIRECTORY_SEPARATOR, $cmd);
      else
          $cmd = str_replace('\\', DIRECTORY_SEPARATOR, $cmd);

      exec($cmd, $output, $retval);

      if ($retval)
          return false;

      return $destFile;
   }

   function videos()
   {
     $header['active_head'] = 'gallery';
     $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
     $hasunread = $this->AdminDept_model->get_unread_messages($this->session->userdata['id']);
     if($hasunread)
       $header['ihasunread'] = 1;
     else
       $header['ihasunread'] = 0;
     $data['videos'] = $this->AdminDept_model->get_all_videos();
     $this->load->view('AdminDept/admin_header',$header);
     $this->load->view('AdminDept/admin_videos',$data);
   }

   function view_videos()
   {
     $header['active_head'] = 'gallery';
     $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
     $hasunread = $this->AdminDept_model->get_unread_messages($this->session->userdata['id']);
     if($hasunread)
       $header['ihasunread'] = 1;
     else
       $header['ihasunread'] = 0;
     $id = $this->uri->segment(3);
     $data['videos'] = $this->AdminDept_model->get_specific_videos($id);
     foreach($data['videos'] as $d)
     {
       $data['galleryname'] = $d->vfolder_name;
     }
     $data['galleryid'] = $id;
     $data['users'] = $this->AdminDept_model->get_users();
     $this->load->view('AdminDept/admin_header',$header);
     $this->load->view('AdminDept/admin_videos_view',$data);
   }

   function delete_videos_album()
   {
     $id = $this->uri->segment(3);

     $data['details'] = $this->AdminDept_model->get_videos_by_folder($id);
     foreach($data['details'] as $d)
     {
       unlink($d->video_path);

       $withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $d->video_path);
       $picture_name = $withoutExt.'.png';
       unlink($picture_name);
     }
     $this->AdminDept_model->delete_video($id);
     $this->AdminDept_model->delete_video_album($id);
   }

   function manage_videos()
   {
     $header['active_head'] = 'gallery';
     $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
     $hasunread = $this->AdminDept_model->get_unread_messages($this->session->userdata['id']);
     if($hasunread)
       $header['ihasunread'] = 1;
     else
       $header['ihasunread'] = 0;
     $id = $this->uri->segment(3);
     $data['videos'] = $this->AdminDept_model->get_specific_videos($id);
     if($data['videos'])
     {
       foreach($data['videos'] as $d)
       {
         $data['galleryname'] = $d->vfolder_name;
       }
       $data['galleryid'] = $id;
       $this->load->view('AdminDept/admin_header',$header);
       $this->load->view('AdminDept/admin_videos_manage',$data);
     }
     else
     {
       redirect('AdminDept/videos');
     }
   }

   function delete_one_video()
   {
     $id = $this->uri->segment(3);
     $data['details'] = $this->AdminDept_model->get_one_video($id);
     foreach($data['details'] as $d)
     {
       $path = $d->video_path;
       $withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $d->video_path);
        $picture_name = $withoutExt.'.png.';
     }
     unlink($picture_name);
     unlink($path);
     $this->AdminDept_model->delete_one_video($id);
   }

   function delete_videos()
   {
     foreach($this->input->post('videos') as $id)
     {
       $data['details'] = $this->AdminDept_model->get_one_video($id);
       foreach($data['details'] as $d)
       {
         $path = $d->video_path;
         $withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $d->video_path);
          $picture_name = $withoutExt.'.png.';
          unlink($picture_name);
          unlink($path);
       }
       $this->AdminDept_model->delete_one_video($id);
     }
     redirect('AdminDept/manage_videos/'.$this->input->post('return'));
   }


  //============================ANNOUNCEMEntS===================================//
  function announcements()
  {
    $header['active_head'] = '';
    $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
    $hasunread = $this->AdminDept_model->get_unread_messages($this->session->userdata['id']);
    if($hasunread)
      $header['ihasunread'] = 1;
    else
      $header['ihasunread'] = 0;
    $data['announcements'] = $this->AdminDept_model->get_announce_bydept($this->session->userdata('department'));

    $this->load->view('AdminDept/admin_header',$header);
    $this->load->view('AdminDept/admin_announcements_modal',$data);
    $this->load->view('AdminDept/admin_announcements_edit_modal',$data);
    $this->load->view('AdminDept/admin_announcements');
  }
  function submit_announcement()
  {
	  $title      = $this->input->post('title');
		$content	  = $this->input->post('content');

		$data = array('ann_title'=>$title,
								  'ann_content'=>$content,
                  );

	  $id = $this->AdminDept_model->submit_announcement_model($data);
		$time = date("G-m-d H:i:s",time());
    $result = "";
    $use['users'] = $this->AdminDept_model->get_users();

      foreach($use['users'] as $u)
      {
        if($u->user_department == $this->session->userdata('department'))
        {
          $forinsert = array('user_read_ann'=>1);
          $this->AdminDept_model->set_user_unread_ann($u->user_id,$forinsert);
        }
      }
      $data = array('ann_id_fk'=>$id,
  								  'ann_department_fk'=>$this->session->userdata('department'),
                    );
      $this->AdminDept_model->insert_into_tblannouncement_visible($data);

		$data = array('ann_title'=>$title,
									'ann_content'=>$content,
									'ann_id'=>$id,
									'ann_time'=>$time
									);
    $data['success'] = true;
    $data['departments'] = trim($result, ',');
		echo json_encode($data);
	  //redirect(base_url().'Admin/announcements');
  }
  function get_one_announcement()
  {
    $id = $this->input->post('annID');
    $data['departments'] = $this->AdminDept_model->get_departments();
    $data['announcement'] = $this->AdminDept_model->get_one_announcement($id);

    echo json_encode($data);
  }

  function edit_one_announce()
  {
    $ID = $this->input->post('id');
    $department = $this->input->post('department');
    $this->AdminDept_model->delete_one_announce_from_visible($ID);

    $data = array('ann_title'=>$this->input->post('title'),
                  'ann_content'=>$this->input->post('content')
                );
    $this->AdminDept_model->edit_one_announce_model($ID,$data);


      $data = array('ann_id_fk'=>$ID,
  								  'ann_department_fk'=>$department,
                    );
      $this->AdminDept_model->insert_into_tblannouncement_visible($data);

    $mydata = array('id'=>$ID,
                  'title'=>$this->input->post('title'),
                  'content'=>$this->input->post('content'),
                  'timestamp'=>date("Y-m-d H:i:s", time())
                  );
    echo json_encode($mydata);

  }

  function delete_one_announce()
	{
			$ID = $this->uri->segment(3);
			$this->AdminDept_model->delete_one_announce_from_visible($ID);
			$this->AdminDept_model->delete_one_announce($ID);
			redirect(base_url().'AdminDept/announcements');
	}

  function announcements_by_dept()
  {
    $header['active_head'] = 'announcements';
    $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
    $hasunread = $this->AdminDept_model->get_unread_messages($this->session->userdata['id']);
    if($hasunread)
      $header['ihasunread'] = 1;
    else
      $header['ihasunread'] = 0;
    $data['departments'] = $this->AdminDept_model->get_departments();
    $this->load->view('AdminDept/admin_header',$header);
    $this->load->view('AdminDept/admin_announcements_view',$data);
  }

  function view_announcements_by_dept()
  {
    $header['active_head'] = '';
    $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
    $hasunread = $this->AdminDept_model->get_unread_messages($this->session->userdata['id']);
    if($hasunread)
      $header['ihasunread'] = 1;
    else
      $header['ihasunread'] = 0;
    $dept = $this->session->userdata('department');
    $data['announcements'] = $this->AdminDept_model->get_announce_bydept($dept);
    $this->load->view('AdminDept/admin_header',$header);
    $this->load->view('AdminDept/admin_announcements_dept',$data);
  }

  //=============================================FILES====================================//
  function upload_files()
  {
      $header['active_head'] = 'files';
      $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
      $hasunread = $this->AdminDept_model->get_unread_messages($this->session->userdata['id']);
      if($hasunread)
        $header['ihasunread'] = 1;
      else
        $header['ihasunread'] = 0;

      $departmentid =  $this->session->userdata('department');
      $data['foldernew'] = $this->AdminDept_model->get_folder_names_department($this->session->userdata['department']);
      $data['departments'] = $this->AdminDept_model->get_departments();
			$data['teams'] = $this->AdminDept_model->get_teams();
			$use['filetypes'] = $this->AdminDept_model->get_filetypes();
			$filetype = '';
			foreach($use['filetypes'] as $f)
			{
				$filetype = $filetype.'.'.$f->accepted_files.',';
			}
			$filetype = $filetype. 'image/*';
			$data['filetype'] = $filetype;
      $this->load->view('AdminDept/admin_header',$header);
      $this->load->view('AdminDept/admin_files_upload',$data);
  }

  function do_upload_files()
  {
      $this->load->helper('inflector');
      $foldername = $this->input->post('foldername');
      $maindept   = $this->input->post('maindept');
      $team = $this->input->post('team');
      $shareddept = explode(",",$this->input->post('shareddept'));
      $ffolder_id; //tblfiles_folder primary key

      $data['check'] = $this->AdminDept_model->check_existing_folder_department($foldername,$maindept,$team);
      if($data['check'])
      {
        foreach($data['check'] as $d)
        {
          $ffolder_id = $d->ffolder_id;
        }
      }
      else
      {
        $data = array('ffolder_name'=>$foldername,
                      'ffolder_dept_id_fk'=>$maindept,
                      'ffolder_teams_id_fk'=>$team);
        $ffolder_id = $this->AdminDept_model->insert_new_ffolder($data);
        mkdir( './assets/files/documents/'.$foldername, 0777, true);
      }

      foreach($_FILES['file']['tmp_name'] as $index => $f)
      {
      $target_dir =  './assets/files/documents/'.$foldername."/";
      $target_file = $target_dir . basename($_FILES["file"]["name"][$index]);
      $uploadOk = 1;
      $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
      $newname = humanize(preg_replace('/\\.[^.\\s]{3,4}$/', '', $_FILES["file"]["name"][$index]));
      $files_name = $_FILES["file"]["name"][$index];
      // Check if image file is a actual image or fake image
      if(isset($_POST["submit"])) {
          $check = getimagesize($_FILES["file"]["tmp_name"][$index]);
          if($check !== false) {
              echo "File is an image - " . $check["mime"] . ".";
              $uploadOk = 1;
          } else {
              echo "File is not an image.";
              $uploadOk = 0;
          }
      }
      // Check if file already exists
      if (file_exists($target_file))
      {
        $name = $_FILES['file']['name'][$index];
        $actual_name = pathinfo($name,PATHINFO_FILENAME);
        $original_name = $actual_name;
        $extension = pathinfo($name, PATHINFO_EXTENSION);

        $i = 1;
        while(file_exists($target_dir.$actual_name.".".$extension))
        {
            $actual_name = (string)$original_name.'_'.$i;
            $files_name = $actual_name;
            $target_file = $target_dir.$actual_name.".".$extension;
            $i++;
        }
        echo $target_file;
        echo '<br>';
          echo $name;
          $uploadOk = 1;
      }
      // Check file size
      if ($_FILES["file"]["size"][$index] > 5000000) {
          echo "Sorry, your file is too large.";
          $uploadOk = 0;
      }
      // Check if $uploadOk is set to 0 by an error
      if ($uploadOk == 0) {
          echo "Sorry, your file was not uploaded.";
      // if everything is ok, try to upload file
      } else {

          if (move_uploaded_file($_FILES["file"]["tmp_name"][$index], $target_file)) {
            $data = array('files_display_name'=>$newname,
                          'files_user_id_fk'=>$this->session->userdata['id'],
                           'files_name'=>$files_name,
                           'files_path'=>$target_file,
                           'files_ffolder_id_fk'=>$ffolder_id);

             $this->AdminDept_model->insert_files_document($data);
          } else {
              echo "Sorry, there was an error uploading your file.";
          }
      }
    }
    foreach($shareddept as $key => $value)
    {
      if($key == 0)
      {

      }
      else
      {
        $data = array('shared_ffolder_id_fk'=>$ffolder_id,
                      'shared_dept_id_fk'=>$value);
        $this->AdminDept_model->insert_shared_documents($data);

      }
    }

  }

	function view_archived_files()
	{
		$header['active_head'] = 'files';
		$header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
		$hasunread = $this->AdminDept_model->get_unread_messages($this->session->userdata['id']);
		if($hasunread)
			$header['ihasunread'] = 1;
		else
			$header['ihasunread'] = 0;
		$data['files'] = $this->AdminDept_model->get_deleted_archive($this->session->userdata('team'));
		$data['users'] = $this->AdminDept_model->get_users();
		$data['teams'] = $this->AdminDept_model->get_teams();

		$this->load->view('AdminDept/admin_header',$header);
		$this->load->view('AdminDept/admin_view_archived_files',$data);
	}

	function view_archive_of_archived_files()
	{
		$header['active_head'] = 'files';
		$header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
		$hasunread = $this->AdminDept_model->get_unread_messages($this->session->userdata['id']);
		if($hasunread)
			$header['ihasunread'] = 1;
		else
			$header['ihasunread'] = 0;

		$id = $this->uri->segment(3);
		$data['archive'] = $this->AdminDept_model->get_deleted_archive_by_files_id($id);
		$data['users'] = $this->AdminDept_model->get_users();

		$this->load->view('AdminDept/admin_header',$header);
		$this->load->view('AdminDept/admin_view_archive_of_archived_files',$data);
	}

  function download_one_archive_of_archive()
  {
    $id = $this->uri->segment(3);

    $data['file'] = $this->AdminDept_model->get_deleted_archive_by_files_id($id);
    foreach($data['file'] as $d)
    {
      force_download($d->archive_path, NULL);
    }

  }


	function download_one_archive()
	{
		$id = $this->uri->segment(3);

		$data['file'] = $this->AdminDept_model->get_one_deleted_archive($id);
		foreach($data['file'] as $d)
		{
			force_download($d->files_path, NULL);
		}
	}

	function delete_permanently()
	{
		$id = $this->uri->segment(3);
		$data['file'] = $this->AdminDept_model->get_one_deleted_archive($id);
		foreach($data['file'] as $d)
		{
			unlink($d->files_path);
		}
		$data['archive'] = $this->AdminDept_model->get_deleted_archive_by_files_id($id);
		foreach($data['archive'] as $d)
		{
			unlink($d->archive_path);
		}
		$this->AdminDept_model->delete_archive_by_files_id_deleted($id);
		$this->AdminDept_model->delete_one_file_deleted($id);
	}

  function view_files()
  {
      $header['active_head'] = 'files';
      $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
      $hasunread = $this->AdminDept_model->get_unread_messages($this->session->userdata['id']);
      if($hasunread)
        $header['ihasunread'] = 1;
      else
        $header['ihasunread'] = 0;
      $departmentid =  $this->session->userdata['department'];
      $team = $this->session->userdata['team'];
      $data['teams'] = $this->AdminDept_model->get_teams();
      if($this->session->userdata['team'] == 1)
      {
        $data['folders'] = $this->AdminDept_model->get_folders_dept_team($departmentid,$team);
      }
      else
      {
        $data['folders'] = $this->AdminDept_model->get_folders_dept_team($departmentid,$team);
        $data['generic'] = $this->AdminDept_model->get_folders_generic($departmentid);
      }
      $data['departmentid'] = $departmentid;
      $this->load->view('AdminDept/admin_header',$header);
      $this->load->view('AdminDept/admin_files_view1', $data);

  }
  function view_files_folder()
  {
    $header['active_head'] = 'files';
    $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
    $hasunread = $this->AdminDept_model->get_unread_messages($this->session->userdata['id']);
    if($hasunread)
      $header['ihasunread'] = 1;
    else
      $header['ihasunread'] = 0;
    $id = $this->uri->segment(3);
    $data['files'] = $this->AdminDept_model->get_files_folder($id);
    $this->load->view('AdminDept/admin_header',$header);
    $this->load->view('AdminDept/admin_files_view_folder',$data);
  }

  function load_folders()
  {
    $departmentid = $this->uri->segment(3);
    $data['folders'] = $this->AdminDept_model->get_folders_dept($departmentid);
    $data['departmentid'] = $departmentid;
    $this->load->view('AdminDept/Admin_files_folders_loading', $data);
  }

  function load_files()
  {
    $folderid = $this->uri->segment(3);
    $data['files'] = $this->AdminDept_model->get_files_folder($folderid);
    $data['departmentid'] = $this->session->userdata['department'];

    $get['foldername'] = $this->AdminDept_model->get_folder_name($folderid);
    foreach($get['foldername'] as $f)
    {
      $data['foldername'] = $f->ffolder_name;
      break;
    }
    $data['folderid'] = $folderid;
    $data['users'] = $this->AdminDept_model->get_user_names();
    $this->load->view('AdminDept/admin_files_edit_modal');
    $this->load->view('AdminDept/Admin_files_content_loading', $data);
  }

  function get_one_file()
  {
    $file_id = $this->uri->segment(3);
    $use['file'] = $this->AdminDept_model->get_one_file($file_id);
    foreach($use['file'] as $f)
    {
      $use['folder'] = $this->AdminDept_model->get_folder_name($f->files_ffolder_id_fk);
      foreach($use['folder'] as $u)
      {
          $foldername = $u->ffolder_name;
      }
      $data = array('id'=>$f->files_id,
                    'path'=>$f->files_path,
                    'display_name'=>$f->files_display_name,
                     'foldername'=>$foldername);
      break;
    }
    echo json_encode($data);
  }
  function delete_one_file()
  {
    $id = $this->uri->segment(3);

    $data['file'] = $this->AdminDept_model->get_one_file($id);
    $data['teams'] = $this->AdminDept_model->get_teams();
    foreach($data['file'] as $d)
    {
      foreach($data['teams'] as $t)
      {
        if($d->ffolder_teams_id_fk == $t->teams_id)
        {
          $teamid = $t->teams_id;
        }
      }
      $data = array('files_display_name'=>$d->files_display_name,
                    'files_deletedby'=>$this->session->userdata['id'],
                    'files_last_updated'=>$d->files_user_id_fk,
                     'files_name'=>$d->files_name,
                     'files_path'=>$d->files_path,
                     'files_foldername'=>$d->ffolder_name,
                      'files_version'=>$d->files_version,
                      'files_team_id_fk'=>$teamid);
    $archiveid = $this->AdminDept_model->insert_tblfiles_deleted($data);
    }
    $data['archive'] = $this->AdminDept_model->get_archive_by_files_id($id);
    foreach($data['archive'] as $d)
    {
			$data = array('archive_path'=>$d->archive_path,
										'archive_display_name'=>$d->archive_display_name,
										'archive_version'=>$d->archive_version,
										'archive_user_id_fk'=>$d->archive_user_id_fk,
										'archive_timestamp'=>$d->archive_timestamp,
										'archive_files_id_fk'=>$archiveid);
			$this->AdminDept_model->insert_tblfiles_archive_deleted($data);
    }
    $this->AdminDept_model->delete_archive_by_files_id($id);
    $this->AdminDept_model->delete_one_file($id);
  }

  function download_one_file()
  {
    $id = $this->uri->segment(3);

    $data['file'] = $this->AdminDept_model->get_one_file($id);
    foreach($data['file'] as $d)
    {
      force_download($d->files_path, NULL);
    }
  }

  function do_update_one_file()
  {
    $filechanged = $this->input->post('filechanged');

    $displayname = $this->input->post('displayname');
    $revision = $this->input->post('revision');
    $foldername = $this->input->post('foldername');
    $currentfileID = $this->input->post('old_file_id');
    $name = $this->input->post('name');

    if($filechanged == 1)
    {
      $target_dir =  './assets/files/documents/'.$foldername."/";

      $config['upload_path'] = $target_dir;
      $config['allowed_types'] = '*';

      $this->load->library('upload', $config);

      if (!$this->upload->do_upload('file'))
      {
          $status = 'error';
          $msg = $this->upload->display_errors('', '');
      }
      else
      {
          $success = array('upload_data' => $this->upload->data());

          $use['oldfile'] = $this->AdminDept_model->get_one_file($currentfileID);
          foreach($use['oldfile'] as $u)
          {
            $data = array('archive_path'=>$u->files_path,
                          'archive_display_name'=>$u->files_display_name,
                          'archive_version'=>$u->files_version,
                          'archive_user_id_fk'=>$u->files_user_id_fk,
                          'archive_timestamp'=>$u->files_timestamp,
                          'archive_files_id_fk'=>$u->files_id);
            $ffolder_id = $u->files_ffolder_id_fk;
            $files_id = $u->files_id;
            $current_version = $u->files_version;
          }

          $this->AdminDept_model->insert_file_archive($data);
          $final_version = '';
          if($revision == 0)
          {
            $add_version = 0.01;
            $added_version = $current_version + $add_version;
            $final_version = number_format($added_version, 2, '.' ,'');
          }
          else
          {
            $whole = floor($current_version);
            $decimal = $current_version - $whole;

            if($decimal == 0)
            {
            	$current_version += 0.01;
            	$final_version =  number_format(ceil($current_version), 1, '.' ,'');
            }
            else
            {
            	$final_version =  number_format(ceil($current_version), 1, '.' ,'');
            }
          }

          $data = array('files_display_name'=>$displayname,
                        'files_version'=>$final_version,
                        'files_user_id_fk'=>$this->session->userdata['id'],
                         'files_name'=>$success['upload_data']['file_name'],
                         'files_path'=>$success['upload_data']['full_path']);

           $this->AdminDept_model->update_file_contents($data,$files_id);

      }
      if($this->input->post('shared') == 1)
      {
        $isshared = 1;
      }
      else
      {
        $isshared = 0;
      }
      echo json_encode(array('isshared' => $isshared,'id' => $currentfileID, 'displayname' => $displayname, 'version' => $final_version, 'updatedname' =>"<p class=\"help-block\">Updated by:<a href=\"".base_url()."AdminDept/view_other_profile/{$this->session->userdata['id']}\">{$this->session->userdata['firstname']} {$this->session->userdata['lastname']}</a></p>"));
    }
    else
    {
      $use['oldfile'] = $this->AdminDept_model->get_one_file($currentfileID);
      foreach($use['oldfile'] as $u)
      {
        $current_version = $u->files_version;
      }
      $data = array('files_display_name'=>$displayname);

      $this->AdminDept_model->update_file_contents($data,$currentfileID);
      if($this->input->post('shared') == 1)
      {
        $isshared = 1;
      }
      else
      {
        $isshared = 0;
      }
      echo json_encode(array('isshared' => $isshared,'id' => $currentfileID, 'displayname' => $displayname, 'version' => $final_version, 'updatedname' =>"<p class=\"help-block\">Updated by:<a href=\"".base_url()."AdminDept/view_other_profile/{$this->session->userdata['id']}\">{$this->session->userdata['firstname']} {$this->session->userdata['lastname']}</a></p>"));
    }
  }

  function load_archive()
  {
    $filesid = $this->uri->segment(3);
    $data['archive'] = $this->AdminDept_model->get_files_archive($filesid);
    $data['departmentid'] = $this->uri->segment(4);
    $data['folderid'] = $this->uri->segment(5);
    $data['users'] = $this->AdminDept_model->get_user_names();
    $this->load->view('AdminDept/admin_files_archive', $data);
  }

  function download_one_file_archive()
  {
    $id = $this->uri->segment(3);

    $data['file'] = $this->AdminDept_model->get_one_file_archive($id);
    foreach($data['file'] as $d)
    {
      force_download($d->archive_path, NULL);
    }
  }

  function delete_one_file_archive()
  {
    $id = $this->uri->segment(3);

    $data['file'] = $this->AdminDept_model->get_one_file_archive($id);
    foreach($data['file'] as $d)
    {
      unlink($d->archive_path);
    }
    $this->AdminDept_model->delete_one_file_archive($id);
  }

  function delete_folder_files()
  {
    $id = $this->uri->segment(3);

    $archivednumbers = array();

    $data['unlinkfiles'] = $this->AdminDept_model->get_all_files_by_folder($id);
    foreach($data['unlinkfiles'] as $u)
    {
      if($u->files_version == 1.0){}
      else
      {
        $archivednumbers[] = $u->files_id;
      }
    }

    if($archivednumbers)
    {
      foreach($archivednumbers as $i)
      {
        $data['archive'] = $this->AdminDept_model->get_archive_by_files_id($i);
        foreach($data['archive'] as $a)
        {
          unlink($a->archive_path);
          $this->AdminDept_model->delete_archive_by_files_id($i);
        }
      }
    }

    foreach($data['unlinkfiles'] as $u)
    {
      unlink($u->files_path);
    }

    $this->AdminDept_model->delete_files_by_folder($id);
    $this->AdminDept_model->delete_shared_by_folder($id);
    $this->AdminDept_model->delete_folder($id);
  }

  function view_shared_files()
  {
    $header['active_head'] = 'files';
    $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
    $hasunread = $this->AdminDept_model->get_unread_messages($this->session->userdata['id']);
    if($hasunread)
      $header['ihasunread'] = 1;
    else
      $header['ihasunread'] = 0;
    $data['files'] = $this->AdminDept_model->get_shared_files($this->session->userdata['department']);
    $data['users'] = $this->AdminDept_model->get_user_names();
    $data['departments'] = $this->AdminDept_model->get_departments();

    $this->load->view('AdminDept/admin_header',$header);
    $this->load->view('AdminDept/admin_files_shared_view',$data);
    $this->load->view('AdminDept/admin_files_edit_modal');
  }

  function view_shared_archive()
  {
    $header['active_head'] = 'files';
    $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
    $hasunread = $this->AdminDept_model->get_unread_messages($this->session->userdata['id']);
    if($hasunread)
      $header['ihasunread'] = 1;
    else
      $header['ihasunread'] = 0;
    $filesid = $this->uri->segment(3);
    $data['archive'] = $this->AdminDept_model->get_files_archive($filesid);
    $data['departmentid'] = $this->uri->segment(4);
    $data['folderid'] = $this->uri->segment(5);
    $data['users'] = $this->AdminDept_model->get_user_names();
    $this->load->view('AdminDept/admin_header',$header);
    $this->load->view('AdminDept/admin_files_shared_archive', $data);
  }

  //================================POLICIES======================//
  function policies()
  {
    $header['active_head'] = 'policies';
    $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
    $hasunread = $this->AdminDept_model->get_unread_messages($this->session->userdata['id']);
    if($hasunread)
      $header['ihasunread'] = 1;
    else
      $header['ihasunread'] = 0;
    $data['policies'] = $this->AdminDept_model->get_policies_table();
    $data['sub1'] = $this->AdminDept_model->get_sub1_table();
    $data['sub2'] = $this->AdminDept_model->get_sub2_table();
    $data['sub3'] = $this->AdminDept_model->get_sub3_table();

    $this->load->view('AdminDept/admin_header',$header);
    $this->load->view('AdminDept/admin_policies_create_page_modal');
    $this->load->view('AdminDept/admin_policies_create_sub1_modal');
    $this->load->view('AdminDept/admin_policies_create_sub2_modal');
    $this->load->view('AdminDept/admin_policies_create_sub3_modal');
    $this->load->view('AdminDept/admin_policies_view',$data);
  }

  function create_main_policy_page()
  {
    $header['active_head'] = 'policies';
    $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
    $hasunread = $this->AdminDept_model->get_unread_messages($this->session->userdata['id']);
    if($hasunread)
      $header['ihasunread'] = 1;
    else
      $header['ihasunread'] = 0;
    $title = $this->input->post('title');

    $data = array('policy_title'=>$title);
    $id =  $this->AdminDept_model->insert_policy_title($data);

    redirect('AdminDept/edit_main_policy_page/'.$id);
  }

  function edit_main_policy_page()
  {
    $header['active_head'] = 'policies';
    $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
    $hasunread = $this->AdminDept_model->get_unread_messages($this->session->userdata['id']);
    if($hasunread)
      $header['ihasunread'] = 1;
    else
      $header['ihasunread'] = 0;
    $id = $this->uri->segment(3);

    $data['detail'] = $this->AdminDept_model->get_policy_details($id);

    foreach($data['detail'] as $d)
    {
      $data['title'] = $d->policy_title;
      $data['content'] = $d->policy_content;
    }
    $data['id'] = $id;
    $data['function'] = 'update_main_page_policy';

    $this->load->view('AdminDept/admin_header',$header);
    $this->load->view('AdminDept/admin_policies_create_main',$data);
  }

  function update_main_page_policy()
  {
    $data = array('policy_content'=>$this->input->post('content'));
    $policy_id = $this->input->post('policy_id');

    $this->AdminDept_model->update_main_page_policy($data,$policy_id);
    redirect('AdminDept/policies');
  }

  function view_main_page_policy()
  {
    $header['active_head'] = 'policies';
    $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
    $hasunread = $this->AdminDept_model->get_unread_messages($this->session->userdata['id']);
    if($hasunread)
      $header['ihasunread'] = 1;
    else
      $header['ihasunread'] = 0;
    $id = $this->uri->segment(3);

    $use['content'] = $this->AdminDept_model->get_policy_details($id);

    foreach($use['content'] as $d)
    {
      $data['title'] = $d->policy_title;
      $data['content'] = $d->policy_content;
    }

    $this->load->view('AdminDept/admin_header',$header);
    $this->load->view('AdminDept/admin_policies_view_page',$data);
  }

  function delete_one_policy()
  {
    $policy_id = $this->uri->segment(3);
    $subtable = $this->uri->segment(4);

    if($subtable == 3)
    {
      $this->AdminDept_model->delete_tblpolicies_sub3($policy_id);
    }
    if($subtable == 2)
    {
      $this->AdminDept_model->delete_tblpolicies_sub3_fk_sub2($policy_id);
      $this->AdminDept_model->delete_tblpolicies_sub2($policy_id);
    }
    if($subtable == 1)
    {
      $data['sub2'] = $this->AdminDept_model->get_sub2_ids_fk_sub1($policy_id);
      foreach($data['sub2'] as $s2)
      {
        $this->AdminDept_model->delete_tblpolicies_sub3_fk_sub2($s2->sub2_id);
      }
      $this->AdminDept_model->delete_tblpolicies_sub2_fk_sub1($policy_id);
      $this->AdminDept_model->delete_tblpolicies_sub1($policy_id);
    }
    if($subtable == 0)
    {
      $data['sub1'] = $this->AdminDept_model->get_sub1_ids_fk_policies($policy_id);
      foreach($data['sub1'] as $s1)
      {
        $data['sub2'] = $this->AdminDept_model->get_sub2_ids_fk_sub1($s1->sub1_id);
        foreach($data['sub2'] as $s2)
        {
          $this->AdminDept_model->delete_tblpolicies_sub3_fk_sub2($s2->sub2_id);
        }
        $this->AdminDept_model->delete_tblpolicies_sub2_fk_sub1($s1->sub1_id);
      }
      $this->AdminDept_model->delete_tblpolicies_sub1_fk_policies($policy_id);
      $this->AdminDept_model->delete_tblpolicies($policy_id);
    }
  }

  //===========================POLICIES SUB 1=========================//
  function create_sub1_policy_page()
  {
    $header['active_head'] = 'policies';
    $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
    $hasunread = $this->AdminDept_model->get_unread_messages($this->session->userdata['id']);
    if($hasunread)
      $header['ihasunread'] = 1;
    else
      $header['ihasunread'] = 0;

    $data = array('sub1_title'=>$this->input->post('title'),
                  'policy_id_fk'=>$this->input->post('policy_id_fk'));
    $id =  $this->AdminDept_model->insert_sub1_title($data);

    redirect('AdminDept/edit_sub1_policy_page/'.$id);
  }

  function edit_sub1_policy_page()
  {
    $header['active_head'] = 'policies';
    $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
    $hasunread = $this->AdminDept_model->get_unread_messages($this->session->userdata['id']);
    if($hasunread)
      $header['ihasunread'] = 1;
    else
      $header['ihasunread'] = 0;
    $id = $this->uri->segment(3);

    $data['detail'] = $this->AdminDept_model->get_sub1_details($id);

    foreach($data['detail'] as $d)
    {
      $data['title'] = $d->sub1_title;
      $data['content'] = $d->sub1_content;
    }
    $data['id'] = $id;
    $data['function'] = 'update_sub1_page_policy';

    $this->load->view('AdminDept/admin_header',$header);
    $this->load->view('AdminDept/admin_policies_create_main',$data);
  }

  function update_sub1_page_policy()
  {
    $data = array('sub1_content'=>$this->input->post('content'));
    $id = $this->input->post('policy_id');

    $this->AdminDept_model->update_sub1_page_policy($data,$id);
    redirect('AdminDept/policies');
  }

  function view_sub1_page_policy()
  {
    $header['active_head'] = 'policies';
    $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
    $hasunread = $this->AdminDept_model->get_unread_messages($this->session->userdata['id']);
    if($hasunread)
      $header['ihasunread'] = 1;
    else
      $header['ihasunread'] = 0;
    $id = $this->uri->segment(3);

    $use['content'] = $this->AdminDept_model->get_sub1_details($id);
    foreach($use['content'] as $d)
    {
      $data['title'] = $d->sub1_title;
      $data['content'] = $d->sub1_content;
    }

    $this->load->view('AdminDept/admin_header',$header);
    $this->load->view('AdminDept/admin_policies_view_page',$data);
  }

  //===========================POLICIES SUB 2=========================//
  function create_sub2_policy_page()
  {
    $header['active_head'] = 'policies';
    $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
    $hasunread = $this->AdminDept_model->get_unread_messages($this->session->userdata['id']);
    if($hasunread)
      $header['ihasunread'] = 1;
    else
      $header['ihasunread'] = 0;

    $data = array('sub2_title'=>$this->input->post('title'),
                  'sub1_id_fk'=>$this->input->post('policy_id_fk'));
    $id =  $this->AdminDept_model->insert_sub2_title($data);

    redirect('AdminDept/edit_sub2_policy_page/'.$id);
  }

  function edit_sub2_policy_page()
  {
    $header['active_head'] = 'policies';
    $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
    $hasunread = $this->AdminDept_model->get_unread_messages($this->session->userdata['id']);
    if($hasunread)
      $header['ihasunread'] = 1;
    else
      $header['ihasunread'] = 0;
    $id = $this->uri->segment(3);

    $data['detail'] = $this->AdminDept_model->get_sub2_details($id);

    foreach($data['detail'] as $d)
    {
      $data['title'] = $d->sub2_title;
      $data['content'] = $d->sub2_content;
    }
    $data['id'] = $id;
    $data['function'] = 'update_sub2_page_policy';

    $this->load->view('AdminDept/admin_header',$header);
    $this->load->view('AdminDept/admin_policies_create_main',$data);
  }

  function update_sub2_page_policy()
  {
    $data = array('sub2_content'=>$this->input->post('content'));
    $id = $this->input->post('policy_id');

    $this->AdminDept_model->update_sub2_page_policy($data,$id);
    redirect('AdminDept/policies');
  }

  function view_sub2_page_policy()
  {
    $header['active_head'] = 'policies';
    $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
    $hasunread = $this->AdminDept_model->get_unread_messages($this->session->userdata['id']);
    if($hasunread)
      $header['ihasunread'] = 1;
    else
      $header['ihasunread'] = 0;
    $id = $this->uri->segment(3);

    $use['content'] = $this->AdminDept_model->get_sub2_details($id);
    foreach($use['content'] as $d)
    {
      $data['title'] = $d->sub2_title;
      $data['content'] = $d->sub2_content;
    }

    $this->load->view('AdminDept/admin_header',$header);
    $this->load->view('AdminDept/admin_policies_view_page',$data);
  }

  //===========================POLICIES SUB 2=========================//
  function create_sub3_policy_page()
  {
    $header['active_head'] = 'policies';
    $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
    $hasunread = $this->AdminDept_model->get_unread_messages($this->session->userdata['id']);
    if($hasunread)
      $header['ihasunread'] = 1;
    else
      $header['ihasunread'] = 0;

    $data = array('sub3_title'=>$this->input->post('title'),
                  'sub2_id_fk'=>$this->input->post('policy_id_fk'));
    $id =  $this->AdminDept_model->insert_sub3_title($data);

    redirect('AdminDept/edit_sub3_policy_page/'.$id);
  }

  function edit_sub3_policy_page()
  {
    $header['active_head'] = 'policies';
    $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
    $hasunread = $this->AdminDept_model->get_unread_messages($this->session->userdata['id']);
    if($hasunread)
      $header['ihasunread'] = 1;
    else
      $header['ihasunread'] = 0;
    $id = $this->uri->segment(3);

    $data['detail'] = $this->AdminDept_model->get_sub3_details($id);

    foreach($data['detail'] as $d)
    {
      $data['title'] = $d->sub3_title;
      $data['content'] = $d->sub3_content;
    }
    $data['id'] = $id;
    $data['function'] = 'update_sub3_page_policy';

    $this->load->view('AdminDept/admin_header',$header);
    $this->load->view('AdminDept/admin_policies_create_main',$data);
  }

  function update_sub3_page_policy()
  {
    $data = array('sub3_content'=>$this->input->post('content'));
    $id = $this->input->post('policy_id');

    $this->AdminDept_model->update_sub3_page_policy($data,$id);
    redirect('AdminDept/policies');
  }

  function view_sub3_page_policy()
  {
    $header['active_head'] = 'policies';
    $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
    $hasunread = $this->AdminDept_model->get_unread_messages($this->session->userdata['id']);
    if($hasunread)
      $header['ihasunread'] = 1;
    else
      $header['ihasunread'] = 0;
    $id = $this->uri->segment(3);

    $use['content'] = $this->AdminDept_model->get_sub3_details($id);
    foreach($use['content'] as $d)
    {
      $data['title'] = $d->sub3_title;
      $data['content'] = $d->sub3_content;
    }

    $this->load->view('AdminDept/admin_header',$header);
    $this->load->view('AdminDept/admin_policies_view_page',$data);
  }


}
