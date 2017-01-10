<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Zubair
 * Date: 10-01-2017
 * Time: 1:37 PM
 */
class admin_voucher extends PX_Controller
{
    function __construct() {
        parent:: __construct();
        $this->controller_attr = array('controller' => 'admin_voucher', 'controller_name' => 'Admin Voucher', 'controller_id' => 0);
        $this->check_login();
    }

    public function global_voucher() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Voucher', 'global_voucher');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_READ);

        $data['voucher_list'] = $this->model_basic->select_where($this->tbl_voucher, 'delete_flag', 0)->result();
        $data['content'] = $this->load->view('backend/voucher/global_voucher', $data, true);
        $this->load->view('backend/index', $data);
    }

    function global_voucher_form() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Admin Voucher', 'global_voucher');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_CREATE);
        $id = $this->input->post('id');
        if ($id) {
            $data['data'] = $this->model_basic->select_where($this->tbl_voucher, 'id', $id)->row();
            $data['data']->date_start = date('Y-m-d', strtotime($data['data']->date_start));
            $data['data']->date_end = date('Y-m-d', strtotime($data['data']->date_end));
        } else
            $data['data'] = null;
        $data['content'] = $this->load->view('backend/voucher/global_voucher_form', $data, true);
        $this->load->view('backend/index', $data);
    }

    function global_voucher_add() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Admin Voucher', 'global_voucher');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_CREATE);

//        $images = $this->input->post('images');
        $table_field = $this->db->list_fields($this->tbl_voucher);
        $insert = array();
        foreach ($table_field as $field) {
            $insert[$field] = $this->input->post($field);
        }
        $insert['date_created'] = date('Y-m-d H:i:s', now());
        $insert['status'] = '0';
        if ($insert['voucher']) {
            $do_insert = $this->model_basic->insert_all($this->tbl_voucher, $insert);
            if ($do_insert) {
                $this->returnJson(array('status' => 'ok', 'msg' => 'Input data success', 'redirect' => $data['controller'] . '/' . $data['function']));
            }
            else
                $this->returnJson(array('status' => 'error', 'msg' => 'Failed when saving data'));
        }
        else
            $this->returnJson(array('status' => 'error', 'msg' => 'Please complete the form'));
    }

    function global_voucher_edit() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Admin Voucher', 'global_voucher');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_UPDATE);
        
        $table_field = $this->db->list_fields($this->tbl_voucher);
        $update = array();
        foreach ($table_field as $field) {
            $update[$field] = $this->input->post($field);
        }
        if ($update['voucher']) {
            $do_update = $this->model_basic->update($this->tbl_voucher, $update, 'id', $update['id']);
            if ($do_update)
                $this->returnJson(array('status' => 'ok', 'msg' => 'Update success', 'redirect' => $data['controller'] . '/' . $data['function']));
            else
                $this->returnJson(array('status' => 'error', 'msg' => 'Failed when updating data'));
        }
        else
            $this->returnJson(array('status' => 'error', 'msg' => 'Please complete the form'));
    }

    function global_voucher_delete() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Admin Voucher', 'global_voucher');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_DELETE);
        $id = $this->input->post('id');
        $delete_flag = array(
            'delete_flag' => '1'
        );
        $do_delete = $this->model_basic->update($this->tbl_voucher, $delete_flag, 'id', $id);
        if ($do_delete) {
//            $this->delete_folder('static_content/' . $id);
            $this->returnJson(array('status' => 'ok', 'msg' => 'Delete Success', 'redirect' => $data['controller'] . '/' . $data['function']));
        }
        else
            $this->returnJson(array('status' => 'error', 'msg' => 'Delete Failed'));
    }

    function global_voucher_status_edit() {
        $id = $this->input->post('id');
        $voucher = $this->model_basic->select_where($this->tbl_voucher, 'id', $id)->row();
        if ($voucher) {
            if ($voucher->status == 0)
                $change_status = 1;
            else
                $change_status = 0;
            $update = array('status' => $change_status);
            if (!$this->model_basic->update($this->tbl_voucher, $update, 'id', $id))
                $this->returnJson(array('status' => 'failed', 'msg' => 'Update Status Failed'));
            else
                $this->returnJson(array('status' => 'ok', 'promo_status' => $change_status, 'id' => $id));
        }
        else {
            $this->returnJson(array('status' => 'failed', 'msg' => 'Update Status Failed'));
        }
    }
}