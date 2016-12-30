<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fashion extends PX_Controller{
	function __construct(){
		parent::__construct();
		$this->controller_attr = array('controller' => 'fashion','controller_name' => 'Fashion');
                $this->do_underconstruct();
	}

	public function index(){
		$data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('Fashion','fashion');
		$data['address']= $this->model_basic->select_where($this->tbl_static_content,'id','6')->row();
		$data['phone']= $this->model_basic->select_where($this->tbl_static_content,'id','7')->row();
		$data['fax']= $this->model_basic->select_where($this->tbl_static_content,'id','8')->row();
		$data['content'] = $this->load->view('frontend/fashion/index',$data,true);
		$this->load->view('frontend/index',$data);
	}
}