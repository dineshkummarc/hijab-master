<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Error extends PX_Controller {
	function __construct() {
		parent::__construct();
		$this->controller_attr = array('controller' => 'error','controller_name' => 'Error','controller_id' => 0);
                $this->do_underconstruct();
	}
	public function index() {
		$data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('Error','index');
		$this->load->view('frontend/error_404',$data);
	}
}