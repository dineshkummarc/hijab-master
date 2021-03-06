<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faq extends PX_Controller {

	public function __construct() {
		parent::__construct();
		$this->controller_attr = array('controller' => 'faq','controller_name' => 'Faq','controller_id' => 0);
                $this->do_underconstruct();
	}


	function index(){
		$data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('faq','Faq');
//        $data['last_update'] = $this->model_basic->select_all_limit_order($this->tbl_faq,'1','date_modified','desc')->row();
//        if($data['last_update'])
//            $data['last_update']->date_modified = date('F d Y', strtotime($data['last_update']->date_modified));

        $data['data'] = $this->model_basic->select_all($this->tbl_faq);
		$data['address']= $this->model_basic->select_where($this->tbl_static_content,'id','6')->row();
		$data['phone']= $this->model_basic->select_where($this->tbl_static_content,'id','7')->row();
		$data['fax']= $this->model_basic->select_where($this->tbl_static_content,'id','8')->row();
		$data['content'] = $this->load->view('frontend/faq/index',$data,true);
		$this->load->view('frontend/index',$data); 
	}

	
}
