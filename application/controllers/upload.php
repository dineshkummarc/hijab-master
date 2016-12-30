<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upload extends PX_Controller {
	function image()
	{
		if($this->session->userdata('temp_folder') != FALSE)
			$temp_folder = $this->session->userdata('temp_folder');
		else {
			$folder = uniqid();
			$this->session->set_userdata('temp_folder',$folder);
			$temp_folder = $this->session->userdata('temp_folder');
		}
		if(!is_dir(FCPATH . "assets/uploads/temp/".$temp_folder))
			mkdir(FCPATH . "assets/uploads/temp/".$temp_folder);

		// Validate registered or owner
		$temp_folder = $this->session->userdata('temp_folder');
		$old = $this->input->post('old');
		if($old != null)
			@unlink($old);
		$session = $this->session->userdata('admin');
		$member_sess = $this->session->userdata('member');
		if ($session == false && $member_sess == false)
		{
			show_error('Unauthorized Access.', 401, '401 Unauthorized Access');
		}
		
        $config['upload_path'] = FCPATH . "assets/uploads/temp/$temp_folder/";
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
        $config['max_size']   = '5000';
        $config['overwrite']  = 'TRUE';

        $this->load->library('upload');
        $this->upload->initialize($config);
        $this->upload->do_upload('image');
        $upload = $this->upload->data();
        if ($upload) {
            $path = $upload['file_path'];
            $ext = $upload['file_ext'];
            $name = $upload['file_name'];
            $newname = uniqid();
            $neworig = $newname . "-original".$ext;
            rename($upload['full_path'], $path . $neworig);
            $uploaded = "assets/uploads/temp/$temp_folder/$neworig";
            echo $uploaded;
        } else {
            echo 'error';
        }
	}
	function file()
	{
		if($this->session->userdata('temp_folder') != FALSE)
			$temp_folder = $this->session->userdata('temp_folder');
		else {
			$folder = uniqid();
			$this->session->set_userdata('temp_folder',$folder);
			$temp_folder = $this->session->userdata('temp_folder');
		}
		if(!is_dir(FCPATH . "assets/uploads/temp/".$temp_folder))
			mkdir(FCPATH . "assets/uploads/temp/".$temp_folder);

		// Validate registered or owner
		$temp_folder = $this->session->userdata('temp_folder');
		$old = $this->input->post('old-file');
		if($old != null)
			@unlink($old);
		$session = $this->session->userdata('admin');
		$member_sess = $this->session->userdata('member');
		if ($session == false && $member_sess == false)
		{
			show_error('Unauthorized Access.', 401, '401 Unauthorized Access');
		}
		
        $config['upload_path'] = FCPATH . "assets/uploads/temp/$temp_folder/";
        $config['allowed_types'] = 'doc|docx|pdf|xls|xlsx';
        $config['max_size']   = '10000';
        $config['overwrite']  = 'TRUE';

        $this->load->library('upload');
        $this->upload->initialize($config);
        $this->upload->do_upload('file');
        $upload = $this->upload->data();
        if ($upload) {
            $path = $upload['file_path'];
            $ext = $upload['file_ext'];
            $name = $upload['file_name'];
            $neworig = $name;
            rename($upload['full_path'], $path . $neworig);
            $uploaded = "assets/uploads/temp/$temp_folder/$neworig";
            echo $uploaded;
        } else {
            echo "error";
        }
	}
	function video()
	{
		if($this->session->userdata('temp_folder') != FALSE)
			$temp_folder = $this->session->userdata('temp_folder');
		else {
			$folder = uniqid();
			$this->session->set_userdata('temp_folder',$folder);
			$temp_folder = $this->session->userdata('temp_folder');
		}
		if(!is_dir(FCPATH . "assets/uploads/temp/".$temp_folder))
			mkdir(FCPATH . "assets/uploads/temp/".$temp_folder);

		// Validate registered or owner
		$temp_folder = $this->session->userdata('temp_folder');
		$old = $this->input->post('old');
		if($old != null)
			@unlink($old);

		$session = $this->session->userdata('admin');
		$member_sess = $this->session->userdata('member');
		if ($session == false && $member_sess == false)
		{
			show_error('Unauthorized Access.', 401, '401 Unauthorized Access');
		}
		
        $config['upload_path'] = FCPATH . "assets/uploads/temp/$temp_folder/";
        $config['allowed_types'] = 'mp4|flv|3gp|mp3|wmv';
        $config['max_size']   = '100000';
        $config['overwrite']  = 'TRUE';

        $this->load->library('upload');
        $this->upload->initialize($config);
        $this->upload->do_upload('image');
        $upload = $this->upload->data();
        if ($upload) {
            $path = $upload['file_path'];
            $ext = $upload['file_ext'];
            $name = $upload['file_name'];
            $newname = uniqid();
            $neworig = $newname . "-original".$ext;
            rename($upload['full_path'], $path . $neworig);
            $uploaded = "assets/uploads/temp/$temp_folder/$neworig";
            echo $uploaded;
        } else {
            echo 'error';
        }
	}
	function image_public()
	{
		if($this->session->userdata('temp_folder') != FALSE)
			$temp_folder = $this->session->userdata('temp_folder');
		else {
			$folder = uniqid();
			$this->session->set_userdata('temp_folder',$folder);
			$temp_folder = $this->session->userdata('temp_folder');
		}
		if(!is_dir(FCPATH . "assets/uploads/temp/".$temp_folder))
			mkdir(FCPATH . "assets/uploads/temp/".$temp_folder);

		// Validate registered or owner
		$temp_folder = $this->session->userdata('temp_folder');
		$old = $this->input->post('old');
		if($old != null)
			@unlink($old);
		$session = $this->session->userdata('admin');
		$member_sess = $this->session->userdata('member');
		
        $config['upload_path'] = FCPATH . "assets/uploads/temp/$temp_folder/";
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
        $config['max_size']   = '5000';
        $config['overwrite']  = 'TRUE';

        $this->load->library('upload');
        $this->upload->initialize($config);
        $this->upload->do_upload('image');
        $upload = $this->upload->data();
        if ($upload) {
            $path = $upload['file_path'];
            $ext = $upload['file_ext'];
            $name = $upload['file_name'];
            $newname = uniqid();
            $neworig = $newname . "-original".$ext;
            rename($upload['full_path'], $path . $neworig);
            $uploaded = "assets/uploads/temp/$temp_folder/$neworig";
            echo $uploaded;
        } else {
            echo 'error';
        }
	}
}