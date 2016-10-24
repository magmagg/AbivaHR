
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller
{
	function __construct()
	{
    parent::__construct();

    if($this->session->userdata('logged_in') == 1)
    {
      $this->load->model('Admin_model');
    }
    else
    {
      if($this->session->flashdata('username'))
      {
        $this->load->model('Admin_model');
        $username = $this->session->flashdata('username');
        $data['details'] = $this->Admin_model->get_user_details($username);
        foreach($data['details'] as $row)
        {

          $remove = getcwd();
          if (strpos($row->user_picture, $remove) === 0)
           {
              $picture = substr($row->user_picture, strlen($remove));
            }

        $sessiondata = array('id'=>$row->user_id,
                            'user_name'=>$row->user_username,
                            'firstname'=>$row->user_firstname,
                             'middlename'=>$row->user_middlename,
                             'lastname'=>$row->user_lastname,
                             'department'=>$row->user_department,
                             'picture'=>$picture,
                             'logged_in'=>true
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

  function index()
  {
    $header['active_head'] = '';
    $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
    $this->session->set_flashdata('notify',"<script>
    		new PNotify({
        title: 'Regular Success',
        text: 'That thing that you were trying to do worked!',
        type: 'success'
    	});
    </script>");
    $this->load->view('Admin/admin_header',$header);
    $this->load->view('Admin/admin_index');
  }
  //============================PROFILE===================================//
  function user_profile()
  {
    $header['active_head'] = '';
    $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");


    $ID = $this->session->userdata['id'];
		$data['userDetails'] = $this->Admin_model->get_one_user($ID);
      //var_dump($this->session->all_userdata());
    $this->load->view('Admin/admin_header',$header);
    $this->load->view('Admin/admin_user_profile',$data);
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
          $this->Admin_model->edit_one_user_profile($data, $id);
        //var_dump($check);
        redirect(base_url().'Admin/user_profile');
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
                              'user_picture'=>$success['upload_data']['full_path']
                            );

                            $remove = getcwd();
                            if (strpos($success['upload_data']['full_path'], $remove) === 0)
                             {
                                $picture = substr($success['upload_data']['full_path'], strlen($remove));
                              }

                            $this->session->set_userdata('username',$username);
                            $this->session->set_userdata('firstname',$firstname);
                            $this->session->set_userdata('middlename',$middlename);
                            $this->session->set_userdata('lastname',$lastname);
                            $this->session->set_userdata('picture',$picture);

                            var_dump($success);
                            $this->Admin_model->edit_one_user_profile($data, $id);
                            redirect(base_url().'Admin/user_profile');
                            print_r($this->session->all_userdata());
              }
      }

      }
      /*error: napapalitan password with the same passwor as new*/
      function change_password()
    	{
    		$data['password'] = $this->Admin_model->check_password($this->input->post('userid'));
    		if($data['password'])
    		{
    			foreach($data['password'] as $h)
    			{
    				$hash = $h->user_password;
    			}

    				if (password_verify($this->input->post('oldpassword'), $hash))
    				{

              $id = $this->input->post('userid');
              $data = array('user_password'=>password_hash($this->input->post('newpassword'), PASSWORD_DEFAULT));

              $this->Admin_model->update_password($data,$id);

              echo 1;
    	       }else
              {
                echo 0;
          		}
    	}

  }
  //============================MESSAGES===================================//
  function messages()
  {
    $header['active_head'] = 'messages';
    $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");

    $data['recipients'] = $this->Admin_model->get_list_employees();

    $this->load->view('Admin/admin_header',$header);
    $this->load->view('Admin/admin_messages',$data);
  }

  function do_message()
  {
    $id =$this->Admin_model->get_thread_number();

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

    $this->Admin_model->submit_one_message($data, $id);

  }

  //============================EMPLOYEES===================================//
  function employees()
  {
    $header['active_head'] = 'employees';
    $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
    $data['employees'] = $this->Admin_model->get_employees();

    //Should be row id
    $ID = $this->session->userdata('id');
		$data_modal['employee'] = $this->Admin_model->get_one_employee($ID);
    $data_modal['departments'] = $this->Admin_model->get_departments();

    $this->load->view('Admin/admin_header',$header);
    $this->load->view('Admin/admin_employee_edit_modal',$data_modal);
    $this->load->view('Admin/admin_employees_view',$data);

  }

  function edit_one_employee()
  {
    $header['active_head'] = 'employees';
    $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
    $ID = $this->uri->segment(3);
		$data['employee'] = $this->Admin_model->get_one_employee($ID);
    $data['departments'] = $this->Admin_model->get_departments();

    $this->load->view('Admin/admin_header',$header);
    $this->load->view('Admin/admin_employee_edit_one',$data);
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

    $this->Admin_model->submit_one_employee($data, $id);

    $this->session->set_flashdata('notify',"<script>
        new PNotify({
        title: 'Success!',
        text: 'Employee has been edited',
        type: 'success'
      });
    </script>");


    redirect(base_url().'Admin/employees');
  }

  function delete_one_employee()
	{
			$ID = $this->uri->segment(3);
			$this->Admin_model->delete_one_employee($ID);
			redirect(base_url().'Admin/employees');
	}

function add_employees()
{
  $header['active_head'] = 'employees';
  $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
  $data['departments'] = $this->Admin_model->get_departments();

  $this->load->view('Admin/admin_header',$header);
  $this->load->view('Admin/admin_employees_add',$data);
}

function submit_add_employee()
{
  $data = array('user_firstname'=>$this->input->post('firstname'),
                'user_middlename'=>$this->input->post('middlename'),
                'user_lastname'=>$this->input->post('lastname'),
                'user_username'=>$this->input->post('username'),
                'user_password'=>password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'user_department'=>$this->input->post('department'),
                'user_picture'=>getcwd()."/assets/images/avatars/avatar2.png",
                'user_isadmin'=>0
              );

  $duplicate_username = $this->Admin_model->check_username_duplicate($this->input->post('username'));
  if($duplicate_username)
  {
    echo 0;
  }
  else
  {
     $this->Admin_model->insert_user($data);
      echo 1;
  }
}

function deactivate_user()
{
  $ID = $this->uri->segment(3);
  $data = array('user_active'=>0);
  $this->Admin_model->process_activation($data,$ID);
}

function activate_user()
{
  $ID = $this->uri->segment(3);
  $data = array('user_active'=>1);
  $this->Admin_model->process_activation($data,$ID);
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
            $data['departments'] = $this->Admin_model->get_departments();
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
                                        'user_picture'=>getcwd()."/assets/images/avatars/avatar2.png",
                                        'user_isadmin'=>1
                                      );
                    $this->Admin_model->insert_user($insert_data);
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
    $data['gallery'] = $this->Admin_model->get_all_gallery();
    $this->load->view('Admin/admin_header',$header);
    $this->load->view('Admin/admin_gallery',$data);
  }

  function view_gallery()
  {
    $header['active_head'] = 'gallery';
    $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
    $id = $this->uri->segment(3);
    $data['gallery'] = $this->Admin_model->get_specific_gallery($id);
    foreach($data['gallery'] as $d)
    {
      $data['galleryname'] = $d->gfolder_name;
    }
    $data['galleryid'] = $id;
    $this->load->view('Admin/admin_header',$header);
    $this->load->view('Admin/admin_gallery_view',$data);
  }

  function upload_pictures()
  {
    $header['active_head'] = 'gallery';
    $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
    $use['gallery'] = $this->Admin_model->get_gallery_names();
    $data['gallery'] = array();
    foreach($use['gallery'] as $key => $value)
    {
      $data['gallerynew'][] = $value->gfolder_name;
    }

    $use['galleryid'] = $this->uri->segment(3);
    $use['galleryname'] = $this->Admin_model->get_gallery_name($use['galleryid']);
    foreach($use['galleryname'] as $u)
    {
      $data['galleryname'] = $u->gfolder_name;
    }
    $this->load->view('Admin/admin_header',$header);
    $this->load->view('Admin/admin_gallery_upload', $data);
  }


  function do_Upload_gallery()
   {
     $this->load->helper('inflector');
     $gallery = $this->input->post('gallery');
     $count = 1;
     $data['check'] = $this->Admin_model->check_existing_gallery($gallery);
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
       $gfolder_id = $this->Admin_model->insert_new_gfolder($data);
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
     // Check file size
     if ($_FILES["file"]["size"][$index] > 500000) {
         echo "Sorry, your file is too large.";
         $uploadOk = 0;
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
                            'gfolder_id_fk'=>$gfolder_id);

              $this->Admin_model->insert_gallery_pictures($data);
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
       $data['details'] = $this->Admin_model->get_one_picture($id);
       foreach($data['details'] as $d)
       {
         $path = $d->picture_path;
       }
       unlink($path);
       $this->Admin_model->delete_one_picture_model($id);
     }

  //===============================VIDEOS=======================================//
  function upload_videos()
  {
    $header['active_head'] = 'gallery';
    $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
    $use['vfolder_name'] = $this->Admin_model->get_videos_folder();
    $data['vfolder_name'] = array();
    foreach($use['vfolder_name'] as $key => $value)
    {
      $data['vfolder_name'][] = $value->vfolder_name;
    }

    $use['vfolder_id'] = $this->uri->segment(3);
    $use['vfoldername'] = $this->Admin_model->get_videos_folder_name($use['vfolder_id']);
    foreach($use['vfoldername'] as $u)
    {
      $data['vfoldername'] = $u->vfolder_name;
    }
    $this->load->view('Admin/admin_header',$header);
    $this->load->view('Admin/admin_videos_upload', $data);
  }

  function do_upload_videos()
   {
     $this->load->helper('inflector');
     $videofolder = $this->input->post('gallery');
     $count = 1;
     $data['check'] = $this->Admin_model->check_existing_video_folder($videofolder);
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
       $vfolder_id = $this->Admin_model->insert_new_vfolder($data);
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
                            'vfolder_id_fk'=>$vfolder_id);

              $this->Admin_model->insert_videos($data);
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
     $data['videos'] = $this->Admin_model->get_all_videos();
     $this->load->view('Admin/admin_header',$header);
     $this->load->view('Admin/admin_videos',$data);
   }

   function view_videos()
   {
     $header['active_head'] = 'gallery';
     $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
     $id = $this->uri->segment(3);
     $data['videos'] = $this->Admin_model->get_specific_videos($id);
     foreach($data['videos'] as $d)
     {
       $data['galleryname'] = $d->vfolder_name;
     }
     $data['galleryid'] = $id;
     $this->load->view('Admin/admin_header',$header);
     $this->load->view('Admin/admin_videos_view',$data);
   }

  //============================ANNOUNCEMEntS===================================//
  function announcements()
  {
    $header['active_head'] = '';
    $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
    $data['departments'] = $this->Admin_model->get_departments();
    $data['announcements'] = $this->Admin_model->get_announce();

    $this->load->view('Admin/admin_header',$header);
    $this->load->view('Admin/admin_announcements_modal',$data);
    $this->load->view('Admin/admin_announcements_edit_modal',$data);
    $this->load->view('Admin/admin_announcements');
  }

  function submit_announcement()
  {
	  $title      = $this->input->post('title');
		$content	  = $this->input->post('content');

		$data = array('ann_title'=>$title,
								  'ann_content'=>$content,
                  );

	  $id = $this->Admin_model->submit_announcement_model($data);
		$time = date("G-m-d H:i:s",time());

    foreach ($this->input->post('departments') as $d)
    {
      $data = array('ann_id_fk'=>$id,
  								  'ann_department_fk'=>$d,
                    );
      $this->Admin_model->insert_into_tblannouncement_visible($data);
    }

		$data = array('ann_title'=>$title,
									'ann_content'=>$content,
									'ann_id'=>$id,
									'ann_time'=>$time
									);
		echo json_encode($data);

	  //redirect(base_url().'Admin/announcements');
  }
  function get_one_announcement()
  {
    $id = $this->input->post('annID');
    $data['departments'] = $this->Admin_model->get_departments();
    $data['announcement'] = $this->Admin_model->get_one_announcement($id);

    echo json_encode($data);
  }

  function edit_one_announce()
  {
    $ID = $this->input->post('id');
    $this->Admin_model->delete_one_announce_from_visible($ID);

    $data = array('ann_title'=>$this->input->post('title'),
                  'ann_content'=>$this->input->post('content')
                );
    $this->Admin_model->edit_one_announce_model($ID,$data);

    foreach ($this->input->post('departments') as $d)
    {
      $data = array('ann_id_fk'=>$ID,
  								  'ann_department_fk'=>$d,
                    );
      $this->Admin_model->insert_into_tblannouncement_visible($data);
    }
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
			$this->Admin_model->delete_one_announce_from_visible($ID);
			$this->Admin_model->delete_one_announce($ID);
			redirect(base_url().'Admin/announcements');
	}

  function announcements_by_dept()
  {
    $header['active_head'] = 'announcements';
    $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
    $data['departments'] = $this->Admin_model->get_departments();
    $this->load->view('Admin/admin_header',$header);
    $this->load->view('Admin/admin_announcements_view',$data);
  }

  function view_announcements_by_dept()
  {
    $header['active_head'] = '';
    $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
    $dept = $this->uri->segment(3);
    $data['announcements'] = $this->Admin_model->get_announce_bydept($dept);
    $this->load->view('Admin/admin_header',$header);
    $this->load->view('Admin/admin_announcements_dept',$data);
  }

  //=============================================FILES====================================//
  function upload_files()
  {
      $header['active_head'] = 'files';
      $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
      $data['foldernew'] = $this->Admin_model->get_folder_names();
      /*
      $data['foldernew'] = array();
      foreach($use['folder'] as $key => $value)
      {
        $data['foldernew'][] = $value->ffolder_name;
      }
      */
      $data['departments'] = $this->Admin_model->get_departments();
      $this->load->view('Admin/admin_header',$header);
      $this->load->view('Admin/admin_files_upload',$data);
  }

  function do_upload_files()
  {
      $this->load->helper('inflector');
      $foldername = $this->input->post('foldername');
      $maindept   = $this->input->post('maindept');
      $shareddept = explode(",",$this->input->post('shareddept'));
      $ffolder_id; //tblfiles_folder primary key

      $data['check'] = $this->Admin_model->check_existing_folder_department($foldername,$maindept);
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
                      'ffolder_dept_id_fk'=>$maindept);
        $ffolder_id = $this->Admin_model->insert_new_ffolder($data);
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

             $this->Admin_model->insert_files_document($data);
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
        $this->Admin_model->insert_shared_documents($data);

      }
    }

  }

  function view_files()
  {
      $header['active_head'] = 'files';
      $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");

      $data['departments'] = $this->Admin_model->get_dept_with_files();

      $indicator = $this->uri->segment(3);
      if($indicator == 1){
      $this->session->set_flashdata('notify',"<script>
          new PNotify({
          title: 'Success!',
          text: 'File has been uploaded',
          type: 'success'
        });
      </script>");
      }
      $this->load->view('Admin/admin_header',$header);
      $this->load->view('Admin/admin_files_view',$data);

  }
  function view_files_folder()
  {
    $header['active_head'] = 'files';
    $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");

    $id = $this->uri->segment(3);
    $data['files'] = $this->Admin_model->get_files_folder($id);
    $this->load->view('Admin/admin_header',$header);
    $this->load->view('Admin/admin_files_view_folder',$data);
  }

  function load_folders()
  {
    $departmentid = $this->uri->segment(3);
    $data['folders'] = $this->Admin_model->get_folders_dept($departmentid);
    $data['departmentid'] = $departmentid;
    $this->load->view('Admin/Admin_files_folders_loading', $data);
  }

  function load_files()
  {
    $folderid = $this->uri->segment(3);
    $data['files'] = $this->Admin_model->get_files_folder($folderid);
    $data['departmentid'] = $this->uri->segment(4);

    $get['foldername'] = $this->Admin_model->get_folder_name($folderid);
    foreach($get['foldername'] as $f)
    {
      $data['foldername'] = $f->ffolder_name;
      break;
    }
    $data['folderid'] = $folderid;
    $data['users'] = $this->Admin_model->get_user_names();
    $this->load->view('Admin/admin_files_edit_modal');
    $this->load->view('Admin/Admin_files_content_loading', $data);
  }

  function get_one_file()
  {
    $file_id = $this->uri->segment(3);
    $use['file'] = $this->Admin_model->get_one_file($file_id);
    foreach($use['file'] as $f)
    {
      $data = array('id'=>$f->files_id,
                    'path'=>$f->files_path,
                    'display_name'=>$f->files_display_name);
      break;
    }

    echo json_encode($data);
  }

  function delete_one_file()
  {
    $id = $this->uri->segment(3);

    $data['file'] = $this->Admin_model->get_one_file($id);
    foreach($data['file'] as $d)
    {
      unlink($d->files_path);
    }
    $data['archive'] = $this->Admin_model->get_archive_by_files_id($id);
    foreach($data['archive'] as $d)
    {
      unlink($d->archives_path);
    }
    $this->Admin_model->delete_archive_by_files_id($id);
    $this->Admin_model->delete_one_file($id);
  }

  function download_one_file()
  {
    $id = $this->uri->segment(3);

    $data['file'] = $this->Admin_model->get_one_file($id);
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

          $use['oldfile'] = $this->Admin_model->get_one_file($currentfileID);
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

          $this->Admin_model->insert_file_archive($data);
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

           $this->Admin_model->update_file_contents($data,$files_id);

      }

      echo json_encode(array('id' => $currentfileID, 'displayname' => $displayname, 'version' => $final_version, 'updatedname' =>"<p class=\"help-block\">Updated by:{$this->session->userdata['firstname']} {$this->session->userdata['lastname']}</p>"));
    }
    else
    {
      $use['oldfile'] = $this->Admin_model->get_one_file($currentfileID);
      foreach($use['oldfile'] as $u)
      {
        $current_version = $u->files_version;
      }
      $data = array('files_display_name'=>$displayname);

      $this->Admin_model->update_file_contents($data,$currentfileID);
      echo json_encode(array('id' => $currentfileID, 'displayname' => $displayname, 'version' => $current_version, 'updatedname' =>"<p class=\"help-block\">Updated by:{$this->session->userdata['firstname']} {$this->session->userdata['lastname']}</p>"));
    }
  }

  function load_archive()
  {
    $filesid = $this->uri->segment(3);
    $data['archive'] = $this->Admin_model->get_files_archive($filesid);
    $data['departmentid'] = $this->uri->segment(4);
    $data['folderid'] = $this->uri->segment(5);
    $data['users'] = $this->Admin_model->get_user_names();
    $this->load->view('Admin/admin_files_archive', $data);
  }

  function download_one_file_archive()
  {
    $id = $this->uri->segment(3);

    $data['file'] = $this->Admin_model->get_one_file_archive($id);
    foreach($data['file'] as $d)
    {
      force_download($d->archive_path, NULL);
    }
  }

  function delete_one_file_archive()
  {
    $id = $this->uri->segment(3);

    $data['file'] = $this->Admin_model->get_one_file_archive($id);
    foreach($data['file'] as $d)
    {
      unlink($d->archive_path);
    }
    $this->Admin_model->delete_one_file_archive($id);
  }

  function delete_folder_files()
  {
    $id = $this->uri->segment(3);

    $archivednumbers = array();

    $data['unlinkfiles'] = $this->Admin_model->get_all_files_by_folder($id);
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
        $data['archive'] = $this->Admin_model->get_archive_by_files_id($i);
        foreach($data['archive'] as $a)
        {
          unlink($a->archive_path);
          $this->Admin_model->delete_archive_by_files_id($i);
        }
      }
    }

    foreach($data['unlinkfiles'] as $u)
    {
      unlink($u->files_path);
    }

    $this->Admin_model->delete_files_by_folder($id);
    $this->Admin_model->delete_shared_by_folder($id);
    $this->Admin_model->delete_folder($id);
  }

  //================================POLICIES======================//
  function policies()
  {
    $header['active_head'] = 'policies';
    $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");

    $data['policies'] = $this->Admin_model->get_policies_table();
    $data['sub1'] = $this->Admin_model->get_sub1_table();
    $data['sub2'] = $this->Admin_model->get_sub2_table();
    $data['sub3'] = $this->Admin_model->get_sub3_table();

    $this->load->view('Admin/admin_header',$header);
    $this->load->view('Admin/admin_policies_create_page_modal');
    $this->load->view('Admin/admin_policies_create_sub1_modal');
    $this->load->view('Admin/admin_policies_create_sub2_modal');
    $this->load->view('Admin/admin_policies_create_sub3_modal');
    $this->load->view('Admin/admin_policies_view',$data);
  }

  function create_main_policy_page()
  {
    $header['active_head'] = 'policies';
    $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
    $title = $this->input->post('title');

    $data = array('policy_title'=>$title);
    $id =  $this->Admin_model->insert_policy_title($data);

    redirect('Admin/edit_main_policy_page/'.$id);
  }

  function edit_main_policy_page()
  {
    $header['active_head'] = 'policies';
    $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
    $id = $this->uri->segment(3);

    $data['detail'] = $this->Admin_model->get_policy_details($id);

    foreach($data['detail'] as $d)
    {
      $data['title'] = $d->policy_title;
      $data['content'] = $d->policy_content;
    }
    $data['id'] = $id;
    $data['function'] = 'update_main_page_policy';

    $this->load->view('Admin/admin_header',$header);
    $this->load->view('Admin/admin_policies_create_main',$data);
  }

  function update_main_page_policy()
  {
    $data = array('policy_content'=>$this->input->post('content'));
    $policy_id = $this->input->post('policy_id');

    $this->Admin_model->update_main_page_policy($data,$policy_id);
    redirect('Admin/policies');
  }

  function view_main_page_policy()
  {
    $header['active_head'] = 'policies';
    $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
    $id = $this->uri->segment(3);

    $use['content'] = $this->Admin_model->get_policy_details($id);

    foreach($use['content'] as $d)
    {
      $data['title'] = $d->policy_title;
      $data['content'] = $d->policy_content;
    }

    $this->load->view('Admin/admin_header',$header);
    $this->load->view('Admin/admin_policies_view_page',$data);
  }

  //===========================POLICIES SUB 1=========================//
  function create_sub1_policy_page()
  {
    $header['active_head'] = 'policies';
    $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");

    $data = array('sub1_title'=>$this->input->post('title'),
                  'policy_id_fk'=>$this->input->post('policy_id_fk'));
    $id =  $this->Admin_model->insert_sub1_title($data);

    redirect('Admin/edit_sub1_policy_page/'.$id);
  }

  function edit_sub1_policy_page()
  {
    $header['active_head'] = 'policies';
    $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
    $id = $this->uri->segment(3);

    $data['detail'] = $this->Admin_model->get_sub1_details($id);

    foreach($data['detail'] as $d)
    {
      $data['title'] = $d->sub1_title;
      $data['content'] = $d->sub1_content;
    }
    $data['id'] = $id;
    $data['function'] = 'update_sub1_page_policy';

    $this->load->view('Admin/admin_header',$header);
    $this->load->view('Admin/admin_policies_create_main',$data);
  }

  function update_sub1_page_policy()
  {
    $data = array('sub1_content'=>$this->input->post('content'));
    $id = $this->input->post('policy_id');

    $this->Admin_model->update_sub1_page_policy($data,$id);
    redirect('Admin/policies');
  }

  function view_sub1_page_policy()
  {
    $header['active_head'] = 'policies';
    $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
    $id = $this->uri->segment(3);

    $use['content'] = $this->Admin_model->get_sub1_details($id);
    foreach($use['content'] as $d)
    {
      $data['title'] = $d->sub1_title;
      $data['content'] = $d->sub1_content;
    }

    $this->load->view('Admin/admin_header',$header);
    $this->load->view('Admin/admin_policies_view_page',$data);
  }

  //===========================POLICIES SUB 2=========================//
  function create_sub2_policy_page()
  {
    $header['active_head'] = 'policies';
    $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");

    $data = array('sub2_title'=>$this->input->post('title'),
                  'sub1_id_fk'=>$this->input->post('policy_id_fk'));
    $id =  $this->Admin_model->insert_sub2_title($data);

    redirect('Admin/edit_sub2_policy_page/'.$id);
  }

  function edit_sub2_policy_page()
  {
    $header['active_head'] = 'policies';
    $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
    $id = $this->uri->segment(3);

    $data['detail'] = $this->Admin_model->get_sub2_details($id);

    foreach($data['detail'] as $d)
    {
      $data['title'] = $d->sub2_title;
      $data['content'] = $d->sub2_content;
    }
    $data['id'] = $id;
    $data['function'] = 'update_sub2_page_policy';

    $this->load->view('Admin/admin_header',$header);
    $this->load->view('Admin/admin_policies_create_main',$data);
  }

  function update_sub2_page_policy()
  {
    $data = array('sub2_content'=>$this->input->post('content'));
    $id = $this->input->post('policy_id');

    $this->Admin_model->update_sub2_page_policy($data,$id);
    redirect('Admin/policies');
  }

  function view_sub2_page_policy()
  {
    $header['active_head'] = 'policies';
    $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
    $id = $this->uri->segment(3);

    $use['content'] = $this->Admin_model->get_sub2_details($id);
    foreach($use['content'] as $d)
    {
      $data['title'] = $d->sub2_title;
      $data['content'] = $d->sub2_content;
    }

    $this->load->view('Admin/admin_header',$header);
    $this->load->view('Admin/admin_policies_view_page',$data);
  }

  //===========================POLICIES SUB 2=========================//
  function create_sub3_policy_page()
  {
    $header['active_head'] = 'policies';
    $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");

    $data = array('sub3_title'=>$this->input->post('title'),
                  'sub2_id_fk'=>$this->input->post('policy_id_fk'));
    $id =  $this->Admin_model->insert_sub3_title($data);

    redirect('Admin/edit_sub3_policy_page/'.$id);
  }

  function edit_sub3_policy_page()
  {
    $header['active_head'] = 'policies';
    $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
    $id = $this->uri->segment(3);

    $data['detail'] = $this->Admin_model->get_sub3_details($id);

    foreach($data['detail'] as $d)
    {
      $data['title'] = $d->sub3_title;
      $data['content'] = $d->sub3_content;
    }
    $data['id'] = $id;
    $data['function'] = 'update_sub3_page_policy';

    $this->load->view('Admin/admin_header',$header);
    $this->load->view('Admin/admin_policies_create_main',$data);
  }

  function update_sub3_page_policy()
  {
    $data = array('sub3_content'=>$this->input->post('content'));
    $id = $this->input->post('policy_id');

    $this->Admin_model->update_sub3_page_policy($data,$id);
    redirect('Admin/policies');
  }

  function view_sub3_page_policy()
  {
    $header['active_head'] = 'policies';
    $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
    $id = $this->uri->segment(3);

    $use['content'] = $this->Admin_model->get_sub3_details($id);
    foreach($use['content'] as $d)
    {
      $data['title'] = $d->sub3_title;
      $data['content'] = $d->sub3_content;
    }

    $this->load->view('Admin/admin_header',$header);
    $this->load->view('Admin/admin_policies_view_page',$data);
  }


}
