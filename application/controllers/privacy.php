<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Privacy extends PX_Controller {

	public function __construct() {
		parent::__construct();
		$this->controller_attr = array('controller' => 'privacy','controller_name' => 'Privacy Policy','controller_id' => 0);
                $this->do_underconstruct();
	}


	function index(){
		$data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('privacy','Privacy Policy');
		$data['address']= $this->model_basic->select_where($this->tbl_static_content,'id','6')->row();
		$data['phone']= $this->model_basic->select_where($this->tbl_static_content,'id','7')->row();
		$data['fax']= $this->model_basic->select_where($this->tbl_static_content,'id','8')->row();
		$data['page']= $this->model_basic->select_where($this->tbl_static_content,'id','9')->row();
		$data['content'] = $this->load->view('frontend/privacy/index',$data,true);
		$this->load->view('frontend/index',$data); 
	}

	
}
