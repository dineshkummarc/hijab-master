<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends PX_Controller{
	function __construct(){
		parent:: __construct();
		$this->controller_attr = array('controller' => 'customer','controller_name' => 'Customer','controller_id' => 0);
	}

	public function customer_list(){
		$data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('Customer List', 'customer_list');
		$data += $this->get_menu();
		$this->check_userakses($data['function_id'], ACT_READ);

		$data['customer_list'] = $this->model_basic->select_all($this->tbl_customer);
		$data['content'] = $this->load->view('backend/customer/customer_list', $data, true);
		$this->load->view('backend/index', $data);
	}

	public function customer_list_form(){
		$data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Customer', 'customer_list');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_CREATE);
        $id = $this->input->post('id');
        if ($id) {
            $data['data'] = $this->model_basic->select_where($this->tbl_customer, 'id', $id)->row();
            $data['data']->password = $this->encrypt->decode($data['data']->password);
        }
        else
            $data['data'] = null;
        $data['content'] = $this->load->view('backend/customer/customer_form', $data, true);
        $this->load->view('backend/index', $data);
	}

	function customer_list_add(){
		$data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Customer List', 'customer_list');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_CREATE);
        $table_field = $this->db->list_fields($this->tbl_customer);
        $img_name_crop = uniqid() . '-customer.jpg';
        $insert = array();
        foreach ($table_field as $field) {
            $insert[$field] = $this->input->post($field);
        }
        $insert['password'] = $this->encrypt->encode($insert['password']);
        $insert['photo'] = $img_name_crop;
        $insert['status_customer'] = 0;
        $insert['date_created'] = date('Y-m-d H:i:s', now());
        $insert['date_modified'] = date('Y-m-d H:i:s', now());

        if ($insert['email']) {
            $do_insert = $this->model_basic->insert_all($this->tbl_customer, $insert);
            if ($do_insert) {
                if ($this->input->post('photo')) {
                    if (!is_dir(FCPATH . 'assets/uploads/customer/' . $do_insert->id))
                        mkdir(FCPATH . 'assets/uploads/customer/' . $do_insert->id);
                    if (basename($this->input->post('photo')) && $this->input->post('photo') != null) {
                        $src = $this->input->post('photo');
                    }
                    copy($src, 'assets/uploads/customer/' . $do_insert->id . '/' . $img_name_crop);
                    $this->makeThumbnails('assets/uploads/customer/' . $do_insert->id . '/', $img_name_crop, 500, 300);
                    $this->delete_temp('temp_folder');
                    $this->returnJson(array('status' => 'ok', 'msg' => 'Input data success', 'redirect' => 'customer/customer_list'));
                } else {
                    $this->returnJson(array('status' => 'ok', 'msg' => 'Input data success', 'redirect' => 'customer/customer_list'));
                }
            }
            else
                $this->returnJson(array('status' => 'error', 'msg' => 'Form jangan Kosong'));
        }
	}

	function customer_list_edit(){
		$data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Customer', 'customer_list');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_UPDATE);

        $img_name_crop = uniqid() . '-customer.jpg';
        $foto = $this->input->post('photo');
        $old_foto = $this->input->post('old_photo');
        $table_field = $this->db->list_fields($this->tbl_customer);
        $update = array();
        foreach ($table_field as $field) {
            $update[$field] = $this->input->post($field);
        }
        $update['password'] = $this->encrypt->encode($update['password']);
        unset($update['date_created']);
        $update['date_modified'] = date('Y-m-d H:i:s', now());
        if (($foto && (basename($foto) != $old_foto)))
            $update['photo'] = $img_name_crop;
        else
            $update['photo'] = $this->input->post('old_photo');

        if ($update['nama_depan']) {
            $do_update = $this->model_basic->update($this->tbl_customer, $update, 'id', $update['id']);
            if ($do_update) {
                if (($foto && (basename($foto) != $old_foto))) {
                    if (!is_dir(FCPATH . 'assets/uploads/customer/' . $update['id']))
                        mkdir(FCPATH . 'assets/uploads/customer/' . $update['id']);
                    if (basename($this->input->post('photo')) && $this->input->post('photo') != null) {
                        $src = $this->input->post('photo');
                    }
                    if(copy($src, 'assets/uploads/customer/' . $update['id'] . '/' . $img_name_crop))
                    {
                        $this->makeThumbnails('assets/uploads/customer/' . $update['id'] . '/', $img_name_crop, 500, 300);
                        @unlink('assets/uploads/customer/' . $update['id'] . '/' . $this->input->post('old_photo'));
                        @unlink('assets/uploads/customer/' . $update['id'] . '/thumb' . $this->input->post('old_photo'));
                        $this->delete_temp('temp_folder');
                    }
                    else
                    {
                        $this->delete_folder('customer/'.$update['id']);
                        $this->returnJson(array('status' => 'error','msg' => 'Upload Falied'));
                    }
                }
                $this->returnJson(array('status' => 'ok', 'msg' => 'Update success', 'redirect' => 'customer/customer_list'));
            }
            else
                $this->returnJson(array('status' => 'error', 'msg' => 'Failed when updating data'));
        }
        else
            $this->returnJson(array('status' => 'error', 'msg' => 'Please complete the form'));
	}

	function status_customer(){
		$id = $this->input->post('id');
        $customer = $this->model_basic->select_where($this->tbl_customer, 'id', $id)->row();
        if($customer)
        {
            if($customer->status_customer == 0)
                $change_status = 1;
            else
                $change_status = 0;
            $update = array('status_customer' => $change_status);
            if(!$this->model_basic->update($this->tbl_customer, $update, 'id', $id))
                $this->returnJson(array('status' => 'failed', 'msg' => 'Update Status Failed'));
            else
                $this->returnJson(array('status' => 'ok', 'status_customer' => $change_status, 'id' => $id));
        }
        else
        {
            $this->returnJson(array('status' => 'failed', 'msg' => 'Update Status Failed'));
        }
	}

	function customer_list_delete(){}

    public function customer_billing_address_form($id){
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Alamat Pembayaran', 'customer_list');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_CREATE);
        $customer = $this->input->post('customer_id');

        if($id){
            $data['customer'] = $this->model_customer->get_join_customers($id);
            if($data['customer']){
                $data['customer']->province =  $this->model_basic->select_where($this->tbl_shipping_province,'id_province',$data['customer']->province)->row()->name;
                $kab = $this->model_basic->select_where($this->tbl_shipping_city,'id_city',$data['customer']->city)->row()->type;
                if($kab == 'Kabupaten')
                    $kab = 'Kab. ';
                else
                    $kab = '';
                $city = $this->model_basic->select_where($this->tbl_shipping_city,'id_city',$data['customer']->city)->row()->name;
                $data['customer']->city = $kab. $city;
                $data['customer']->region =$this->model_basic->select_where($this->tbl_shipping_region,'id_region',$data['customer']->region)->row()->name;
            }
        }
        //var_dump($data['customer']);
       /* if ($id) {
            $data['data'] = $this->model_basic->select_where($this->tbl_customer, 'id', $id)->row();
            $data['customer'] = $this->model_basic->select_where($this->tbl_customer_billing_address, 'id', $id)->result();
        }
        else
            $data['customer'] = null;

        //var_dump($data['customer']);
        $data['province_list'] = $this->model_basic->select_all($this->tbl_shipping_province);
        $data['city_list'] = $this->model_basic->select_all($this->tbl_shipping_city);
        $data['region_list'] = $this->model_basic->select_all($this->tbl_shipping_region);
        foreach ($data['customer'] as $d_row){
            var_dump($data['customer']);
            $data['province'] = $this->model_basic->select_where($this->tbl_shipping_province,'id_province',$d_row->province)->row()->name;
            $kab = $this->model_basic->select_where($this->tbl_shipping_city,'id_city',$d_row->city)->row()->type;
            if($kab == 'Kabupaten')
                $kab = 'Kab. ';
            $city = $this->model_basic->select_where($this->tbl_shipping_city,'id_city',$d_row->city)->row()->name;
            $data['city'] = $kab. $city;
            $data['region'] = $this->model_basic->select_where($this->tbl_shipping_region,'id_region',$d_row->region)->row()->name;
        }*/
        $data['content'] = $this->load->view('backend/customer/customer_billing_address_form', $data, true);
        $this->load->view('backend/index', $data);
    }

    function city(){
        $id_province = $this->input->post('id');
        $city = $this->model_basic->select_where($this->tbl_shipping_city, 'id_province', $id_province);
        if ($city->num_rows() >= 1)
            $this->returnJson(array('status' => 'ok', 'data' => $city->result()));
        else
            $this->returnJson(array('status' => 'failed', 'msg' => 'failed to get data'));
    }

    function region(){
        $id_city = $this->input->post('id');
        $region = $this->model_basic->select_where($this->tbl_shipping_region, 'id_city', $id_city);
        if ($region->num_rows() >= 1)
            $this->returnJson(array('status' => 'ok', 'data' => $region->result()));
        else
            $this->returnJson(array('status' => 'failed', 'msg' => 'failed to get data'));
    }

    function price(){
        $id_region = $this->input->post('id');
        $price = $this->model_basic->select_where($this->tbl_shipping_region, 'id', $id_region);
        if ($price->num_rows() >= 1)
            $this->returnJson(array('status' => 'ok', 'data' => $price->row()));
        else
            $this->returnJson(array('status' => 'failed', 'msg' => 'failed to get data'));
    }

    function shipping(){
        $id_shipping = $this->input->post('id');
        $shipping = $this->model_basic->select_where($this->tbl_shipping_address, 'id', $id_shipping)->row();
        $shipping->province = $this->model_basic->select_where($this->tbl_shipping_province,'id', $shipping->province)->row()->name;
        $shipping->city = $this->model_basic->select_where($this->tbl_shipping_city,'id', $shipping->city)->row()->name;
        $shipping->region = $this->model_basic->select_where($this->tbl_shipping_region,'id', $shipping->region)->row()->name;


        if ($shipping)
            $this->returnJson(array('status' => 'ok', 'data' => $shipping));
        else
            $this->returnJson(array('status' => 'failed', 'msg' => 'failed to get data'));
    }

    function customer_billing_address_add(){
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Customer', 'customer_list');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_UPDATE);

        $table_field = $this->db->list_fields($this->tbl_customer_billing_address);
        $insert = array();
        foreach ($table_field as $field) {
            $insert[$field] = $this->input->post($field);
        }

        if($this->input->post('customer_id')){
            $do_insert = $this->model_basic->insert_all($this->tbl_customer_billing_address, $insert);

            if ($do_insert) {
                $this->returnJson(array('status' => 'ok', 'msg' => 'Insert Data success', 'redirect' => 'customer/customer_billing_address_form/'.$insert['customer_id']));
            }else{
                $this->returnJson(array('status' => 'error', 'msg' => 'Error'));
            }
        }else
            $this->returnJson(array('status' => 'error', 'msg' => 'Form jangan kosong'));
    }

    function customer_billing_address_edit(){
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Customer', 'customer_list');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_UPDATE);

        $table_field = $this->db->list_fields($this->tbl_customer_billing_address);
        $update = array();
        foreach ($table_field as $field) {
            $update[$field] = $this->input->post($field);
        }

        $do_update = $this->model_basic->update($this->tbl_customer_billing_address, $update, 'id', $update['id']);

        if ($do_update) {
            $this->returnJson(array('status' => 'ok', 'msg' => 'Edit data success', 'redirect' => 'customer/customer_billing_address_form/'.$update['customer_id']));
        }else{
            $this->returnJson(array('status' => 'error', 'msg' => 'Error'));
        }
    }

    public function shipping_address_list($id){
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Address Shipping List', 'customer_list');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_READ);

        $data['customer'] = $this->model_basic->select_where($this->tbl_customer, 'id', $id)->row();

        $data['address_list'] = $this->model_basic->select_where($this->tbl_shipping_address, 'customer_id', $id)->result();
        foreach ($data['address_list'] as $alamat) {
            $alamat->province = $this->model_basic->select_where($this->tbl_shipping_province, 'id', $alamat->province)->row();
        }
        $data['content'] = $this->load->view('backend/customer/address_shipping_list', $data, true);
        $this->load->view('backend/index', $data);
    }

    public function shipping_address_list_form($customer_id){
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Address Shipping Form', 'customer_list');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_READ);
        $id = $this->input->post('id');
        $data['data'] = $this->model_basic->select_where($this->tbl_customer, 'id', $customer_id)->row();
        if ($id) {
            $data['customer'] = $this->model_basic->select_where($this->tbl_shipping_address, 'id', $id)->row();
        }
        else
            $data['customer'] = null;
        $data['province_list'] = $this->model_basic->select_all($this->tbl_shipping_province);
        $data['city_list'] = $this->model_basic->select_all($this->tbl_shipping_city);
        $data['region_list'] = $this->model_basic->select_all($this->tbl_shipping_region);
        $data['content'] = $this->load->view('backend/customer/address_shipping_form', $data, true);
        $this->load->view('backend/index', $data);
    }



    function shipping_address_list_add(){
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Shipping', 'customer_list');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_CREATE);
        $table_field = $this->db->list_fields($this->tbl_shipping_address);
        $insert = array();
        foreach ($table_field as $field) {
            $insert[$field] = $this->input->post($field);
        }

        if($this->input->post('customer_id')){
            $do_insert = $this->model_basic->insert_all($this->tbl_shipping_address, $insert);

            if ($do_insert) {
                $this->returnJson(array('status' => 'ok', 'msg' => 'Insert Data success', 'redirect' => 'customer/shipping_address_list/'.$insert['customer_id']));
            }else{
                $this->returnJson(array('status' => 'error', 'msg' => 'Error'));
            }
        }else
            $this->returnJson(array('status' => 'error', 'msg' => 'Form jangan kosong'));
    }

    function shipping_address_list_edit(){
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Address', 'customer_list');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_UPDATE);

        $table_field = $this->db->list_fields($this->tbl_shipping_address);
        $update = array();
        foreach ($table_field as $field) {
            $update[$field] = $this->input->post($field);
        }

        $do_update = $this->model_basic->update($this->tbl_shipping_address, $update, 'id', $update['id']);

        if ($do_update) {
            $this->returnJson(array('status' => 'ok', 'msg' => 'Edit data success', 'redirect' => 'customer/shipping_address_list/'.$update['customer_id']));
        }else{
            $this->returnJson(array('status' => 'error', 'msg' => 'Error'));
        }
    }

    function get_data(){
        return $this->model_basic->select_all($this->tbl_customer);
    }

    function show_data(){
        $data = $this->get_data();
        $i =0;
        foreach ($data as $d_row){
            $datas[$i] = new stdClass();
            $datas[$i]->fullname = $d_row->nama_depan.' '.$d_row->nama_belakang;
            $datas[$i]->jenis_kelamin = $d_row->jenis_kelamin;
            $datas[$i]->email = $d_row->email;
            $datas[$i]->password = $this->encrypt->decode($d_row->password);
            $i++;
        }
        $this->returnJson($datas);
    }

    function customer_address($id){
        $customer = $this->model_basic->select_where($this->tbl_customer, 'id', $id)->row();
        $address = $this->model_basic->select_where($this->tbl_shipping_address, 'customer_id', $id)->result();

        $sheet_name = 'Data_Alamat_Pengiriman';
        $file_name = 'Data_Alamat_Pengiriman';
        $this->load->library('excel');
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setTitle($sheet_name)->setDescription("none");
        $objPHPExcel->setActiveSheetIndex(0);

        $biodata = array(
            'Nama Depan',
            'Nama Belakang',
            'Email',
            'Tanggal Lahir',
            'Jenis Kelamin');

        $datacustomer = array(
            $customer->nama_depan,
            $customer->nama_belakang,
            $customer->email,
            $customer->tgl_lahir,
            $customer->jenis_kelamin);

        $fields = array(
            'No',
            'Alamat',
            'Provinsi',
            'Kota',
            'Kecamatan',
            'Kode Pos',
            'Phone');

        $col = 1;
        $row = 2;
        $objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow($col,$row,$col+6,$row)->setCellValueByColumnAndRow($col,$row, 'DATA ALAMAT PENGIRIMAN CUSTOMER');
        $alignvcenterhcenter= array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' =>  PHPExcel_Style_Alignment::VERTICAL_CENTER,
            )
        );

        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col,$row,$col+6,$row)->applyFromArray($alignvcenterhcenter);

        foreach ($biodata as $data) {
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row+2, $data);
            $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col, $row+2)->getFont()->setSize(11);
            $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col, $row+2)->getFont()->setBold(true);
            $row++;
        }

        foreach ($datacustomer as $datapribadi) {
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+1, $row-3, $datapribadi);
            $row++;
        }

        foreach ($fields as $field) {
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 10, $field);
            $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col, 10)->getFont()->setSize(11);
            $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col, 10)->getFont()->setBold(true);
            $col++;
        }

        $no = 1;

        foreach ($address as $data) {
            $data->province = $this->model_basic->select_where($this->tbl_shipping_province, 'id', $data->province)->row();
            $data->city = $this->model_basic->select_where($this->tbl_shipping_city, 'id', $data->city)->row();
            $data->region = $this->model_basic->select_where($this->tbl_shipping_region, 'id', $data->region)->row();
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $row-1, $no);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $row-1, $data->address);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $row-1, $data->province->name);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $row-1, $data->city->name);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $row-1, $data->region->name);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $row-1, $data->postal_code);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $row-1, $data->phone);
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

    function customer_excel(){
        $customer = $this->model_customer->get_customer_all()->result();

        $sheet_name = 'Data_Customer';
        $file_name = 'Data_Customer';
        $this->load->library('excel');
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setTitle($sheet_name)->setDescription("none");
        $objPHPExcel->setActiveSheetIndex(0);
        $no = 1;
        $fields = array(
            'No',
            'Nama Depan',
            'Nama Belakang',
            'Tanggal Lahir',
            'Jenis Kelamin',
            'Phone',
            'E-Mail',
            'Alamat',
            'Provinsi',
            'Kota',
            'Kecamatan',
            'Kode Pos');
        $col = 1;
        $row = 2;
        $objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow($col,$row,$col+11,$row)->setCellValueByColumnAndRow($col,$row, 'DATA CUSTOMER');
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

        foreach ($customer as $data) {
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $row+3, $no);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $row+3, $data->nama_depan);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $row+3, $data->nama_belakang);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $row+3, $data->tgl_lahir);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $row+3, $data->jenis_kelamin);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $row+3, $data->phone);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $row+3, $data->email);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, $row+3, $data->address);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9, $row+3, $data->province);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(10, $row+3, $data->city);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(11, $row+3, $data->region);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(12, $row+3, $data->postal_code);
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