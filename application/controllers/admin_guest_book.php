<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_guest_book extends PX_Controller {

	public function __construct() {
		parent::__construct();
		$this->check_login();
		$this->controller_attr = array('controller' => 'admin_guest_book','controller_name' => 'Admin Guest Book','controller_id' => 0);
	}

	public function index(){
		$data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('Admin Guest Book','admin_guest_book');
		$data += $this->get_menu();
		$this->check_userakses($data['function_id'], ACT_READ);
		$data['data'] = $this->model_basic->select_all($this->tbl_guest_book);
		$data['view_status'] = 'all';
		$data['content'] = $this->load->view('backend/admin_guest_book/index',$data,true);
		$this->load->view('backend/index',$data); 
	}
	function new_item(){
		$data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('Admin Guest Book','admin_guest_book');
		$data += $this->get_menu();
		$this->check_userakses($data['function_id'], ACT_READ);
		$data['data'] = $this->model_basic->select_where($this->tbl_guest_book,'status',0)->result();
		$data['view_status'] = 'new';
		$data['content'] = $this->load->view('backend/admin_guest_book/index',$data,true);
		$this->load->view('backend/index',$data); 
	}
	function reply_item(){
		$data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('Admin Guest Book','admin_guest_book');
		$data += $this->get_menu();
		$this->check_userakses($data['function_id'], ACT_READ);
		$data['data'] = $this->model_basic->select_where($this->tbl_guest_book,'id_parent >',0)->result();
		$data['view_status'] = 'reply';
		$data['content'] = $this->load->view('backend/admin_guest_book/index',$data,true);
		$this->load->view('backend/index',$data); 
	}
	function read($id){
		$data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('Admin Guest Book','admin_guest_book');
		$data += $this->get_menu();
		$this->check_userakses($data['function_id'], ACT_READ);

		if($id){
			$read = array(
				'status' => 1,
				'date_read' => date('d-m-Y H:i:s',now())
				);
			$this->model_basic->update($this->tbl_guest_book,$read,'id',$id);
			$data['data'] = $this->model_basic->select_where($this->tbl_guest_book,'id',$id)->row();
			$data['content'] = $this->load->view('backend/admin_guest_book/read',$data,true);
			$this->load->view('backend/index',$data);
		}
		else
			redirect($data['controller']);
	}
	function do_delete(){
		$data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('Admin Guest Book','admin_guest_book');
		$data += $this->get_menu();
		$this->check_userakses($data['function_id'], ACT_DELETE);

		$id = $this->input->post('delete');
		$error = 0;
		foreach ($id as $id) {
			$do_delete = $this->model_basic->delete($this->tbl_guest_book,'id',$id);
			if(!$do_delete)
				$error++;
		}
		if($error < 1){
			$this->returnJson(array('status' => 'ok','msg' => 'Data berhasil dihapus','redirect' => $data['controller'].'/'.$data['function']));
		}
		else
			$this->returnJson(array('status' => 'error','msg' => 'Data gagal dihapus'));
	}
}