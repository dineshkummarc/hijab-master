<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_service extends PX_Controller {

	public function __construct() {
		parent::__construct();
		$this->controller_attr = array('controller' => 'customer_service','controller_name' => 'Customer Service','controller_id' => 0);
                $this->do_underconstruct();
	}


	function index(){
		$data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('customer_service','Customer Service');
		$data['page']= $this->model_basic->select_where($this->tbl_static_content,'id','4')->row();
		$data['address']= $this->model_basic->select_where($this->tbl_static_content,'id','6')->row();
		$data['phone']= $this->model_basic->select_where($this->tbl_static_content,'id','7')->row();
		$data['fax']= $this->model_basic->select_where($this->tbl_static_content,'id','8')->row();
		$data['content'] = $this->load->view('frontend/customer/index',$data,true);
		$this->load->view('frontend/index',$data); 
	}

	
}
