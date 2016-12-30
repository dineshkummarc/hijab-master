<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_system extends PX_Controller {

	public function __construct() {
		parent::__construct();
		$this->check_login();
		$this->controller_attr = array('controller' => 'admin_system','controller_name' => 'Admin System','controller_id' => 0);
	}

	public function index() {
		
	}

	function my_profile(){
    	$data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('Admin My Profile','my_profile');
		$data += $this->get_menu();
		$this->check_userakses($data['function_id'], ACT_READ);
		$data['data'] = $this->session_admin;
		$data['content'] = $this->load->view('backend/admin_system/my_profile',$data,true);
		$this->load->view('backend/index',$data); 
    }

    function my_profile_edit(){
    	$data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('Admin My Profile','my_profile');
		$data += $this->get_menu();
		$this->check_userakses($data['function_id'], ACT_UPDATE);
		$table_field = $this->db->list_fields($this->tbl_user);
		$update = array();
		foreach ($table_field as $field) {
			$update[$field] = $this->input->post($field);
		}
		unset($update['id_usergroup']);
		$update['password'] = $this->encrypt->encode($this->input->post('password'));

		if(!is_dir(FCPATH . "assets/uploads/admin/".$update['id']))
			mkdir(FCPATH . "assets/uploads/admin/".$update['id']);

		if($update['photo']){
			if(!@copy($update['photo'],'assets/uploads/admin/'.$update['id'].'/'.basename($update['photo']))){
				$update['photo'] = $this->input->post('old_photo');
			}
			else{
				$update['photo'] = basename($update['photo']);
				@unlink('assets/uploads/admin/'.$update['id'].'/'.$this->input->post('old_photo'));
			}
		}
		else
			$update['photo'] = $this->input->post('old_photo');

		if($update['realname'] && $update['email'] && $update['username'] && $this->input->post('password') && ($this->input->post('password') == $this->input->post('c-password'))){
			$do_update = $this->model_basic->update($this->tbl_user,$update,'id',$update['id']);
			if($do_update){
				$data_user = array(
					'admin_id' => $update['id'],
					'username' => $update['username'],
					'password' => $this->input->post('password'),
					'realname' => $update['realname'],
					'email' => $update['email'],
					'id_usergroup' => $this->session_admin['id_usergroup'],
					'name_usergroup' => $this->session_admin['name_usergroup'],
					'photo' => $update['photo']
					);
				$this->session->set_userdata('admin',$data_user);

				$this->delete_temp('temp_folder');
				$this->returnJson(array('status' => 'ok','msg' => 'Update success','redirect' => $data['controller'].'/'.$data['function']));
			}
			else
				$this->returnJson(array('status' => 'error','msg' => 'Failed when updating data'));	
		}
		else
			$this->returnJson(array('status' => 'error','msg' => 'Please check the form'));
    }

    function check_username(){

    }

	function user(){
		$data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('Admin User','user');
		$data += $this->get_menu();
		$this->check_userakses($data['function_id'], ACT_READ);
		$data['data'] = $this->model_user->get_all();
		$data['data_usergroup'] = $this->model_basic->select_all($this->tbl_usergroup);
		$data['content'] = $this->load->view('backend/admin_system/user',$data,true);
		$this->load->view('backend/index',$data); 
	}

	function user_add(){
		$data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('Admin User','user');
		$data += $this->get_menu();
		$this->check_userakses($data['function_id'], ACT_CREATE);
		$table_field = $this->db->list_fields($this->tbl_user);
		$insert = array();
		foreach ($table_field as $field) {
			$insert[$field] = $this->input->post($field);
		}
		$insert['password'] = $this->encrypt->encode($insert['password']);
		if($insert['username'] && $insert['password'] && $insert['realname'] && $insert['email'] && $insert['id_usergroup'] ){
			$do_insert = $this->model_basic->insert_all($this->tbl_user,$insert);
			if($do_insert)
				$this->returnJson(array('status' => 'ok','msg' => 'Input success','redirect' => $data['controller'].'/'.$data['function']));
			else
				$this->returnJson(array('status' => 'error','msg' => 'Failed when saving data'));	
		}
		else
			$this->returnJson(array('status' => 'error','msg' => 'Please check the form'));
	}

	function user_edit(){
		$data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('Admin User','user');
		$data += $this->get_menu();
		$this->check_userakses($data['function_id'], ACT_UPDATE);
		$table_field = $this->db->list_fields($this->tbl_user);
		$update = array();
		foreach ($table_field as $field) {
			$update[$field] = $this->input->post($field);
		}
		$update['password'] = $this->encrypt->encode($update['password']);
		if($update['username'] && $update['password'] && $update['realname'] && $update['email'] && $update['id_usergroup'] ){
			$do_update = $this->model_basic->update($this->tbl_user,$update,'id',$update['id']);
			if($do_update)
				$this->returnJson(array('status' => 'ok','msg' => 'Update success','redirect' => $data['controller'].'/'.$data['function']));
			else
				$this->returnJson(array('status' => 'error','msg' => 'Failed when updating data'));	
		}
		else
			$this->returnJson(array('status' => 'error','msg' => 'Please check the form'));
	}

	function user_delete(){
		$data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('Admin User','user');
		$data += $this->get_menu();
		$this->check_userakses($data['function_id'], ACT_DELETE);
		$id = $this->input->post('id');
		$do_delete = $this->model_basic->delete($this->tbl_user,'id',$id);
		if($do_delete)
			$this->returnJson(array('status' => 'ok','msg' => 'Delete success','redirect' => $data['controller'].'/'.$data['function']));
		else
			$this->returnJson(array('status' => 'error','msg' => 'Delete failed'));
	}

	function user_get(){
		$data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('Admin User','user');
		$data += $this->get_menu();
		$this->check_userakses($data['function_id'], ACT_READ);
		$id = $this->input->post('id');
		$data['row'] = $this->model_basic->select_where($this->tbl_user,'id',$id)->row();
		$data['row']->password = $this->encrypt->decode($data['row']->password);
		if($data['row'])
			$this->returnJson(array('status' => 'ok', 'data' => $data));
		else
			$this->returnJson(array('status' => 'error', 'msg' => 'Data not found'));
	}

	function user_check_email(){
		$data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('Admin User','user');
		$data += $this->get_menu();
		$this->check_userakses($data['function_id'], ACT_READ);
		$id = $this->input->post('id');
		$email = $this->input->post('email');
		if($id == null || $id == ''){
			$check = $this->model_basic->select_where($this->tbl_user,'email',$email)->num_rows();
			if($check == 0)
				echo 'true';
			else
				echo 'false';
		}
		else{
			$now = $this->model_basic->select_where_array($this->tbl_user,'id != '.$id.' and email = "'.$email.'"')->num_rows();
			if($now == 0)
				echo 'true';
			else{
				echo 'false';
			}
		}
	}

	function user_check_username(){
		$data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('Admin User','user');
		$data += $this->get_menu();
		$this->check_userakses($data['function_id'], ACT_READ);
		$id = $this->input->post('id');
		$username = $this->input->post('username');
		if($id == null || $id == ''){
			$check = $this->model_basic->select_where($this->tbl_user,'username',$username)->num_rows();
			if($check == 0)
				echo 'true';
			else
				echo 'false';
		}
		else{
			$now = $this->model_basic->select_where_array($this->tbl_user,'id != '.$id.' and username = "'.$username.'"')->num_rows();
			if($now == 0)
				echo 'true';
			else{
				echo 'false';
			}
		}
	}

	function menu(){
    	$data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('Admin Menu','menu');
		$data += $this->get_menu();
		$this->check_userakses($data['function_id'], ACT_READ);
		$data['data'] = $this->model_menu->get_all();
		$data['data_parent'] = $this->model_basic->select_where($this->tbl_menu,'id_parent',0)->result();
		$data['data_icon'] = $this->model_basic->select_where($this->tbl_master_data,'id_parent',1)->result();
		$data['content'] = $this->load->view('backend/admin_system/menu',$data,true);
		$this->load->view('backend/index',$data); 
    }

    function menu_add(){
    	$data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('Admin Menu','menu');
		$data += $this->get_menu();
		$this->check_userakses($data['function_id'], ACT_CREATE);
		$table_field = $this->db->list_fields($this->tbl_menu);
		$insert = array();
		foreach ($table_field as $field) {
			$insert[$field] = $this->input->post($field);
		}
		if($insert['name'] && $insert['target'] && $insert['icon']){
			$do_insert = $this->model_basic->insert_all($this->tbl_menu,$insert);
			if($do_insert)
				$this->returnJson(array('status' => 'ok','msg' => 'Input success','redirect' => $data['controller'].'/'.$data['function']));
			else
				$this->returnJson(array('status' => 'error','msg' => 'Failed when saving data'));	
		}
		else
			$this->returnJson(array('status' => 'error','msg' => 'Please check the form'));
    }

    function menu_edit(){
    	$data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('Admin Menu','menu');
		$data += $this->get_menu();
		$this->check_userakses($data['function_id'], ACT_UPDATE);
		$table_field = $this->db->list_fields($this->tbl_menu);
		$update = array();
		foreach ($table_field as $field) {
			$update[$field] = $this->input->post($field);
		}
		if($update['name'] && $update['target'] && $update['icon']){
			$do_update = $this->model_basic->update($this->tbl_menu,$update,'id',$update['id']);
			if($do_update)
				$this->returnJson(array('status' => 'ok','msg' => 'Update success','redirect' => $data['controller'].'/'.$data['function']));
			else
				$this->returnJson(array('status' => 'error','msg' => 'Failed when updating data'));	
		}
		else
			$this->returnJson(array('status' => 'error','msg' => 'Please check the form'));
    }

    function menu_delete(){
    	$data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('Admin Menu','menu');
		$data += $this->get_menu();
		$this->check_userakses($data['function_id'], ACT_DELETE);
		$id = $this->input->post('id');
		$do_delete = $this->model_basic->delete($this->tbl_menu,'id',$id);
		$do_delete_child = $this->model_basic->delete($this->tbl_menu,'id_parent',$id);
		$do_delete_useraccess = $this->model_basic->delete($this->tbl_useraccess,'id_menu',$id);
		if($do_delete)
			$this->returnJson(array('status' => 'ok','msg' => 'Delete success','redirect' => $data['controller'].'/'.$data['function']));
		else
			$this->returnJson(array('status' => 'error','msg' => 'Delete failed'));
    }

    function menu_get(){
    	$data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('Admin Menu','menu');
		$data += $this->get_menu();
		$this->check_userakses($data['function_id'], ACT_READ);
		$id = $this->input->post('id');
		$data['row'] = $this->model_basic->select_where($this->tbl_menu,'id',$id)->row();
		if($data['row'])
			$this->returnJson(array('status' => 'ok', 'data' => $data));
		else
			$this->returnJson(array('status' => 'error', 'msg' => 'Data not found'));
    }

    function usergroup(){
    	$data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('Admin Usergroup','usergroup');
		$data += $this->get_menu();
		$this->check_userakses($data['function_id'], ACT_READ);
		$data['data'] = $this->model_usergroup->get_all();
		$data['content'] = $this->load->view('backend/admin_system/usergroup',$data,true);
		$this->load->view('backend/index',$data); 
    }

    function usergroup_add(){
    	$data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('Admin Usergroup','usergroup');
		$data += $this->get_menu();
		$this->check_userakses($data['function_id'], ACT_CREATE);
		$table_field = $this->db->list_fields($this->tbl_usergroup);
		$insert = array();
		foreach ($table_field as $field) {
			$insert[$field] = $this->input->post($field);
		}
		if($insert['usergroup_name']){
			$do_insert = $this->model_basic->insert_all($this->tbl_usergroup,$insert);
			if($do_insert)
				$this->returnJson(array('status' => 'ok','msg' => 'Input success','redirect' => $data['controller'].'/'.$data['function']));
			else
				$this->returnJson(array('status' => 'error','msg' => 'Failed when saving data'));	
		}
		else
			$this->returnJson(array('status' => 'error','msg' => 'Please check the form'));
    }

    function usergroup_edit(){
    	$data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('Admin Usergroup','usergroup');
		$data += $this->get_menu();
		$this->check_userakses($data['function_id'], ACT_UPDATE);
		$table_field = $this->db->list_fields($this->tbl_usergroup);
		$update = array();
		foreach ($table_field as $field) {
			$update[$field] = $this->input->post($field);
		}
		if($update['usergroup_name']){
			$do_update = $this->model_basic->update($this->tbl_usergroup,$update,'id',$update['id']);
			if($do_update)
				$this->returnJson(array('status' => 'ok','msg' => 'Update success','redirect' => $data['controller'].'/'.$data['function']));
			else
				$this->returnJson(array('status' => 'error','msg' => 'Failed when updating data'));	
		}
		else
			$this->returnJson(array('status' => 'error','msg' => 'Please check the form'));
    }

    function usergroup_delete(){
    	$data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('Admin Usergroup','usergroup');
		$data += $this->get_menu();
		$this->check_userakses($data['function_id'], ACT_DELETE);
		$id = $this->input->post('id');
		$do_delete = $this->model_basic->delete($this->tbl_usergroup,'id',$id);
		$do_delete_useraccess = $this->model_basic->delete($this->tbl_useraccess,'id_usergroup',$id);
		if($do_delete)
			$this->returnJson(array('status' => 'ok','msg' => 'Delete success','redirect' => $data['controller'].'/'.$data['function']));
		else
			$this->returnJson(array('status' => 'error','msg' => 'Delete failed'));
    }

    function usergroup_get(){
    	$data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('Admin Usergroup','usergroup');
		$data += $this->get_menu();
		$this->check_userakses($data['function_id'], ACT_READ);
		$id = $this->input->post('id');
		$data['row'] = $this->model_basic->select_where($this->tbl_usergroup,'id',$id)->row();
		if($data['row'])
			$this->returnJson(array('status' => 'ok', 'data' => $data));
		else
			$this->returnJson(array('status' => 'error', 'msg' => 'Data not found'));
    }

    function useraccess(){
    	$data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('Admin Useraccess','useraccess');
		$data += $this->get_menu();
		$this->check_userakses($data['function_id'], ACT_READ);
		$data['data'] = $this->model_useraccess->get_all();
		$data['data_menu'] = $this->get_all_menu();
		$data['data_available_user'] = $this->model_useraccess->get_available_user();
		$data['content'] = $this->load->view('backend/admin_system/useraccess',$data,true);
		$this->load->view('backend/index',$data); 
    }

    function useraccess_add(){
    	$data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('Admin Useraccess','useraccess');
		$data += $this->get_menu();
		$this->check_userakses($data['function_id'], ACT_CREATE);

		$id_menu = $this->input->post('id_menu');
		$act_read = $this->input->post('act_read');
		$act_create = $this->input->post('act_create');
		$act_update = $this->input->post('act_update');
		$act_delete = $this->input->post('act_delete');

		if($this->input->post('id_usergroup')) {
			$error = 0;
			foreach($id_menu as $mi) {
				$data_insert = array(
					'id_usergroup' => $this->input->post('id_usergroup'),
					'id_menu' => $mi,
					'act_create' => $act_create[$mi],
					'act_read' => $act_read[$mi],
					'act_update' => $act_update[$mi],
					'act_delete' => $act_delete[$mi]
					);
				$insert = $this->model_basic->insert_all($this->tbl_useraccess,$data_insert);
				if(!$insert)
					$error++;
			}
			if($error == 0)
				$this->returnJson(array('status' => 'ok','msg' => 'Input success','redirect' => $data['controller'].'/'.$data['function']));
			else
				$this->returnJson(array('status' => 'error','msg' => 'Failed when saving data'));
		}
		else
			$this->returnJson(array('status' => 'error','msg' => 'Please check the form'));
    }

    function useraccess_edit(){
    	$data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('Admin Useraccess','useraccess');
		$data += $this->get_menu();
		$this->check_userakses($data['function_id'], ACT_UPDATE);

		$id = $this->input->post('id');
		$id_menu = $this->input->post('id_menu');
		$id_useraccess = $this->input->post('id_useraccess');
		$act_read = $this->input->post('act_read');
		$act_create = $this->input->post('act_create');
		$act_update = $this->input->post('act_update');
		$act_delete = $this->input->post('act_delete');

		if($id) {
			$error = 0;
			foreach ($id_menu as $mi) {
				if(isset($id_useraccess[$mi])){
					$data_update = array(
						'act_create' => $act_create[$mi],
						'act_read' => $act_read[$mi],
						'act_update' => $act_update[$mi],
						'act_delete' => $act_delete[$mi]
						);
					$update = $this->model_basic->update($this->tbl_useraccess,$data_update,'id',$id_useraccess[$mi]);
					if(!$update)
						$error++;
				}
				else {
					$data_insert = array(
						'id_usergroup' => $id,
						'id_menu' => $mi,
						'act_read' => $act_read[$mi],
						'act_create' => $act_create[$mi],
						'act_update' => $act_update[$mi],
						'act_delete' => $act_delete[$mi]
						);
					$insert = $this->model_basic->insert_all($this->tbl_useraccess,$data_insert);
					if(!$insert)
						$error++;
				}
			}
			if($error == 0)
				$this->returnJson(array('status' => 'ok','msg' => 'Update success','redirect' => $data['controller'].'/'.$data['function']));
			else
				$this->returnJson(array('status' => 'error','msg' => 'Failed when updating data'));
		}
		else
			$this->returnJson(array('status' => 'error','msg' => 'Please check the form'));
    }

    function useraccess_delete(){
    	$data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('Admin Useraccess','useraccess');
		$data += $this->get_menu();
		$this->check_userakses($data['function_id'], ACT_DELETE);
		$id = $this->input->post('id');
		$do_delete = $this->model_basic->delete($this->tbl_useraccess,'id_usergroup',$id);
		if($do_delete)
			$this->returnJson(array('status' => 'ok','msg' => 'Delete success','redirect' => $data['controller'].'/'.$data['function']));
		else
			$this->returnJson(array('status' => 'error','msg' => 'Delete failed'));
    }

    function master_data($id_parent = 0){
    	$data = $this->get_app_settings();
		$data += $this->controller_attr;
		if($id_parent==0)
			$data += $this->get_function('Admin Master Data','master_data');
		else
		{
			$master_parent = $this->model_basic->select_where($this->tbl_master_data,'id',$id_parent)->row();
			$data += $this->get_function('Admin Master Data '.$master_parent->content,'master_data');
		}
		$data += $this->get_menu();
		$this->check_userakses($data['function_id'], ACT_READ);
		$data['id_parent'] = $id_parent;
		$data['data'] = $this->model_master->get_all($id_parent);
		$data['content'] = $this->load->view('backend/admin_system/master_data',$data,true);
		$this->load->view('backend/index',$data); 
    }

    function master_data_add(){
    	$data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('Admin Master Data','master_data');
		$data += $this->get_menu();
		$this->check_userakses($data['function_id'], ACT_CREATE);
		$table_field = $this->db->list_fields($this->tbl_master_data);
		$insert = array();
		foreach ($table_field as $field) {
			$insert[$field] = $this->input->post($field);
		}
		if($insert['content']){
			$do_insert = $this->model_basic->insert_all($this->tbl_master_data,$insert);
			if($do_insert){
				if($insert['id_parent'])
					$redirect = $data['controller'].'/'.$data['function'].'/'.$insert['id_parent'];
				else
					$redirect = $data['controller'].'/'.$data['function'];
					$this->returnJson(array('status' => 'ok','msg' => 'Input success','redirect' => $redirect));
			}
			else
				$this->returnJson(array('status' => 'error','msg' => 'Failed when saving data'));	
		}
		else
			$this->returnJson(array('status' => 'error','msg' => 'Please check the form'));
    }

    function master_data_edit(){
    	$data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('Admin Master Data','master_data');
		$data += $this->get_menu();
		$this->check_userakses($data['function_id'], ACT_UPDATE);
		$table_field = $this->db->list_fields($this->tbl_master_data);
		$update = array();
		foreach ($table_field as $field) {
			$update[$field] = $this->input->post($field);
		}
		if($update['content']){
			$do_update = $this->model_basic->update($this->tbl_master_data,$update,'id',$update['id']);
			if($do_update){
				if($update['id_parent'])
					$redirect = $data['controller'].'/'.$data['function'].'/'.$update['id_parent'];
				else
					$redirect = $data['controller'].'/'.$data['function'];
				$this->returnJson(array('status' => 'ok','msg' => 'Update success','redirect' => $redirect));
			}
			else
				$this->returnJson(array('status' => 'error','msg' => 'Failed when updating data'));	
		}
		else
			$this->returnJson(array('status' => 'error','msg' => 'Please check the form'));
    }

    function master_data_delete(){
    	$data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('Admin Master Data','master_data');
		$data += $this->get_menu();
		$this->check_userakses($data['function_id'], ACT_DELETE);
		$id = $this->input->post('id');
		$deleted_data = $this->model_basic->select_where($this->tbl_master_data,'id',$id)->row();
		$do_delete = $this->model_basic->delete($this->tbl_master_data,'id',$id);
		$do_delete_child = $this->model_basic->delete($this->tbl_master_data,'id_parent',$id);
		if($do_delete){
			if($deleted_data->id_parent > 0)
				$redirect = $data['controller'].'/'.$data['function'].'/'.$deleted_data->id_parent;
			else
				$redirect = $data['controller'].'/'.$data['function'];
			$this->returnJson(array('status' => 'ok','msg' => 'Delete success','redirect' => $redirect));
		}
		else
			$this->returnJson(array('status' => 'error','msg' => 'Delete failed'));
    }

    function master_data_get(){
    	$data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('Admin Master Data','master_data');
		$data += $this->get_menu();
		$this->check_userakses($data['function_id'], ACT_READ);
		$id = $this->input->post('id');
		$data['row'] = $this->model_basic->select_where($this->tbl_master_data,'id',$id)->row();
		if($data['row'])
			$this->returnJson(array('status' => 'ok', 'data' => $data));
		else
			$this->returnJson(array('status' => 'error', 'msg' => 'Data not found'));
    }

    function useraccess_get(){
    	$data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('Admin Useraccess','useraccess');
		$data += $this->get_menu();
		$this->check_userakses($data['function_id'], ACT_READ);
		$id = $this->input->post('id');
		$data['row'] = $this->model_basic->select_where($this->tbl_useraccess,'id_usergroup',$id)->result();
		if($data['row'])
			$this->returnJson(array('status' => 'ok', 'data' => $data));
		else
			$this->returnJson(array('status' => 'error', 'msg' => 'Data not found'));
    }

    function settings(){
    	$data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('Admin Settings','settings');
		$data += $this->get_menu();
		$this->check_userakses($data['function_id'], ACT_READ);
        $data['underconstruct_status'] = $this->model_basic->select_where($this->tbl_underconstruct_status, 'id', 1)->row()->underconstruct_status;
		$data['data'] = $this->model_usergroup->get_all();
		$data['content'] = $this->load->view('backend/admin_system/settings',$data,true);
		$this->load->view('backend/index',$data); 
    }

    function settings_edit(){
    	$data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('Admin Settings','settings');
		$data += $this->get_menu();
		$this->check_userakses($data['function_id'], ACT_UPDATE);
		$table_field = $this->db->list_fields($this->tbl_adm_config);
		$update = array();
		foreach ($table_field as $field) {
			$update[$field] = $this->input->post($field);
		}
		if($update['login_logo']){
			if(!@copy($update['login_logo'],'assets/uploads/app_settings/'.basename($update['login_logo'])))
				$update['login_logo'] = $this->input->post('old_login_logo');
			else
				$update['login_logo'] = basename($update['login_logo']);
		}
		else
			$update['login_logo'] = $this->input->post('old_login_logo');

		if($update['mini_logo']){
			if(!@copy($update['mini_logo'],'assets/uploads/app_settings/'.basename($update['mini_logo'])))
				$update['mini_logo'] = $this->input->post('old_mini_logo');
			else
				$update['mini_logo'] = basename($update['mini_logo']);
		}
		else
			$update['mini_logo'] = $this->input->post('old_mini_logo');

		if($update['single_logo']){
			if(!@copy($update['single_logo'],'assets/uploads/app_settings/'.basename($update['single_logo'])))
				$update['single_logo'] = $this->input->post('old_single_logo');
			else
				$update['single_logo'] = basename($update['single_logo']);
		}
		else
			$update['single_logo'] = $this->input->post('old_single_logo');

		if($update['favicon_logo']){
			if(!@copy($update['favicon_logo'],'assets/uploads/app_settings/'.basename($update['favicon_logo'])))
				$update['favicon_logo'] = $this->input->post('old_favicon_logo');
			else
				$update['favicon_logo'] = basename($update['favicon_logo']);
		}
		else
			$update['favicon_logo'] = $this->input->post('old_favicon_logo');

		if($update['title'] && $update['desc']){
			$do_update = $this->model_basic->update($this->tbl_adm_config,$update,'id',$update['id']);
			if($do_update){
				$this->delete_temp('temp_folder');
				$this->returnJson(array('status' => 'ok','msg' => 'Update success','redirect' => $data['controller'].'/'.$data['function']));
			}
			else
				$this->returnJson(array('status' => 'error','msg' => 'Failed when updating data'));	
		}
		else
			$this->returnJson(array('status' => 'error','msg' => 'Please check the form'));
    }

    function menu_orders(){
    	$data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('Admin Menu Orders','menu_orders');
		$data += $this->get_menu();
		$this->check_userakses($data['function_id'], ACT_READ);
		$data['data'] = $this->get_all_menu();
		$data['content'] = $this->load->view('backend/admin_system/menu_orders',$data,true);
		$this->load->view('backend/index',$data); 
    }

    function menu_orders_edit(){
    	$data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('Admin Menu Orders','menu_orders');
		$data += $this->get_menu();
		$this->check_userakses($data['function_id'], ACT_UPDATE);
		
		$item = $this->input->post('item');

		if(count($item) > 0){
			$orders = 1;
			$error = 0;
			foreach ($item as $menu_id) {
				$update['orders'] = $orders;
				if(!$this->model_basic->update($this->tbl_menu,$update,'id',$menu_id))
					$error++;
				$orders++;
			}
			if($error < 1)
				$this->returnJson(array('status' => 'ok','msg' => 'Update success'));
			else
				$this->returnJson(array('status' => 'error','msg' => 'Failed when updating data'));
		}
		else
			$this->returnJson(array('status' => 'error','msg' => 'Please check the form'));
    }

    function logs(){
    	$data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('Admin Usergroup','usergroup');
		$data += $this->get_menu();
		$this->check_userakses($data['function_id'], ACT_READ);
		$data['data'] = $this->model_usergroup->get_all();
		$data['content'] = $this->load->view('backend/admin_system/usergroup',$data,true);
		$this->load->view('backend/index',$data); 
    }

    function logs_add(){
    	$data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('Admin Usergroup','usergroup');
		$data += $this->get_menu();
		$this->check_userakses($data['function_id'], ACT_CREATE);
		$table_field = $this->db->list_fields($this->tbl_usergroup);
		$insert = array();
		foreach ($table_field as $field) {
			$insert[$field] = $this->input->post($field);
		}
		if($insert['usergroup_name']){
			$do_insert = $this->model_basic->insert_all($this->tbl_usergroup,$insert);
			if($do_insert)
				$this->returnJson(array('status' => 'ok','msg' => 'Input success','redirect' => $data['controller'].'/'.$data['function']));
			else
				$this->returnJson(array('status' => 'error','msg' => 'Failed when saving data'));	
		}
		else
			$this->returnJson(array('status' => 'error','msg' => 'Please check the form'));
    }

    function logs_edit(){
    	$data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('Admin Usergroup','usergroup');
		$data += $this->get_menu();
		$this->check_userakses($data['function_id'], ACT_UPDATE);
		$table_field = $this->db->list_fields($this->tbl_usergroup);
		$update = array();
		foreach ($table_field as $field) {
			$update[$field] = $this->input->post($field);
		}
		if($update['usergroup_name']){
			$do_update = $this->model_basic->update($this->tbl_usergroup,$update,'id',$update['id']);
			if($do_update)
				$this->returnJson(array('status' => 'ok','msg' => 'Update success','redirect' => $data['controller'].'/'.$data['function']));
			else
				$this->returnJson(array('status' => 'error','msg' => 'Failed when updating data'));	
		}
		else
			$this->returnJson(array('status' => 'error','msg' => 'Please check the form'));
    }

    function logs_delete(){
    	$data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('Admin Usergroup','usergroup');
		$data += $this->get_menu();
		$this->check_userakses($data['function_id'], ACT_DELETE);
		$id = $this->input->post('id');
		$do_delete = $this->model_basic->delete($this->tbl_usergroup,'id',$id);
		if($do_delete)
			$this->returnJson(array('status' => 'ok','msg' => 'Delete success','redirect' => $data['controller'].'/'.$data['function']));
		else
			$this->returnJson(array('status' => 'error','msg' => 'Delete failed'));
    }

    function logs_get(){
    	$data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('Admin Usergroup','usergroup');
		$data += $this->get_menu();
		$this->check_userakses($data['function_id'], ACT_READ);
		$id = $this->input->post('id');
		$data['row'] = $this->model_basic->select_where($this->tbl_usergroup,'id',$id)->row();
		if($data['row'])
			$this->returnJson(array('status' => 'ok', 'data' => $data));
		else
			$this->returnJson(array('status' => 'error', 'msg' => 'Data not found'));
    }

    function change_status_underconstruction()
    {
        $value = $this->input->post('value');
        if($value == 0)
            $new_value = 1;
        else
            $new_value = 0;
        $data_update = array('underconstruct_status' => $new_value);
        if(!$this->model_basic->update($this->tbl_underconstruct_status, $data_update, 'id', 1))
                $this->returnJson (array('status' => 'error'));
        else
        {
            $data = $this->model_basic->select_where($this->tbl_underconstruct_status, 'id', 1)->row();
            $this->returnJson(array('status' => 'ok', 'underconstruct_status' => $data->underconstruct_status));
        }
    }

}
