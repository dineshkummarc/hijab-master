<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blog extends PX_Controller{
	function __construct(){
		parent::__construct();
		$this->controller_attr = array('controller' => 'blog','controller_name' => 'Blog');
                $this->do_underconstruct();
	}

	public function index(){
		$data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('Blog','blog');
		$data['address']= $this->model_basic->select_where($this->tbl_static_content,'id','6')->row();
		$data['phone']= $this->model_basic->select_where($this->tbl_static_content,'id','7')->row();
		$data['fax']= $this->model_basic->select_where($this->tbl_static_content,'id','8')->row();
		$data['content'] = $this->load->view('frontend/blog/index',$data,true);
		$this->load->view('frontend/index',$data);
	}
}