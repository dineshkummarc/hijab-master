<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Checkout extends PX_Controller{
	function __construct(){
		parent::__construct();
		$this->controller_attr = array('controller' => 'checkout','controller_name' => 'Checkout');
                $this->do_underconstruct();
	}

	public function index(){
		$data = $this->controller_attr;
		$data += $this->get_function('Checkout','checkout');
		$data['page'] = $this->load->view('frontend/checkout/index',$data,true);
		$this->load->view('frontend/layout',$data);
	}
}