<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends PX_Controller {

    public function __construct() {
        parent::__construct();
        // $data_row_ctr = $this->model_basic->select_where($this->table_menu,'target','admin')->row();
        $this->controller_attr = array('controller' => 'admin', 'controller_name' => 'Admin', 'controller_id' => 0);
    }

    public function index() {
        $data = $this->controller_attr;
        if ($this->session->userdata('admin') != FALSE) {
            redirect('admin/dashboard');
        } else
            redirect('admin/login');
    }

    function dashboard() {
        //test
        $this->load->model('model_order', 'order');
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Admin', 'admin');
        $data += $this->get_menu();
        if ($this->session->userdata('admin') != FALSE) {
            $data['total_order'] = $this->db->get($this->tbl_order)->num_rows();
            $data['total_customer'] = $this->db->get($this->tbl_customer)->num_rows();
            $data['product_sold'] = $this->order->get_product_sold()->row()->total;
            $data['unconfirmed'] = $this->model_basic->select_where($this->tbl_order, 'status', 0)->num_rows();
            $data['paid'] = $this->model_basic->select_where($this->tbl_order, 'status', 3)->num_rows();
            $data['city'] = $this->order->order_by_city()->result();
            $data['content'] = $this->load->view('backend/admin/dashboard', $data, true);
            $this->load->view('backend/index', $data);
        } else
            redirect('admin');
    }

    function get_total_income_chart(){
        $this->load->model('model_order');
        $data = $this->model_order->get_monthly_income()->result();
        foreach ($data as $d) {  
            $datax[] = array('y' => $d->month.' - '.$d->year,
            'a' => $d->total);

        }
        echo json_encode($datax,true);
    }

    function get_total_order(){
        $this->load->model('model_order');
        $data = $this->model_order->get_total_order()->result();
        foreach ($data as $d) {
            $datax[] = array('label' => $d->status,
            'value' => $d->total);

        }
        echo json_encode($datax,true);
    }

    function get_total_customer(){
        $this->load->model('model_order');
        $data = $this->model_order->get_monthly_income()->result();
        foreach ($data as $d) {  
            $datax[] = array('y' => $d->month.' - '.$d->year,
            'a' => $d->total);

        }
        echo json_encode($datax,true);
    }

    function login() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Admin Login', 'admin_login');
        $data += $this->get_menu();
        $this->load->view('backend/admin/login', $data);
    }

    function do_login() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $user_data = $this->model_basic->select_where($this->tbl_user, 'username', $username)->row();
        if ($user_data) {
            if ($this->encrypt->decode($user_data->password) == $password) {
                $user_group = $this->model_basic->select_where($this->tbl_usergroup, 'id', $user_data->id_usergroup)->row()->usergroup_name;
                $data_user = array(
                    'admin_id' => $user_data->id,
                    'username' => $user_data->username,
                    'password' => $password,
                    'realname' => $user_data->realname,
                    'email' => $user_data->email,
                    'id_usergroup' => $user_data->id_usergroup,
                    'name_usergroup' => $user_group,
                    'photo' => $user_data->photo
                );
                $this->session->set_userdata('admin', $data_user);
                $this->returnJson(array('status' => 'ok', 'msg' => 'Login Success, you\'ll be redirect soon.', 'redirect' => 'admin/dashboard'));
            } else
                $this->returnJson(array('status' => 'error', 'msg' => 'Login failed, Wrong password.'));
        } else
            $this->returnJson(array('status' => 'error', 'msg' => 'Login failed, Username not registered.'));
    }

    function do_logout() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Admin Logout', 'admin_logout');
        $data += $this->get_menu();
        if ($this->session->userdata('admin') != FALSE) {
            $this->session->unset_userdata('admin');
            redirect('admin');
        } else
            redirect('admin');
    }

    function php_info() {
        echo phpinfo();
    }
    
    function test_send_email()
    {
        $email_data = new stdClass();
        $email_data->receiver = 'edoapriyadi@gmail.com';
        $email_data->subject = 'Test Email';
        if($this->send_email($email_data))
            echo 'Success';
        else echo 'Failed';
    }

}
