<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_order extends PX_Controller {

    function __construct() {
        parent:: __construct();
        $this->controller_attr = array('controller' => 'admin_order', 'controller_name' => 'Admin Order', 'controller_id' => 0);
        $this->load->model('model_order');
        $this->check_login();
    }

    public function index() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Order List','order_list');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_READ);
        $data['submenu'] = $this->get_submenu($data['controller']);
        $data['content'] = $this->load->view('backend/order/index',$data,true);
        $this->load->view('backend/index',$data);
    }

    public function order_list() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Order List', 'order_list');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_READ);

        $order = $this->model_basic->select_all($this->tbl_order);
        foreach ($order as $data_row) {
            $customer = $this->model_basic->select_where($this->tbl_customer, 'id', $data_row->customer_id);
            if($customer->num_rows() == 1)
                $data_row->customer = $customer->row()->nama_depan.' '.$customer->row()->nama_belakang;
            
            $data_row->status = $this->model_basic->select_where($this->tbl_tracking_status, 'status_id', $data_row->status)->row();
            $data_row->date_created = date('d M Y H:i:s', strtotime($data_row->date_created));
            $data_row->total_payment = $this->indonesian_currency($data_row->total_payment);
        }
        $data['order_list'] = $order;
        $data['jasa'] = $this->model_basic->select_all($this->tbl_jasa_pengiriman);
        $data['content'] = $this->load->view('backend/order/order_list', $data, true);
        $this->load->view('backend/index', $data);
    }

    public function order_list_ajax()
    {
        // permissionUser();
        $list = $this->model_order->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $r) {
            $url = base_url('admin_order/order_detail/'.$r->id);
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $r->invoice_number;
            $row[] = $r->nama_depan;
            $row[] = number_format($r->total_payment);
            $row[] = date('d M Y H:i:s', strtotime($r->date_created));
            $row[] = "<span class='btn $r->class_text'>$r->status</span>";
            $row[] = "<a class='btn btn-default btn-xs' href=
            '$url' data-original-title='Detail Order' data-placement='top' data-toggle='tooltip'><i class='fa fa-eye'></i></a>";
            /*
            $row[] = '<span class="btn <?php echo $d_row->status->class_text ?>"><?php echo $d_row->status->title ?></span>';
            $row[] = '<a class="btn btn-default btn-xs" href="<?php echo $controller.'/order_detail/'.$d_row->id ?>" data-original-title="Detail Order" data-placement="top" data-toggle="tooltip"><i class="fa fa-eye"></i></a>';
            */
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->model_order->count_all(),
                        "recordsFiltered" => $this->model_order->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function order_detail($id) {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Order', 'order_list');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_READ);
        
        //order data
        $temp = $this->model_basic->select_where($this->tbl_order, 'id', $id);
        if($temp->num_rows() == 1)
            $order = $temp->row();
        else
            redirect ($data['controller'].'/'.$data['function'].'?detail=error');
        $order->status_order = $this->model_basic->select_where($this->tbl_tracking_status, 'status_id', $order->status)->row();
        $order->tracking_system = $this->model_basic->select_where($this->tbl_tracking_system, 'order_id', $order->id)->result();
        $order->product_order = $this->model_basic->select_where($this->tbl_product_order, 'order_id', $order->id)->result();
        foreach($order->product_order as $data_row)
        {
            $data_row->data_product = $this->model_basic->select_where($this->tbl_product, 'id', $data_row->product_id)->row();
            $data_row->size = $this->model_basic->select_where($this->tbl_size, 'id', $data_row->size_id)->row()->name;
            $data_row->color = $this->model_basic->select_where($this->tbl_color, 'id', $data_row->color_id)->row()->name;
            $data_row->price = $this->indonesian_currency($data_row->price*$data_row->quantity);
        }
        $order->total_order = $this->indonesian_currency($order->total_order);
        $order->total_payment = $this->indonesian_currency($order->total_payment);
        $order->total_ship_price = $this->indonesian_currency($order->total_ship_price);
        $order->total_discount = $this->indonesian_currency($order->total_discount);
        $order->random_code = $this->indonesian_currency($order->random_code);
        $order->voucher = $this->model_basic->select_where($this->tbl_voucher, 'id', $order->voucher_id)->row()->voucher;
        $order->date_created = date('d M Y H:i:s', strtotime($order->date_created));
        //customer
        $customer = $this->model_basic->select_where($this->tbl_customer, 'id', $order->customer_id)->row();
        $customer->billing_address = $this->model_basic->select_where($this->tbl_customer_billing_address, 'customer_id', $customer->id)->row();
        $customer->billing_address->province = $this->model_basic->select_where($this->tbl_shipping_province, 'id', $customer->billing_address->province)->row()->name;
        $customer->billing_address->city = $this->model_basic->select_where($this->tbl_shipping_city, 'id', $customer->billing_address->city)->row()->name;
        $customer->billing_address->region = $this->model_basic->select_where($this->tbl_shipping_region, 'id', $customer->billing_address->region)->row()->name;
        //shipping address
        $shipping_address = $this->model_basic->select_where($this->tbl_shipping_address, 'id', $order->ship_address_id)->row();
        $shipping_address->province = $this->model_basic->select_where($this->tbl_shipping_province, 'id', $shipping_address->province)->row()->name;
        $shipping_address->city = $this->model_basic->select_where($this->tbl_shipping_city, 'id', $shipping_address->city)->row()->name;
        $shipping_address->region = $this->model_basic->select_where($this->tbl_shipping_region, 'id', $shipping_address->region)->row()->name;
        //order confirmation
        $order_confirmation = $this->model_basic->select_where_order($this->tbl_order_confirmation, 'order_id', $order->id, 'date_created', 'DESC');
        foreach($order_confirmation->result() as $data_row)
        {
            $data_row->total_payment = $this->indonesian_currency($data_row->total_payment);
            $data_row->date_transfer = date('d M Y', strtotime($data_row->date_transfer));
        }
        //tracking system
        $tracking_system = $this->model_basic->select_where_order($this->tbl_tracking_system, 'order_id', $order->id, 'date_created', 'desc')->result();
        foreach($tracking_system as $data_row)
        {
            $data_row->status = $this->model_basic->select_where($this->tbl_tracking_status, 'status_id', $data_row->status_id)->row();
            $data_row->date_created = date('d M Y H:i:s', strtotime($data_row->date_created));
        }
        $data['order'] = $order;
        $data['customer'] = $customer;
        $data['shipping_address'] = $shipping_address;
        $data['order_confirmation'] = $order_confirmation;
        $data['tracking_system'] = $tracking_system;
        $data['content'] = $this->load->view('backend/order/order_detail', $data, true);
        $this->load->view('backend/index', $data);
    }
    
    function process_order()
    {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Order List', 'order_list');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_UPDATE);
        
        $order_id = $this->input->post('id');
        $status = $this->input->post('status');
        $nomor_resi = $this->input->post('nomor_resi');
        
        if($order_id && $status)
        {
            $this->db->trans_start();
            $status_update = array('status' => $status);
            $this->model_basic->update($this->tbl_order, $status_update, 'id', $order_id);
            if($status == -99)
            {
                $product_order = $this->model_basic->select_where($this->tbl_product_order, 'order_id', $order_id)->result();
                foreach($product_order as $data_row)
                {
                    $this->model_order->update_amount_stock($data_row->product_stock_id, 1, $data_row->quantity);
                }
            }
            switch($status)
            {
                case 2:
                    $title = 'Order Paid';
                    $content = 'Pembayaran Telah Diterima, Order Siap Dikirim';
                    break;
                case 3:
                    $title = 'Order Shipped';
                    $content = 'Order Telah Dikirim ke Customer, Nomor Resi : '.$nomor_resi;
                    break;
                default:
                    $title = 'Order Rejected';
                    $content = 'Order Ditolak disebabkan Pembayaran Tidak Diterima';
                    break;
            }
            $insert_tracking_system = array(
                'order_id' => $order_id,
                'status_id' => $status,
                'title' => $title,
                'content' => $content,
                'date_created' => date('Y-m-d H:i:s', now()));
            $this->model_basic->insert_all($this->tbl_tracking_system, $insert_tracking_system);
            if($this->db->trans_status() == TRUE)
            {
                $this->db->trans_commit();
                $this->returnJson(array('status' => 'ok', 'msg' => 'Change Status Success', 'redirect' => $data['controller'].'/order_detail/'.$order_id));
            }
            else
            {
                $this->db->trans_rollback();
                $this->returnJson(array('status' => 'error', 'msg' => 'Change Status Failed, Please Try Again'));
            }
        }
        else
        {
            $this->returnJson(array('status' => 'error', 'msg' => 'Change Status Failed, Please Try Again'));
        }
    }

    function order_barang_add() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Order Barang', 'order_list');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_CREATE);

        $table_field = $this->db->list_fields($this->tbl_order);
        $insert = array();
        foreach ($table_field as $field) {
            $insert[$field] = $this->input->post($field);
        }
        $insert['customer_id'] = 1;
        $insert['ship_address_id'] = 1;
        $insert['invoice_number'] = $this->invoiceGenerator();
        $insert['total_payment'] = $this->input->post('price') * $this->input->post('total_order');
        $insert['date_created'] = date('Y-m-d H:i:s', now());
        $insert['date_modified'] = date('Y-m-d H:i:s', now());

        if ($this->input->post('product_id')) {
            $do_insert = $this->model_basic->insert_all($this->tbl_order, $insert);

            if ($do_insert) {
                $data_produk_order = array(
                    'product_id' => $this->input->post('product_id'),
                    'product_stock_id' => 2,
                    'order_id' => $do_insert->id,
                    'price' => $this->input->post('price'),
                    'quantity' => $this->input->post('total_order')
                );
                $insert_product_order = $this->model_basic->insert_all($this->tbl_product_order, $data_produk_order);
                if ($insert_product_order) {
                    $tracking_system = array(
                        'customer_id' => 1,
                        'order_id' => $insert_product_order->order_id,
                        'flag_id' => 1,
                        'shipping_flag_id' => 1,
                        'date_created' => date('Y-m-d H:i:s', now()),
                        'date_modified' => date('Y-m-d H:i:s', now())
                    );
                    $this->model_basic->insert_all($this->tbl_tracking_system, $tracking_system);
                }
                redirect('order/order_list');
            } else {
                $this->returnJson(array('status' => 'error', 'msg' => 'Error'));
            }
        } else
            $this->returnJson(array('status' => 'error', 'msg' => 'Form jangan kosong'));
    }

    function penjualan_order_excel() {
        $product = $this->model_excel->get_penjualan_order();

        $sheet_name = 'Data_Penjualan_Order';
        $file_name = 'Data_Penjualan_Order';
        $this->load->library('excel');
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setTitle($sheet_name)->setDescription("none");
        $objPHPExcel->setActiveSheetIndex(0);
        $no = 1;
        $fields = array(
            'No',
            'Nama Depan',
            'Nama Belakang',
            'Email',
            'Jenis Kelamin',
            'Nama Barang',
            'Harga',
            'Diskon',
            'Total Beli',
            'Invoice',
            'Total Biaya Pengiriman',
            'Total Pembayaran');
        $col = 1;
        $row = 2;
        $objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow($col, $row, $col + 11, $row)->setCellValueByColumnAndRow($col, $row, 'DATA PENJUALAN ORDER BARANG');
        $alignvcenterhcenter = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
            )
        );

        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col, $row, $col + 11, $row)->applyFromArray($alignvcenterhcenter);

        foreach ($fields as $field) {
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 4, $field);
            $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col, 4)->getFont()->setSize(11);
            $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col, 4)->getFont()->setBold(true);
            $col++;
        }

        $no = 1;

        foreach ($product as $data) {
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $row + 3, $no);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $row + 3, $data->nama_depan);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $row + 3, $data->nama_belakang);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $row + 3, $data->email);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $row + 3, $data->jenis_kelamin);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $row + 3, $data->name_product);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $row + 3, $data->price);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, $row + 3, $data->discount);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9, $row + 3, $data->quantity);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(10, $row + 3, $data->invoice_number);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(11, $row + 3, $data->total_ship_price);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(12, $row + 3, $data->total_payment);
            $row++;
            $no++;
        }

        $objPHPExcel->setActiveSheetIndex(0);

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $filename = $file_name . '.xls';
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $objWriter->save('php://output');
    }

}
