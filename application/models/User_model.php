<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{
	function __construct()
	{
    parent::__construct();
  }

  //===========================SESSION====================================//

  	function get_user_details($username)
    {
  		$this ->db->select('a.user_department,a.user_id,a.user_username,a.user_firstname,a.user_middlename,a.user_picture,a.user_lastname,a.user_department,d.department_id');
  		$this->db->from('tblusers as a');
  		$this->db->join('tbldepartments as d', 'a.user_department = d.department_id');
  		$this->db->where('a.user_username', $username);
  		$query = $this->db->get();
  		return $query->result();
    }
  //==================================END============================//
  //================================DASHBOARD===================================//

  function get_todolist($ID)
  {
    $this->db->select('*');
    $this->db->from('tbltodolist');
    $this->db->where('todo_employee_id_fk',$ID);
    $query = $this->db->get();
    return $query->result();
  }

  function submit_todolist($data)
  {
    $this->db->insert('tbltodolist',$data);
  }

  function delete_one_todo($ID)
  {
    $this->db->delete('tbltodolist', array('todo_id' => $ID));
  }

  function process_todo($data,$ID)
  {
    $this->db->where('todo_id',$ID);
    $this->db->update('tbltodolist',$data);
  }

  function todo_check($ID)
  {
    $this->db->select('*');
    $this->db->from('tbltodolist');
    $this->db->where('todo_id',$ID);
    $query = $this->db->get();
    return $query->result();
  }

  //===================================USER PROFILE============================================//
    function edit_one_user_profile($data,$id)
  	{
  			$this->db->where('user_id',$id);
  		  $this->db->update('tblusers',$data);
  	}

    function get_one_user($ID)
    {
        $this->db->select('*');
        $this->db->from('tblusers');
        $this->db->where('user_id',$ID);
        $query = $this->db->get();
        return $query->result();
    }

    function check_password($ID)
    {
      $this->db->select('user_password');
      $this->db->from('tblusers');
      $this->db->where('user_id',$ID);
      $query = $this->db->get();
      return $query->result();
    }

    function update_password($data,$id)
  	{
  			$this->db->where('user_id',$id);
  		  $this->db->update('tblusers',$data);
  	}

    //==============================ANNOUNCEMENTS=============================//
    function get_announce($dept)
    {
      $this->db->select('*');
  		$this->db->from('tblannouncements as a');
      $this->db->join('tblannouncements_visible as b', 'a.ann_id = b.ann_id_fk');
      $this->db->where('b.ann_department_fk',$dept);
      $this->db->order_by('ann_timestamp', 'desc');
  		$query = $this->db->get();
  		return $query->result();
    }

    //===================================GALLERY============================================//
    function check_existing_gallery($gallery)
    {
      $this->db->select('*');
      $this->db->from('tblgallery_folder');
      $this->db->where('gfolder_name',$gallery);
      $query = $this->db->get();
      return $query->result();
    }

    function insert_new_gfolder($data)
    {
      $this->db->insert('tblgallery_folder',$data);
      return $this->db->insert_id();
    }

    function insert_gallery_pictures($data)
    {
      $this->db->insert('tblgallery_pictures',$data);
    }

    function get_all_gallery()
    {
      $this->db->select('f.*,p.picture_name,p.picture_path');
      $this->db->from('tblgallery_folder as f');
      $this->db->join('tblgallery_pictures as p', 'f.gfolder_id = p.gfolder_id_fk');
      $this->db->group_by('f.gfolder_id');
      $query = $this->db->get();
      return $query->result();
    }

    function get_specific_gallery($name)
    {
        $this->db->select('*');
        $this->db->from('tblgallery_folder as F');
        $this->db->join('tblgallery_pictures as P', 'F.gfolder_id = P.gfolder_id_fk');
        $this->db->where('F.gfolder_id',$name);
        $query = $this->db->get();
        return $query->result();
    }

    function get_gallery_names()
    {
        $this->db->select('gfolder_name');
        $this->db->from('tblgallery_folder');
        $query = $this->db->get();
        return $query->result();
    }

    function get_one_picture($id)
    {
        $this->db->select('picture_path');
        $this->db->from('tblgallery_pictures');
        $this->db->where('picture_id',$id);
        $query = $this->db->get();
        return $query->result();
    }

    function delete_one_picture_model($id)
    {
      $this->db->delete('tblgallery_pictures', array('picture_id'=>$id));
    }

    function get_gallery_name($id)
    {
      $this->db->select('gfolder_name');
      $this->db->from('tblgallery_folder');
      $this->db->where('gfolder_id',$id);
      $query = $this->db->get();
      return $query->result();
    }

    //=================================VIDEOS===============================//
    function get_videos_folder()
    {
        $this->db->select('vfolder_name');
        $this->db->from('tblvideos_folder');
        $query = $this->db->get();
        return $query->result();
    }

    function get_videos_folder_name($id)
    {
      $this->db->select('vfolder_name');
      $this->db->from('tblvideos_folder');
      $this->db->where('vfolder_id',$id);
      $query = $this->db->get();
      return $query->result();
    }

    function check_existing_video_folder($videofolder)
    {
      $this->db->select('*');
      $this->db->from('tblvideos_folder');
      $this->db->where('vfolder_name',$videofolder);
      $query = $this->db->get();
      return $query->result();
    }

    function insert_new_vfolder($data)
    {
      $this->db->insert('tblvideos_folder',$data);
      return $this->db->insert_id();
    }

    function insert_videos($data)
    {
      $this->db->insert('tblvideos_content',$data);
    }

    function get_all_videos()
    {
      $this->db->select('f.*,c.video_name,c.video_path');
      $this->db->from('tblvideos_folder as f');
      $this->db->join('tblvideos_content as c', 'f.vfolder_id = c.vfolder_id_fk');
      $this->db->group_by('f.vfolder_id');
      $query = $this->db->get();
      return $query->result();
    }

    function get_specific_videos($id)
    {
      $this->db->select('*');
      $this->db->from('tblvideos_folder as f');
      $this->db->join('tblvideos_content as c', 'f.vfolder_id = c.vfolder_id_fk');
      $this->db->where('f.vfolder_id',$id);
      $query = $this->db->get();
      return $query->result();
    }


    //=============================FILE======================//
    function get_folders_dept($id)
    {
      $this->db->select('f.ffolder_name,f.ffolder_id');
      $this->db->from('tbldepartments as d');
      $this->db->join('tblfiles_folder as f', 'd.department_id = f.ffolder_dept_id_fk');
      $this->db->where('d.department_id',$id);
      $query = $this->db->get();
      return $query->result();
    }

    function get_files_folder($id)
    {
      $this->db->select('*');
      $this->db->from('tblfiles_content');
      $this->db->where('files_ffolder_id_fk',$id);
      $query = $this->db->get();
      return $query->result();
    }

    function get_folder_name($id)
    {
      $this->db->select('ffolder_name');
      $this->db->from('tblfiles_folder');
      $this->db->where('ffolder_id',$id);
      $query = $this->db->get();
      return $query->result();
    }

    function get_folder_names_department($dept)
    {
        $this->db->select('ffolder_name,ffolder_dept_id_fk');
        $this->db->from('tblfiles_folder');
        $this->db->where('ffolder_dept_id_fk',$dept);
        $query = $this->db->get();
        return $query->result();
    }

    function get_departments()
    {
      $this ->db->select('*');
      $this ->db->from('tbldepartments');
      $query = $this->db->get();
      return $query->result();
    }
    function get_archive_by_files_id($id)
    {
      $this->db->select('archive_path');
      $this->db->from('tblfiles_archive');
      $this->db->where('archive_files_id_fk',$id);
      $query = $this->db->get();
      return $query->result();
    }

    function get_one_file($id)
    {
      $this->db->select('*');
      $this->db->from('tblfiles_content');
      $this->db->where('files_id',$id);
      $query = $this->db->get();
      return $query->result();
    }

    function get_folder_names()
    {
        $this->db->select('ffolder_name,ffolder_dept_id_fk');
        $this->db->from('tblfiles_folder');
        $query = $this->db->get();
        return $query->result();
    }

    function check_existing_folder_department($foldername,$maindept)
    {
      $this->db->select('*');
      $this->db->from('tblfiles_folder');
      $this->db->where('ffolder_name',$foldername);
      $this->db->where('ffolder_dept_id_fk',$maindept);
      $query = $this->db->get();
      return $query->result();
    }

    function insert_new_ffolder($data)
    {
      $this->db->insert('tblfiles_folder',$data);
      return $this->db->insert_id();
    }

    function insert_files_document($data)
    {
      $this->db->insert('tblfiles_content',$data);
    }


    function insert_shared_documents($data)
    {
      $this->db->insert('tblfiles_shared',$data);
    }

    function get_dept_with_files()
    {
      $this->db->select('d.department_name,d.department_id,f.ffolder_id');
      $this->db->from('tbldepartments as d');
      $this->db->join('tblfiles_folder as f', 'd.department_id = f.ffolder_dept_id_fk');
      $this->db->group_by('d.department_name');
      $query = $this->db->get();
      return $query->result();
    }


    function delete_one_file($id)
    {
      $this->db->delete('tblfiles_content', array('files_id'=>$id));
    }

    function insert_file_archive($data)
    {
      $this->db->insert('tblfiles_archive',$data);
    }

    function update_file_contents($data,$files_id)
    {
      $this->db->where('files_id',$files_id);
      $this->db->update('tblfiles_content',$data);
    }

    function get_files_archive($filesid)
    {
      $this->db->select('*');
      $this->db->from('tblfiles_archive');
      $this->db->where('archive_files_id_fk',$filesid);
      $this->db->order_by('archive_timestamp', 'DESC');
      $query = $this->db->get();
      return $query->result();
    }

    function get_one_file_archive($id)
    {
      $this->db->select('*');
      $this->db->from('tblfiles_archive');
      $this->db->where('archive_id',$id);
      $query = $this->db->get();
      return $query->result();
    }

    function delete_one_file_archive($id)
    {
      $this->db->delete('tblfiles_archive', array('archive_id'=>$id));
    }

    function get_all_files_by_folder($id)
    {
      $this->db->select('files_path,files_version,files_id');
      $this->db->from('tblfiles_content');
      $this->db->where('files_ffolder_id_fk',$id);
      $query = $this->db->get();
      return $query->result();
    }

    function delete_archive_by_files_id($id)
    {
      $this->db->delete('tblfiles_archive', array('archive_files_id_fk'=>$id));
    }

    function delete_files_by_folder($id)
    {
      $this->db->delete('tblfiles_content', array('files_ffolder_id_fk'=>$id));
    }

    function delete_shared_by_folder($id)
    {
      $this->db->delete('tblfiles_shared', array('shared_ffolder_id_fk'=>$id));
    }

    function delete_folder($id)
    {
      $this->db->delete('tblfiles_folder', array('ffolder_id'=>$id));
    }

    function get_user_names()
    {
      $this->db->select('user_id,user_firstname,user_lastname');
      $this->db->from('tblusers');
      $query = $this->db->get();
      return $query->result();
    }

    //===================================MESSAGES============================================//
    function get_list_employees()
    {
      $this->db->select('*');
      $this->db->from('tblusers');
      $query = $this->db->get();
      return $query->result();
    }

    function submit_one_message($data)
    {

      $this->db->insert('tblmessage_content',$data);
    }

    function get_thread_number()
      {
        $this->db->insert('tblmessage_threadno',array('thread_id'=>'default'));
        return $this->db->insert_id();
      }

    //==================POLICIES=======================//
    function get_policies_table()
    {
      $this->db->select('*');
      $this->db->from('tblpolicies');
      $query = $this->db->get();
      return $query->result();
    }

    function get_policies_table_specific($id)
    {
      $this->db->select('*');
      $this->db->from('tblpolicies');
      $this->db->where('policy_id',$id);
      $query = $this->db->get();
      return $query->result();
    }

    function get_sub1_table_specific($id)
    {
      $this->db->select('*');
      $this->db->from('tblpolicies_sub1');
      $this->db->where('policy_id_fk',$id);
      $query = $this->db->get();
      return $query->result();
    }

    function get_sub2_table_specific($id)
    {
      $this->db->select('*');
      $this->db->from('tblpolicies_sub2');
      $this->db->where('sub1_id_fk',$id);
      $query = $this->db->get();
      return $query->result();
    }

    function get_sub3_table_specific($id)
    {
      $this->db->select('*');
      $this->db->from('tblpolicies_sub3');
      $this->db->where('sub2_id_fk',$id);
      $query = $this->db->get();
      return $query->result();
    }

    function get_policy_details($id)
    {
      $this->db->select('*');
      $this->db->from('tblpolicies');
      $this->db->where('policy_id',$id);
      $query = $this->db->get();
      return $query->result();
    }

    function get_sub1_details($id)
    {
      $this->db->select('*');
      $this->db->from('tblpolicies_sub1');
      $this->db->where('sub1_id',$id);
      $query = $this->db->get();
      return $query->result();
    }

    function get_sub2_details($id)
    {
      $this->db->select('*');
      $this->db->from('tblpolicies_sub2');
      $this->db->where('sub2_id',$id);
      $query = $this->db->get();
      return $query->result();
    }

    function get_sub3_details($id)
    {
      $this->db->select('*');
      $this->db->from('tblpolicies_sub3');
      $this->db->where('sub3_id',$id);
      $query = $this->db->get();
      return $query->result();
    }



}
?>
