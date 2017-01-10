<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: Zubair
 * Date: 09-01-2017
 * Time: 11:54 PM
 */
class order_confirmation  extends PX_Controller
{
    function __construct() {
        parent::__construct();

        $this->controller_attr = array('controller' => 'dashboard','controller_name' => 'Order Confirmation');
        if($this->session->userdata('validated')==FALSE){
            redirect('login');
        }
        $this->do_underconstruct();
    }

    public function index(){
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Order Confirmation','User');

        $customer_id = $this->session->userdata('id');
        $data['order'] = $this->model_order->get_order_confirm($customer_id);
        $data['address']= $this->model_basic->select_where($this->tbl_static_content,'id','6')->row();
        $data['phone']= $this->model_basic->select_where($this->tbl_static_content,'id','7')->row();
        $data['fax']= $this->model_basic->select_where($this->tbl_static_content,'id','8')->row();
        $data['content'] = $this->load->view('frontend/confirmation/index', $data, true);
        $this->load->view('frontend/index', $data);

    }

    public function confirm(){
        $get_order_id = $this->model_basic->select_where($this->tbl_order, 'invoice_number', $this->input->post('order_id'))->row();
        $this->db->trans_begin();
        $data = array(
            'order_id' => $get_order_id->id,
            'account_name' => $this->input->post('account_name'),
            'account_bank' => $this->input->post('account_bank'),
            'bank_target' => $this->input->post('bank_target'),
            'total_payment' => $this->input->post('total_payment'),
            'date_transfer' => $this->input->post('date_transfer'),
            'date_created' => date('Y-m-d h:i:s', now())
        );

        $this->db->insert($this->tbl_order_confirmation, $data);
//        var_dump($get_order_id);
        if($get_order_id->status == 0) {
            $data_tracking = array(
              'order_id' => $get_order_id->id,
                'status_id' => 1,
                'title' => 'Konfirmasi Diterima',
                'content' => 'Konfirmasi Diterima, Menunggu Pengecekan Pembayaran oleh Administrator',
                'date_created' => date('Y-m-d h:i:s', now())
            );

            $this->db->insert($this->tbl_tracking_system, $data_tracking);

            $data_order = array(
                'status' => 1
            );

            $this->model_basic->update($this->tbl_order, $data_order, 'id', $get_order_id->id);

        }
        if($this->db->trans_status() == TRUE)
        {
            $this->db->trans_commit();
            redirect('order_confirmation?submit=success');
        }
        else
        {
            $this->db->trans_rollback();
            redirect('order_confirmation?submit=error');
        }
    }
}