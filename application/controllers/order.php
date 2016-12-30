<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends PX_Controller{
	function __construct(){
		parent:: __construct();
		$this->controller_attr = array('controller' => 'order','controller_name' => 'Order','controller_id' => 0);
                $this->do_underconstruct();
	}

	public function jasa_pengiriman(){
		$data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('Jasa Pengiriman', 'jasa_pengiriman');
		$data += $this->get_menu();
		$this->check_userakses($data['function_id'], ACT_READ);

		$data['jasa_pengiriman_list'] = $this->model_basic->select_all($this->tbl_jasa_pengiriman);
		$data['content'] = $this->load->view('backend/order/jasa_pengiriman_list', $data, true);
		$this->load->view('backend/index', $data);
	}

	public function jasa_pengiriman_form(){
		$data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Jasa Pengiriman', 'jasa_pengiriman');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_CREATE);
        $id = $this->input->post('id');
        if ($id) {
            $data['data'] = $this->model_basic->select_where($this->tbl_jasa_pengiriman, 'id', $id)->row();
        }
        else
            $data['data'] = null;
        $data['content'] = $this->load->view('backend/order/jasa_pengiriman_form', $data, true);
        $this->load->view('backend/index', $data);
	}

	function jasa_pengiriman_add(){
		$data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Jasa Pengiriman', 'jasa_pengiriman');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_CREATE);
        $table_field = $this->db->list_fields($this->tbl_jasa_pengiriman);
        $img_name_crop = uniqid() . '-kurir.jpg';
        $insert = array();
        foreach ($table_field as $field) {
            $insert[$field] = $this->input->post($field);
        }
        $insert['photo'] = $img_name_crop;

        if ($insert['name']) {
            $do_insert = $this->model_basic->insert_all($this->tbl_jasa_pengiriman, $insert);
            if ($do_insert) {
                if ($this->input->post('photo')) {
                    if (!is_dir(FCPATH . 'assets/uploads/order/' . $do_insert->id))
                        mkdir(FCPATH . 'assets/uploads/order/' . $do_insert->id);
                    if (basename($this->input->post('photo')) && $this->input->post('photo') != null) {
                        $src = $this->input->post('photo');
                    }
                    copy($src, 'assets/uploads/order/' . $do_insert->id . '/' . $img_name_crop);
                    $this->makeThumbnails('assets/uploads/order/' . $do_insert->id . '/', $img_name_crop, 500, 300);
                    $this->delete_temp('temp_folder');
                    $this->returnJson(array('status' => 'ok', 'msg' => 'Input data success', 'redirect' => 'order/jasa_pengiriman'));
                } else {
                    $this->returnJson(array('status' => 'ok', 'msg' => 'Input data success', 'redirect' => 'order/jasa_pengiriman'));
                }
            }
            else
                $this->returnJson(array('status' => 'error', 'msg' => 'Form jangan Kosong'));
        }
	}

	function jasa_pengiriman_edit(){
		$data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Jasa Pengiriman', 'jasa_pengiriman');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_CREATE);
        $table_field = $this->db->list_fields($this->tbl_jasa_pengiriman);
        $img_name_crop = uniqid() . '-kurir.jpg';
        $foto = $this->input->post('photo');
        $old_foto = $this->input->post('old_photo');
        $update = array();
        foreach ($table_field as $field) {
            $update[$field] = $this->input->post($field);
        }
        if (($foto && (basename($foto) != $old_foto)))
            $update['photo'] = $img_name_crop;
        else
            $update['photo'] = $this->input->post('old_photo');

        if ($update['name']) {
            $do_update = $this->model_basic->update($this->tbl_jasa_pengiriman, $update, 'id', $update['id']);
            if ($do_update) {
                if (($foto && (basename($foto) != $old_foto))) {
                    if (!is_dir(FCPATH . 'assets/uploads/order/' . $update['id']))
                        mkdir(FCPATH . 'assets/uploads/order/' . $update['id']);
                    if (basename($this->input->post('photo')) && $this->input->post('photo') != null) {
                        $src = $this->input->post('photo');
                    }
                    if(copy($src, 'assets/uploads/order/' . $update['id'] . '/' . $img_name_crop))
                    {
                        $this->makeThumbnails('assets/uploads/order/' . $update['id'] . '/', $img_name_crop, 500, 300);
                        @unlink('assets/uploads/order/' . $update['id'] . '/' . $this->input->post('old_photo'));
                        @unlink('assets/uploads/order/' . $update['id'] . '/thumb' . $this->input->post('old_photo'));
                        $this->delete_temp('temp_folder');
                    }
                    else
                    {
                        $this->delete_folder('order/'.$update['id']);
                        $this->returnJson(array('status' => 'error','msg' => 'Upload Falied'));
                    }
                }
                $this->returnJson(array('status' => 'ok', 'msg' => 'Update success', 'redirect' => 'order/jasa_pengiriman'));
            }
            else
                $this->returnJson(array('status' => 'error', 'msg' => 'Failed when updating data'));
        }
        else
            $this->returnJson(array('status' => 'error', 'msg' => 'Please complete the form'));
	}

	function jasa_pengiriman_delete(){
		$data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Jasa Pengiriman', 'jasa_pengiriman');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_CREATE);

		$id = $this->input->post('id');
        $deleted_data = $this->model_basic->select_where($this->tbl_jasa_pengiriman, 'id', $id)->row();
        $do_delete = $this->model_basic->delete($this->tbl_jasa_pengiriman, 'id', $id);
        if ($do_delete) {
            $this->returnJson(array('status' => 'ok', 'msg' => 'Delete Success', 'redirect' => 'order/jasa_pengiriman'));
        }else{
            $this->returnJson(array('status' => 'failed', 'msg' => 'Delete failed'));
        }
	}

	public function order_list(){
		$data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('Order List', 'order_list');
		$data += $this->get_menu();
		$this->check_userakses($data['function_id'], ACT_READ);

        $order = $this->model_basic->select_all($this->tbl_order);
        foreach ($order as $order_list) {
            $order_list->customer = $this->model_basic->select_where($this->tbl_customer, 'id', $order_list->customer_id)->row();
            $shipping_flag = $this->model_basic->select_where($this->tbl_tracking_system, 'order_id', $order_list->id)->row();
            $order_list->ship = $shipping_flag->shipping_flag_id;
//            $order_list->title = $shipping_flag->title;
            $order_list->title = $this->model_basic->select_where($this->tbl_tracking_status,'status_id',$order_list->status)->row()->title;
//            $order_list->flag = $shipping_flag->flag_id;
            if($shipping_flag->flag_id)
            $order_list->flag = $this->model_basic->select_where($this->tbl_flag,'id',$shipping_flag->flag_id)->row()->desc;
            else
                $order_list->flag = "Tidak ada Flag";

            $order_list->date_created = "Tanggal : ".date('d M Y', strtotime($order_list->date_created)).'</br>Jam : '.date('H:i', strtotime($order_list->date_created));
            $order_list->date_modified = "Tanggal : ".date('d M Y', strtotime($order_list->date_modified)).'</br>Jam : '.date('H:i', strtotime($order_list->date_modified));;
        }
        $data['order_list'] = $order;
        $data['jasa'] = $this->model_basic->select_all($this->tbl_jasa_pengiriman);
		$data['content'] = $this->load->view('backend/order/order_list', $data, true);
		$this->load->view('backend/index', $data);
	}

    function order_get(){
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Tracking Order','order_list');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_READ);
        $id = $this->input->post('id');
        $data['row'] = $this->model_basic->select_where($this->tbl_order,'id',$id)->row();
        $data['tracking'] = $this->model_basic->select_where($this->tbl_tracking_system,'order_id',$data['row']->id)->row();
        if($data['tracking'])
            $this->returnJson(array('status' => 'ok', 'data' => $data));
        else
            $this->returnJson(array('status' => 'error', 'msg' => 'Data not found'));
    }

	public function order_detail($id){
		$data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Order', 'order_list');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_READ);

        $data['order_detail'] = $this->model_basic->select_where($this->tbl_order, 'id', $id)->row();
            /*if ($data['order_detail']->status == '0') {
                $data['order_detail']->status = "Unconfirmed";
            }elseif ($data['order_detail']->status == '1') {
                $data['order_detail']->status = "Confirmed";
            }elseif ($data['order_detail']->status == '2') {
                $data['order_detail']->status = "Packing";
            }elseif ($data['order_detail']->status == '3') {
                $data['order_detail']->status = "Shipped";
            }elseif ($data['order_detail']->status == '-99') {
                $data['order_detail']->status = "Canceled/Rejected";
            }elseif ($data['order_detail']->status == '-98') {
                $data['order_detail']->status = "Out of Stock";
            }*/
        $data['order_detail']->status = $this->model_basic->select_where($this->tbl_tracking_status,'status_id',$data['order_detail']->status)->row()->title;

        $data['order_detail']->ship = $this->model_basic->select_where($this->tbl_shipping_address, 'customer_id', $data['order_detail']->customer_id)->row();
        $data['order_detail']->ship->province = $this->model_basic->select_where($this->tbl_shipping_province, 'id', $data['order_detail']->ship->province)->row();
        $data['order_detail']->ship->city = $this->model_basic->select_where($this->tbl_shipping_city, 'id', $data['order_detail']->ship->city)->row();
        $data['order_detail']->ship->region = $this->model_basic->select_where($this->tbl_shipping_region, 'id', $data['order_detail']->ship->region)->row();
        $data['order_detail']->date_created = tgl_indo(date('Y-m-d', strtotime($data['order_detail']->date_created)));
        $data['order_detail']->date_modified = tgl_indo(date('Y-m-d', strtotime($data['order_detail']->date_modified)));
        $data['order_detail']->total_ship_price = indonesian_currency($data['order_detail']->total_ship_price);
        $data['order_detail']->total_payment = indonesian_currency($data['order_detail']->total_payment);

        $data['order_detail']->name_customer = $this->model_basic->select_where($this->tbl_customer, 'id', $data['order_detail']->customer_id)->row();
        $data['order_detail']->name_customer->tgl_lahir = tgl_indo($data['order_detail']->name_customer->tgl_lahir);

        $data['order_detail']->billing = $this->model_basic->select_where($this->tbl_customer_billing_address, 'id', $data['order_detail']->customer_id)->row();

        $data['order_detail']->billing->province = $this->model_basic->select_where($this->tbl_shipping_province, 'id', $data['order_detail']->billing->province)->row();
        $data['order_detail']->billing->city = $this->model_basic->select_where($this->tbl_shipping_city, 'id', $data['order_detail']->billing->city)->row();
        $data['order_detail']->billing->region = $this->model_basic->select_where($this->tbl_shipping_region, 'id', $data['order_detail']->billing->region)->row();

        $data['order_detail']->shipping = $this->model_basic->select_where($this->tbl_shipping_address, 'customer_id', $data['order_detail']->customer_id)->result();

        foreach ($data['order_detail']->shipping as $data_row) {
        	$data_row->region = $this->model_basic->select_where($this->tbl_shipping_region, 'id', $data_row->region)->row();
        	$data_row->city = $this->model_basic->select_where($this->tbl_shipping_city, 'id', $data_row->city)->row();
        	$data_row->province = $this->model_basic->select_where($this->tbl_shipping_province, 'id', $data_row->province)->row();
        }

        $data['order'] = $this->model_basic->select_where($this->tbl_product_order, 'order_id', $data['order_detail']->id)->result();

        foreach ($data['order'] as $data_r) {
        	$data_r->product = $this->model_basic->select_where($this->tbl_product, 'id', $data_r->product_id)->row();
        	$data_r->product_stock = $this->model_basic->select_where($this->tbl_product_stock, 'id', $data_r->product_stock_id)->row();
        	$data_r->product_stock->size = $this->model_basic->select_where($this->tbl_size, 'id', $data_r->product_stock->size_id)->row();
        	$data_r->product_stock->color = $this->model_basic->select_where($this->tbl_color, 'id', $data_r->product_stock->color_id)->row();
        	$data_r->harga = indonesian_currency($data_r->price);
        	$data_r->total_price = $data_r->price * $data_r->quantity;
        	$data_r->totalprice = indonesian_currency($data_r->total_price);
        }

        $data['content'] = $this->load->view('backend/order/order_detail', $data, true);
        $this->load->view('backend/index', $data);
	}

    public function order_status($id, $customer, $status){
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Order List', 'order_list');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_UPDATE);

        $modified = date('Y-m-d H:i:s', now());

        $update = array(
            'status' => $status,
            'date_modified' => $modified);

        $do_update = $this->model_basic->update($this->tbl_order, $update, 'id', $id);

        if ($do_update) {
            $this->model_basic->delete($this->tbl_tracking_system,'order_id',$id);
            $created = date('Y-m-d H:i:s', now());
            $modified = date('Y-m-d H:i:s', now());
            if ($status == 1) {
                $title = "Menunggu Pembayaran";
                $content = "Menunggu Pembayaran";
                $data_input = array(
                    'customer_id' => $customer,
                    'order_id' => $id,
                    'flag_id' => 1,
                    'shipping_flag_id' => 1,
                    'title' => $title,
                    'content' => $content,
                    'date_created' => $created,
                    'date_modified' => $modified);
                $ubah_status = $this->model_basic->insert_all($this->tbl_tracking_system, $data_input);
                if ($ubah_status) {
                    $order = $this->model_basic->select_where($this->tbl_product_order, 'order_id', $id)->result();
                    //var_dump($order);
                    foreach ($order as $d_row) {
                        $product = $this->model_basic->select_where($this->tbl_product_stock, 'id', $d_row->product_stock_id)->row();
                       // var_dump($product);
                        $jumlah_beli = $product->stock - $d_row->quantity;
                       // print_r($product->stock - $d_row->quantity);
                        $data_update = array(
                            'stock' => $jumlah_beli);
                        $this->model_basic->update($this->tbl_product_stock, $data_update, 'id', $product->id);
                    }
                }
                redirect('order/order_list?update=true');
            }elseif ($status == -99) {
                $title = "Tidak ada Transaksi";
                $content = "Tidak ada Transaksi";
                $data_input = array(
                    'customer_id' => $customer,
                    'order_id' => $id,
                    'flag_id' => 0,
                    'shipping_flag_id' => 0,
                    'title' => $title,
                    'content' => $content,
                    'date_created' => $created,
                    'date_modified' => $modified);
                $this->model_basic->insert_all($this->tbl_tracking_system, $data_input);
                redirect('order/order_list?update=true');
            }
        }else{
            $this->returnJson(array('status' => 'error', 'msg' => 'Error'));
        }
    }

    function tracking_system_add(){
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Order List', 'order_list');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_CREATE);
        $table_field = $this->db->list_fields($this->tbl_tracking_system);
        $insert = array();
        foreach ($table_field as $field) {
            $insert[$field] = $this->input->post($field);
        }
        $insert['flag_id'] = 1;
        $insert['shipping_flag_id'] = 1;
        $insert['date_created'] = date('Y-m-d H:i:s', now());
        $insert['date_modified'] = date('Y-m-d H:i:s', now());

        if($this->input->post('order_id')){
            $do_insert = $this->model_basic->insert_all($this->tbl_tracking_system, $insert);

            if ($do_insert) {
                $this->returnJson(array('status' => 'ok', 'msg' => 'Insert Data success', 'redirect' => 'order/order_list'));
            }else{
                $this->returnJson(array('status' => 'error', 'msg' => 'Error'));
            }
        }else
            $this->returnJson(array('status' => 'error', 'msg' => 'Form jangan kosong'));
    }

    function tracking_system_edit(){
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Order List', 'order_list');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_UPDATE);

        $id = $this->input->post('id');
        $customer_id = $this->input->post('customer_id');
        $title = $this->input->post('title');
        $content = $this->input->post('content');
        $modified = date('Y-m-d H:i:s', now());
        
        $update = array
        ('customer_id' => $customer_id,
            'shipping_flag_id' => 5,
            'title' => $title,
            'content'=> $content,
            'date_modified' => $modified);

        $do_update = $this->model_basic->update($this->tbl_tracking_system, $update, 'id', $id);

        if ($do_update) {
            $this->returnJson(array('status' => 'ok', 'msg' => 'Edit data success', 'redirect' => 'order/order_list'));
        }else{
            $this->returnJson(array('status' => 'error', 'msg' => 'Error'));
        }
    }

    public function tracking_list(){
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Tracking System', 'tracking_list');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_READ);

        $data['tracking_list'] = $this->model_basic->select_all($this->tbl_tracking_system);
        foreach ($data['tracking_list'] as $data_r) {
            $data_r->customer = $this->model_basic->select_where($this->tbl_customer, 'id', $data_r->customer_id)->row();
            /*if ($data_r->flag_id == '1') {
                $data_r->flag_id = "Sisi customer";
            }elseif ($data_r->flag_id == '2') {
                $data_r->flag_id = "Sisi Penjual";
            }elseif ($data_r->flag_id == '3') {
                $data_r->flag_id = "Sisi Kurir";
            }else{
                $data_r->flag_id = "Tidak ada Flag";
            }*/
            if($data_r->flag_id)
            $data_r->flag_id = $this->model_basic->select_where($this->tbl_flag,'id',$data_r->flag_id)->row()->desc;
            else
                $data_r->flag_id = "Tidak ada Flag";
            $data_r->jasa = $this->model_basic->select_where($this->tbl_jasa_pengiriman, 'id', $data_r->jasa_pengiriman_id)->row();
            /*if ($data_r->shipping_flag_id == '1') {
                $data_r->shipping_flag_id = "Menunggu Pembayaran";
            }elseif ($data_r->shipping_flag_id == '2') {
                $data_r->shipping_flag_id = "Menunggu Verifikasi Pihak Ketiga";
            }elseif ($data_r->shipping_flag_id == '3') {
                $data_r->shipping_flag_id = "Barang dipacking";
            }elseif ($data_r->shipping_flag_id == '4') {
                $data_r->shipping_flag_id = "Barang proses pengiriman oleh Kurir";
            }elseif ($data_r->shipping_flag_id == '5') {
                $data_r->shipping_flag_id = "Barang sampai menunggu proses Konfirmasi Customer";
            }elseif ($data_r->shipping_flag_id == '6') {
                $data_r->shipping_flag_id = "Barang diterima dan Ok";
            }else{
                $data_r->shipping_flag_id = "Tidak ada Transaksi";
            }*/
            if($data_r->shipping_flag_id)
                $data_r->shipping_flag_id = $this->model_basic->select_where($this->tbl_shipping_flag,'id',$data_r->shipping_flag_id)->row()->desc;
            else
                $data_r->shipping_flag_id = "Tidak ada Transaksi";
        }
        $data['content'] = $this->load->view('backend/order/tracking_system_list', $data, true);
        $this->load->view('backend/index', $data);
    }

    public function order_barang_form(){
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Order Barang', 'order_list');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_READ);

        $id = $this->input->post('id');
        if ($id) {
            $data['data'] = $this->model_basic->select_where($this->tbl_order, 'id', $id)->row();
        }
        else
            $data['data'] = null;

        $data['product'] = $this->model_basic->select_all($this->tbl_product);
        $data['content'] = $this->load->view('backend/order/order_barang_form', $data, true);
        $this->load->view('backend/index', $data);
    }

    function order_barang_add(){
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

        if($this->input->post('product_id')){
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
            }else{
                $this->returnJson(array('status' => 'error', 'msg' => 'Error'));
            }
        }else
            $this->returnJson(array('status' => 'error', 'msg' => 'Form jangan kosong'));
    }

        function penjualan_order_excel(){
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
        $objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow($col,$row,$col+11,$row)->setCellValueByColumnAndRow($col,$row, 'DATA PENJUALAN ORDER BARANG');
        $alignvcenterhcenter= array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' =>  PHPExcel_Style_Alignment::VERTICAL_CENTER,
            )
        );

        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col,$row,$col+11,$row)->applyFromArray($alignvcenterhcenter);

        foreach ($fields as $field) {
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 4, $field);
            $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col, 4)->getFont()->setSize(11);
            $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col, 4)->getFont()->setBold(true);
            $col++;
        }

        $no = 1;

        foreach ($product as $data) {
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $row+3, $no);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $row+3, $data->nama_depan);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $row+3, $data->nama_belakang);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $row+3, $data->email);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $row+3, $data->jenis_kelamin);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $row+3, $data->name_product);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $row+3, $data->price);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, $row+3, $data->discount);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9, $row+3, $data->quantity);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(10, $row+3, $data->invoice_number);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(11, $row+3, $data->total_ship_price);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(12, $row+3, $data->total_payment);
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