<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{
	function __construct()
	{
    parent::__construct();

    if($this->session->userdata('logged_in_user') == 1)
    {
      $this->load->model('User_model');
    }
    else
    {
      if($this->session->flashdata('username'))
      {
        $this->load->model('User_model');
        $username = $this->session->flashdata('username');
        $data['details'] = $this->User_model->get_user_details($username);
        foreach($data['details'] as $row)
        {
        $sessiondata = array('id'=>$row->user_id,
                            'user_name'=>$row->user_username,
                            'firstname'=>$row->user_firstname,
                             'middlename'=>$row->user_middlename,
                             'lastname'=>$row->user_lastname,
                             'department'=>$row->user_department,
                             'picture'=>$row->user_picture,
                             'logged_in_user'=>true
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


  //===========================END===========================================//
  //=========================DASHBOARD====================================//

  function index()
  {
    $header['active_head'] = '';
    $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
    $hasunread = $this->User_model->get_unread_messages($this->session->userdata['id']);
    if($hasunread)
      $header['ihasunread'] = 1;
    else
      $header['ihasunread'] = 0;
    $annunread = $this->User_model->get_unread_ann($this->session->userdata['id']);
    if($annunread)
      $header['ihasunreadann'] = 1;
    else
      $header['ihasunreadann'] = 0;
    $ID = $this->session->userdata['id'];
		$data['todolist'] = $this->User_model->get_todolist($ID);
    $this->load->view('User/user_header',$header);
    $this->load->view('User/user_index',$data);
  }

  function submit_todolist()
  {
    $data = array(
                  'todo_title'=>$this->input->post('title'),
                  'todo_employee_id_fk'=>$this->session->userdata['id'],
                  'todo_isfinished'=>0
                );

      $this->User_model->submit_todolist($data);
      redirect(base_url().'User');

  }

  function delete_one_todo()
  {
    $ID = $this->uri->segment(3);
    $this->User_model->delete_one_todo($ID);
  }

  function process_todo()
  {
    $ID = $this->uri->segment(3);

    $data['details'] = $this->User_model->todo_check($ID);
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
    $this->User_model->process_todo($data,$ID);
  }


  //============================PROFILE===================================//
  function user_profile()
  {
    $header['active_head'] = '';
    $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
    $hasunread = $this->User_model->get_unread_messages($this->session->userdata['id']);
    if($hasunread)
      $header['ihasunread'] = 1;
    else
      $header['ihasunread'] = 0;
    $annunread = $this->User_model->get_unread_ann($this->session->userdata['id']);
    if($annunread)
      $header['ihasunreadann'] = 1;
    else
      $header['ihasunreadann'] = 0;

    $ID = $this->session->userdata['id'];
		$data['userDetails'] = $this->User_model->get_one_user($ID);
      //var_dump($this->session->all_userdata());
    $this->load->view('User/user_header',$header);
    $this->load->view('User/user_user_profile',$data);
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
      $picture = $this->input->post('display_pic');

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
          $this->User_model->edit_one_user_profile($data, $id);
        //var_dump($check);
        redirect(base_url().'User/user_profile');
        print_r($this->session->userdata());
      }

      else if ($check == 1)
      {
            $config['upload_path']          = getcwd().'\\assets\\files\\profile_pictures\\';
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
                            $this->User_model->edit_one_user_profile($data, $id);
                            redirect(base_url().'User/user_profile');
                            print_r($this->session->all_userdata());
              }
      }
      }

      function change_password()
      {
        $data['password'] = $this->User_model->check_password($this->input->post('userid'));
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

              $this->User_model->update_password($data,$id);

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
    $hasunread = $this->User_model->get_unread_messages($this->session->userdata['id']);
    if($hasunread)
      $header['ihasunread'] = 1;
    else
      $header['ihasunread'] = 0;
    $annunread = $this->User_model->get_unread_ann($this->session->userdata['id']);
    if($annunread)
      $header['ihasunreadann'] = 1;
    else
      $header['ihasunreadann'] = 0;

    $ID = $this->uri->segment(3);
		$data['userDetails'] = $this->User_model->get_one_user($ID);
      //var_dump($this->session->all_userdata());
    $this->load->view('User/user_header',$header);
    $this->load->view('User/user_view_other_profile',$data);
  }
  //============================ANNOUNCEMEntS===================================//
  function announcements()
  {
    $header['active_head'] = '';
    $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
    $hasunread = $this->User_model->get_unread_messages($this->session->userdata['id']);
    if($hasunread)
      $header['ihasunread'] = 1;
    else
      $header['ihasunread'] = 0;
    $annunread = $this->User_model->get_unread_ann($this->session->userdata['id']);
    if($annunread)
      $header['ihasunreadann'] = 1;
    else
      $header['ihasunreadann'] = 0;
    $dept = $this->session->userdata['department'];
    $data['announcements'] = $this->User_model->get_announce($dept);
    $this->User_model->set_read_announcements($this->session->userdata['id']);
    $this->load->view('User/user_header',$header);
    $this->load->view('User/user_announcements',$data);
  }



//============================GALLERY===================================//
function gallery()
{
  $header['active_head'] = 'gallery';
  $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
  $hasunread = $this->User_model->get_unread_messages($this->session->userdata['id']);
  if($hasunread)
    $header['ihasunread'] = 1;
  else
    $header['ihasunread'] = 0;
  $annunread = $this->User_model->get_unread_ann($this->session->userdata['id']);
  if($annunread)
    $header['ihasunreadann'] = 1;
  else
    $header['ihasunreadann'] = 0;
  $data['gallery'] = $this->User_model->get_all_gallery();
  $this->load->view('User/user_header',$header);
  $this->load->view('User/user_gallery',$data);
}

function view_gallery()
{
  $header['active_head'] = 'gallery';
  $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
  $hasunread = $this->User_model->get_unread_messages($this->session->userdata['id']);
  if($hasunread)
    $header['ihasunread'] = 1;
  else
    $header['ihasunread'] = 0;
  $annunread = $this->User_model->get_unread_ann($this->session->userdata['id']);
  if($annunread)
    $header['ihasunreadann'] = 1;
  else
    $header['ihasunreadann'] = 0;
  $id = $this->uri->segment(3);
  $data['gallery'] = $this->User_model->get_specific_gallery($id);
  foreach($data['gallery'] as $d)
  {
    $data['galleryname'] = $d->gfolder_name;
  }
  $data['galleryid'] = $id;
  $data['users'] = $this->User_model->get_users();
  $this->load->view('User/user_header',$header);
  $this->load->view('User/user_gallery_view',$data);
}

function upload_pictures()
{
  $header['active_head'] = 'gallery';
  $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
  $hasunread = $this->User_model->get_unread_messages($this->session->userdata['id']);
  if($hasunread)
    $header['ihasunread'] = 1;
  else
    $header['ihasunread'] = 0;
  $annunread = $this->User_model->get_unread_ann($this->session->userdata['id']);
  if($annunread)
    $header['ihasunreadann'] = 1;
  else
    $header['ihasunreadann'] = 0;
  $use['gallery'] = $this->User_model->get_gallery_names();
  $data['gallery'] = array();
  foreach($use['gallery'] as $key => $value)
  {
    $data['gallerynew'][] = $value->gfolder_name;
  }

  $use['galleryid'] = $this->uri->segment(3);
  $use['galleryname'] = $this->User_model->get_gallery_name($use['galleryid']);
  foreach($use['galleryname'] as $u)
  {
    $data['galleryname'] = $u->gfolder_name;
  }
  $this->load->view('User/user_header',$header);
  $this->load->view('User/user_gallery_upload', $data);
}


function do_Upload_gallery()
 {
     $this->load->helper('inflector');
   $gallery = $this->input->post('gallery');
   $count = 1;
   $data['check'] = $this->User_model->check_existing_gallery($gallery);
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
     $gfolder_id = $this->User_model->insert_new_gfolder($data);
     if (!file_exists( './assets/files/gallery/'.$gallery))
     {
      mkdir( './assets/files/gallery/'.$gallery, 0777, true);
    }
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

            $this->User_model->insert_gallery_pictures($data);
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
     $data['details'] = $this->User_model->get_one_picture($id);
     foreach($data['details'] as $d)
     {
       $path = $d->picture_path;
     }
     unlink($path);
     $this->User_model->delete_one_picture_model($id);
   }

   function manage_gallery()
   {
     $header['active_head'] = 'gallery';
     $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
     $hasunread = $this->User_model->get_unread_messages($this->session->userdata['id']);
     if($hasunread)
       $header['ihasunread'] = 1;
     else
       $header['ihasunread'] = 0;
     $annunread = $this->User_model->get_unread_ann($this->session->userdata['id']);
     if($annunread)
       $header['ihasunreadann'] = 1;
     else
       $header['ihasunreadann'] = 0;
     $id = $this->uri->segment(3);
     $data['gallery'] = $this->User_model->get_specific_gallery_with_user_uploads($id,$this->session->userdata['id']);
     if($data['gallery'])
     {
       foreach($data['gallery'] as $d)
       {
         $data['galleryname'] = $d->gfolder_name;
       }
       $data['galleryid'] = $id;
       $this->load->view('User/user_header',$header);
       $this->load->view('User/user_gallery_manage',$data);
     }
     else
     {
       $this->session->set_flashdata('notify',"<script>
          new PNotify({
           title: 'Error',
           text: 'No pictures uploaded by you.',
           type: 'error'
        });
       </script>");
       redirect('User/view_gallery/'.$id);
     }
   }

   function delete_pictures()
   {
     foreach($this->input->post('pictures') as $id)
     {
       $data['details'] = $this->User_model->get_one_picture($id);
       foreach($data['details'] as $d)
       {
         $path = $d->picture_path;
         $withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $d->picture_path);
         $ext = pathinfo($d->picture_path, PATHINFO_EXTENSION);
         $picture_name = $withoutExt.'_thumb.'.$ext;
         unlink($picture_name);
         unlink($path);
       }
       $this->User_model->delete_one_picture_model($id);
     }
     redirect('User/manage_gallery/'.$this->input->post('return'));
   }


   //===============================VIDEOS=======================================//
   function upload_videos()
   {
     $header['active_head'] = 'gallery';
     $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
     $hasunread = $this->User_model->get_unread_messages($this->session->userdata['id']);
     if($hasunread)
       $header['ihasunread'] = 1;
     else
       $header['ihasunread'] = 0;
     $annunread = $this->User_model->get_unread_ann($this->session->userdata['id']);
     if($annunread)
       $header['ihasunreadann'] = 1;
     else
       $header['ihasunreadann'] = 0;
     $use['vfolder_name'] = $this->User_model->get_videos_folder();
     $data['vfolder_name'] = array();
     foreach($use['vfolder_name'] as $key => $value)
     {
       $data['vfolder_name'][] = $value->vfolder_name;
     }

     $use['vfolder_id'] = $this->uri->segment(3);
     $use['vfoldername'] = $this->User_model->get_videos_folder_name($use['vfolder_id']);
     foreach($use['vfoldername'] as $u)
     {
       $data['vfoldername'] = $u->vfolder_name;
     }
     $this->load->view('User/user_header',$header);
     $this->load->view('User/user_videos_upload', $data);
   }

   function do_upload_videos()
    {
      $this->load->helper('inflector');
      $videofolder = $this->input->post('gallery');
      $count = 1;
      $data['check'] = $this->User_model->check_existing_video_folder($videofolder);
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
        $vfolder_id = $this->User_model->insert_new_vfolder($data);
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

               $this->User_model->insert_videos($data);
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
      $hasunread = $this->User_model->get_unread_messages($this->session->userdata['id']);
      if($hasunread)
        $header['ihasunread'] = 1;
      else
        $header['ihasunread'] = 0;
      $annunread = $this->User_model->get_unread_ann($this->session->userdata['id']);
      if($annunread)
        $header['ihasunreadann'] = 1;
      else
        $header['ihasunreadann'] = 0;
      $data['videos'] = $this->User_model->get_all_videos();
      $this->load->view('User/user_header',$header);
      $this->load->view('User/user_videos',$data);
    }

    function view_videos()
    {
      $header['active_head'] = 'gallery';
      $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
      $hasunread = $this->User_model->get_unread_messages($this->session->userdata['id']);
      if($hasunread)
        $header['ihasunread'] = 1;
      else
        $header['ihasunread'] = 0;
      $annunread = $this->User_model->get_unread_ann($this->session->userdata['id']);
      if($annunread)
        $header['ihasunreadann'] = 1;
      else
        $header['ihasunreadann'] = 0;
      $id = $this->uri->segment(3);
      $data['videos'] = $this->User_model->get_specific_videos($id);
      foreach($data['videos'] as $d)
      {
        $data['galleryname'] = $d->vfolder_name;
      }
      $data['galleryid'] = $id;
      $data['users'] = $this->User_model->get_users();
      $this->load->view('User/user_header',$header);
      $this->load->view('User/user_videos_view',$data);
    }

    function manage_videos()
    {
      $header['active_head'] = 'gallery';
      $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
      $hasunread = $this->User_model->get_unread_messages($this->session->userdata['id']);
      if($hasunread)
        $header['ihasunread'] = 1;
      else
        $header['ihasunread'] = 0;
      $annunread = $this->User_model->get_unread_ann($this->session->userdata['id']);
      if($annunread)
        $header['ihasunreadann'] = 1;
      else
        $header['ihasunreadann'] = 0;
      $id = $this->uri->segment(3);
      $data['videos'] = $this->User_model->get_specific_videos_with_useruploads($id,$this->session->userdata['id']);
      if($data['videos'])
      {
        foreach($data['videos'] as $d)
        {
          $data['galleryname'] = $d->vfolder_name;
        }
        $data['galleryid'] = $id;
        $this->load->view('User/user_header',$header);
        $this->load->view('User/user_videos_manage',$data);
      }
      else
      {
        $this->session->set_flashdata('notify',"<script>
           new PNotify({
            title: 'Error',
            text: 'No videos uploaded by you.',
            type: 'error'
         });
        </script>");
        redirect('User/view_videos/'.$id);
      }
    }

    function delete_videos()
    {
      foreach($this->input->post('videos') as $id)
      {
        $data['details'] = $this->User_model->get_one_video($id);
        foreach($data['details'] as $d)
        {
          $path = $d->video_path;
          $withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $d->video_path);
           $picture_name = $withoutExt.'.png.';
           unlink($picture_name);
           unlink($path);
        }
        $this->User_model->delete_one_video($id);
      }
      redirect('User/manage_videos/'.$this->input->post('return'));
    }


   //===========================FILES=====================//
   function view_files()
   {
     $header['active_head'] = 'upload_files';
     $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
     $hasunread = $this->User_model->get_unread_messages($this->session->userdata['id']);
     if($hasunread)
       $header['ihasunread'] = 1;
     else
       $header['ihasunread'] = 0;
     $annunread = $this->User_model->get_unread_ann($this->session->userdata['id']);
     if($annunread)
       $header['ihasunreadann'] = 1;
     else
       $header['ihasunreadann'] = 0;
     $departmentid =  $this->session->userdata['department'];
     $data['folders'] = $this->User_model->get_folders_dept($departmentid);
     $data['departmentid'] = $departmentid;
     $this->load->view('User/user_header',$header);
     $this->load->view('User/user_files_view', $data);
   }

   function load_files()
   {
     $folderid = $this->uri->segment(3);
     $data['files'] = $this->User_model->get_files_folder($folderid);
     $data['departmentid'] = $this->session->userdata['department'];

     $get['foldername'] = $this->User_model->get_folder_name($folderid);
     foreach($get['foldername'] as $f)
     {
       $data['foldername'] = $f->ffolder_name;
       break;
     }
     $data['folderid'] = $folderid;
     $data['users'] = $this->User_model->get_user_names();
     $this->load->view('User/user_files_edit_modal');
     $this->load->view('User/user_files_content', $data);
   }

   function upload_files()
   {
       $header['active_head'] = 'files';
       $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
       $hasunread = $this->User_model->get_unread_messages($this->session->userdata['id']);
       if($hasunread)
         $header['ihasunread'] = 1;
       else
         $header['ihasunread'] = 0;
       $annunread = $this->User_model->get_unread_ann($this->session->userdata['id']);
       if($annunread)
         $header['ihasunreadann'] = 1;
       else
         $header['ihasunreadann'] = 0;
       $data['foldernew'] = $this->User_model->get_folder_names_department($this->session->userdata['department']);
       $data['departments'] = $this->User_model->get_departments();
       $this->load->view('User/user_header',$header);
       $this->load->view('User/user_files_upload',$data);
   }

   function do_upload_files()
   {
       $this->load->helper('inflector');
       $foldername = $this->input->post('foldername');
       $maindept   = $this->input->post('maindept');
       $shareddept = explode(",",$this->input->post('shareddept'));
       $ffolder_id; //tblfiles_folder primary key

       $data['check'] = $this->User_model->check_existing_folder_department($foldername,$maindept);
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
         $ffolder_id = $this->User_model->insert_new_ffolder($data);
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

              $this->User_model->insert_files_document($data);
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
         $this->User_model->insert_shared_documents($data);

       }
     }
   }

   function get_one_file()
   {
     $file_id = $this->uri->segment(3);
     $use['file'] = $this->User_model->get_one_file($file_id);
     foreach($use['file'] as $f)
     {
       $use['folder'] = $this->User_model->get_folder_name($f->files_ffolder_id_fk);
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

     function download_one_file()
     {
       $id = $this->uri->segment(3);

       $data['file'] = $this->User_model->get_one_file($id);
       foreach($data['file'] as $d)
       {
         force_download($d->files_path, NULL);
       }
     }


     function delete_one_file()
     {
       $id = $this->uri->segment(3);

       $data['file'] = $this->User_model->get_one_file($id);
       foreach($data['file'] as $d)
       {
         unlink($d->files_path);
       }
       $data['archive'] = $this->User_model->get_archive_by_files_id($id);
       foreach($data['archive'] as $d)
       {
         unlink($d->archives_path);
       }
       $this->User_model->delete_archive_by_files_id($id);
       $this->User_model->delete_one_file($id);
     }



   function do_update_one_file()
   {
     $filechanged = $this->input->post('filechanged');

     $displayname = $this->input->post('displayname');
     $revision = $this->input->post('revision');
     $foldername = $this->input->post('foldername');
     $currentfileID = $this->input->post('old_file_id');

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

           $use['oldfile'] = $this->User_model->get_one_file($currentfileID);
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

           $this->User_model->insert_file_archive($data);
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

            $this->User_model->update_file_contents($data,$files_id);

       }
       if($this->input->post('shared') == 1)
       {
         $isshared = 1;
       }
       else
       {
         $isshared = 0;
       }
       echo json_encode(array('isshared' => $isshared,'id' => $currentfileID, 'displayname' => $displayname, 'version' => $final_version, 'updatedname' =>"<p class=\"help-block\">Updated by:<a href=\"".base_url()."User/view_other_profile/{$this->session->userdata['id']}\">{$this->session->userdata['firstname']} {$this->session->userdata['lastname']}</a></p>"));
    }
     else
     {
       $use['oldfile'] = $this->User_model->get_one_file($currentfileID);
       foreach($use['oldfile'] as $u)
       {
         $current_version = $u->files_version;
       }
       $data = array('files_display_name'=>$displayname);

       $this->User_model->update_file_contents($data,$currentfileID);
       if($this->input->post('shared') == 1)
       {
         $isshared = 1;
       }
       else
       {
         $isshared = 0;
       }
       echo json_encode(array('isshared' => $isshared,'id' => $currentfileID, 'displayname' => $displayname, 'version' => $final_version, 'updatedname' =>"<p class=\"help-block\">Updated by:<a href=\"".base_url()."User/view_other_profile/{$this->session->userdata['id']}\">{$this->session->userdata['firstname']} {$this->session->userdata['lastname']}</a></p>"));
    }
   }

   function load_archive()
   {
     $filesid = $this->uri->segment(3);
     $data['archive'] = $this->User_model->get_files_archive($filesid);
     $data['departmentid'] = $this->uri->segment(4);
     $data['folderid'] = $this->uri->segment(5);
     $data['users'] = $this->User_model->get_user_names();
     $this->load->view('User/user_files_archive', $data);
   }

   function download_one_file_archive()
   {
     $id = $this->uri->segment(3);

     $data['file'] = $this->User_model->get_one_file_archive($id);
     foreach($data['file'] as $d)
     {
       force_download($d->archive_path, NULL);
     }
   }

   function delete_one_file_archive()
   {
     $id = $this->uri->segment(3);

     $data['file'] = $this->User_model->get_one_file_archive($id);
     foreach($data['file'] as $d)
     {
       unlink($d->archive_path);
     }
     $this->User_model->delete_one_file_archive($id);
   }

   function delete_folder_files()
   {
     $id = $this->uri->segment(3);

     $archivednumbers = array();

     $data['unlinkfiles'] = $this->User_model->get_all_files_by_folder($id);
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
         $data['archive'] = $this->User_model->get_archive_by_files_id($i);
         foreach($data['archive'] as $a)
         {
           unlink($a->archive_path);
           $this->User_model->delete_archive_by_files_id($i);
         }
       }
     }


     foreach($data['unlinkfiles'] as $u)
     {
       unlink($u->files_path);
     }

     $this->User_model->delete_files_by_folder($id);
     $this->User_model->delete_shared_by_folder($id);
     $this->User_model->delete_folder($id);
   }

   function view_shared_files()
   {
     $header['active_head'] = 'files';
     $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
     $hasunread = $this->User_model->get_unread_messages($this->session->userdata['id']);
     if($hasunread)
       $header['ihasunread'] = 1;
     else
       $header['ihasunread'] = 0;
     $annunread = $this->User_model->get_unread_ann($this->session->userdata['id']);
     if($annunread)
       $header['ihasunreadann'] = 1;
     else
       $header['ihasunreadann'] = 0;
     $data['files'] = $this->User_model->get_shared_files($this->session->userdata['department']);
     $data['users'] = $this->User_model->get_user_names();
     $data['departments'] = $this->User_model->get_departments();

     $this->load->view('User/user_header',$header);
     $this->load->view('User/user_files_shared_view',$data);
     $this->load->view('User/user_files_edit_modal');
   }

   function view_shared_archive()
   {
     $header['active_head'] = 'files';
     $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
     $hasunread = $this->User_model->get_unread_messages($this->session->userdata['id']);
     if($hasunread)
       $header['ihasunread'] = 1;
     else
       $header['ihasunread'] = 0;
     $annunread = $this->User_model->get_unread_ann($this->session->userdata['id']);
     if($annunread)
       $header['ihasunreadann'] = 1;
     else
       $header['ihasunreadann'] = 0;
     $filesid = $this->uri->segment(3);
     $data['archive'] = $this->User_model->get_files_archive($filesid);
     $data['departmentid'] = $this->uri->segment(4);
     $data['folderid'] = $this->uri->segment(5);
     $data['users'] = $this->User_model->get_user_names();
     $this->load->view('User/user_header',$header);
     $this->load->view('User/user_files_shared_archive', $data);
   }

   //============================MESSAGES===================================//
   function messages()
   {
     $header['active_head'] = 'messages';
     $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
     $hasunread = $this->User_model->get_unread_messages($this->session->userdata['id']);
     if($hasunread)
       $header['ihasunread'] = 1;
     else
       $header['ihasunread'] = 0;
     $annunread = $this->User_model->get_unread_ann($this->session->userdata['id']);
     if($annunread)
       $header['ihasunreadann'] = 1;
     else
       $header['ihasunreadann'] = 0;

     $data['recipients'] = $this->User_model->get_list_employees();

     $this->load->view('User/user_header',$header);
     $this->load->view('User/user_messages',$data);
   }

   function do_message()
   {
     $id =$this->User_model->get_thread_number();

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

     $this->User_model->submit_one_message($data, $id);

   }

   //=======================================POLICIES===========================//
   function policies()
   {
     $header['active_head'] = '';
     $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
     $hasunread = $this->User_model->get_unread_messages($this->session->userdata['id']);
     if($hasunread)
       $header['ihasunread'] = 1;
     else
       $header['ihasunread'] = 0;
     $annunread = $this->User_model->get_unread_ann($this->session->userdata['id']);
     if($annunread)
       $header['ihasunreadann'] = 1;
     else
       $header['ihasunreadann'] = 0;

     $data['policies'] = $this->User_model->get_policies_table();

     $this->load->view('User/user_header',$header);
     $this->load->view('User/user_policies_view',$data);
   }

   function view_contents_of_main()
   {
     $header['active_head'] = '';
     $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
     $hasunread = $this->User_model->get_unread_messages($this->session->userdata['id']);
     if($hasunread)
       $header['ihasunread'] = 1;
     else
       $header['ihasunread'] = 0;
     $annunread = $this->User_model->get_unread_ann($this->session->userdata['id']);
     if($annunread)
       $header['ihasunreadann'] = 1;
     else
       $header['ihasunreadann'] = 0;
     $id = $this->uri->segment(3);

     $data['policies'] = $this->User_model->get_policies_table_specific($id);
     $data['sub1'] = $this->User_model->get_sub1_table_specific($id);

     $use['sub2'] = array();
     foreach($data['sub1'] as $s1)
     {
        $use['sub2'][] = $this->User_model->get_sub2_table_specific($s1->sub1_id);
     }

     $index = 0;
     $data['sub2'] = array();
     foreach($use['sub2'] as $s2)
     {
       $data['sub2'] = array_merge($data['sub2'], $use['sub2'][$index]);
       $index++;
     }
     $use['sub3'] = array();
     foreach($data['sub2'] as $s2)
     {
        $use['sub3'][] = $this->User_model->get_sub3_table_specific($s2->sub2_id);
     }

     $index = 0;
     $data['sub3'] = array();
     foreach($use['sub3'] as $s3)
     {
       $data['sub3'] = array_merge($data['sub3'], $use['sub3'][$index]);
       $index++;
     }

     $this->load->view('User/user_header',$header);
     $this->load->view('User/user_policies_view_contents_of_main',$data);
   }

   function view_main_page_policy()
   {
     $header['active_head'] = 'policies';
     $header['active_page'] = basename($_SERVER['PHP_SELF'], ".php");
     $hasunread = $this->User_model->get_unread_messages($this->session->userdata['id']);
     if($hasunread)
       $header['ihasunread'] = 1;
     else
       $header['ihasunread'] = 0;
     $annunread = $this->User_model->get_unread_ann($this->session->userdata['id']);
     if($annunread)
       $header['ihasunreadann'] = 1;
     else
       $header['ihasunreadann'] = 0;
     $id = $this->uri->segment(3);
     $type = $this->uri->segment(4);
     //0-main
     if($type == 0)
     {
       $use['content'] = $this->User_model->get_policy_details($id);

       foreach($use['content'] as $d)
       {
         $data['title'] = $d->policy_title;
         $data['content'] = $d->policy_content;
       }
    }

    else if($type == 1)
    {
       $use['content'] = $this->User_model->get_sub1_details($id);
       foreach($use['content'] as $d)
       {
         $data['title'] = $d->sub1_title;
         $data['content'] = $d->sub1_content;
       }
     }

     else if($type == 2)
     {
       $use['content'] = $this->User_model->get_sub2_details($id);
       foreach($use['content'] as $d)
       {
         $data['title'] = $d->sub2_title;
         $data['content'] = $d->sub2_content;
       }
     }

     else if($type == 3)
     {
       $use['content'] = $this->User_model->get_sub3_details($id);
       foreach($use['content'] as $d)
       {
         $data['title'] = $d->sub3_title;
         $data['content'] = $d->sub3_content;
       }
     }

     $this->load->view('Admin/admin_header',$header);
     $this->load->view('Admin/admin_policies_view_page',$data);
   }


}

?>
