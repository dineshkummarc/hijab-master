<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email extends PX_Controller {
	function __construct() {
		parent::__construct();
		$this->controller_attr = array('controller' => 'email','controller_name' => 'Email','controller_id' => 0);
                $this->do_underconstruct();
	}
	public function index() {
		$data = $this->get_app_settings();
		$data += $this->controller_attr;
                $data['customer'] = $this->model_basic->select_where($this->tbl_customer, 'id', 9)->row();
                $data['customer']->password = $this->encrypt->decode($data['customer']->password);
		$content = $this->load->view('frontend/email/register_success',$data,true);
                $email_data = new stdClass();
                $email_data->receiver = $data['customer']->email;
                $email_data->subject = 'Selamat datang di Hijab Dept E-Commerce';
                $email_data->message = $content;
                if($this->send_email($email_data))
                    echo 'Success';
                else echo 'Failed';
	}
}