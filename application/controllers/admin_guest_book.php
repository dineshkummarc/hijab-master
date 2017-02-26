<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class admin_guest_book extends PX_Controller {
	function __construct() {
		parent::__construct();
		$this->controller_attr = array('controller' => 'admin_guest_book', 'controller_name' => 'Admin Customer Messages', 'controller_id' => 0);
        $this->check_login();
	}
	public function index(){
		$data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Customer Messages','customer_messages');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_READ);

		$guest_book = $this->model_basic->select_all_order($this->tbl_guest_book, 'date_created', 'DESC');
		foreach($guest_book as $data_row)
		{
			$data_row->subject = substr($data_row->subject, 0, 30).'...';
			$data_row->message = substr($data_row->content, 0, 50).'...';
			$data_row->date_created = $this->date_format('l, d F Y h:i:s', $data_row->date_created);
		}

		$data['guest_book'] = $guest_book;
		$data['guest_book_unread'] = $this->get_guest_book();
		$data['submenu'] = $this->get_submenu($data['controller']);
		$data['content'] = $this->load->view('backend/guest_book/inbox',$data,true);
		$this->load->view('backend/index',$data);
	}

	function read_messages($id)
	{
		$data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Customer Messages','customer_messages');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_READ);

		$data['messages'] = $this->model_basic->select_where($this->tbl_guest_book, 'id', $id)->row();
		$data['messages']->date_created = $this->date_format('l, d F Y h:i:s', $data['messages']->date_created);

		$update_read_flag = array('read_flag' => 1);
		$this->model_basic->update($this->tbl_guest_book, $update_read_flag, 'id', $id);

		$data['guest_book_unread'] = $this->get_guest_book();
		$data['submenu'] = $this->get_submenu($data['controller']);
		$data['content'] = $this->load->view('backend/guest_book/read_messages',$data,true);
		$this->load->view('backend/index',$data);
	}

	function delete_messages()
	{
            $data = $this->controller_attr;
            $data += $this->get_function('Main', 'index');
            $messages_id = $this->input->post('messages_id');
            if ($messages_id == NULL) {
                redirect($data['controller'] . '/?delete=kosong');
            } else {
                foreach ($messages_id as $data_row) {
                    if (!$this->delete_each_messsages($data_row)) {
                        redirect($data['controller'] . '/?delete=error');
                        break;
                    }
                }
                redirect($data['controller'] . '/?delete=ok');
            }
	}

	function delete_each_messsages($messages_id)
	{
		if(!$this->model_basic->delete($this->tbl_guest_book, 'id', $messages_id))
			return FALSE;
		return TRUE;
	}
}
