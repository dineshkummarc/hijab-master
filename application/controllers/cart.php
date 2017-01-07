<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends PX_Controller {

	public function __construct() {
		parent::__construct();
		$this->controller_attr = array('controller' => 'cart','controller_name' => 'Cart','controller_id' => 0);
                $this->do_underconstruct();
	}


	function index(){
		$data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('cart','My Cart');
        $cart=$this->cart->contents();
        $data['cart']=$cart;
		$data['address']= $this->model_basic->select_where($this->tbl_static_content,'id','6')->row();
		$data['phone']= $this->model_basic->select_where($this->tbl_static_content,'id','7')->row();
		$data['fax']= $this->model_basic->select_where($this->tbl_static_content,'id','8')->row();
		$data['content'] = $this->load->view('frontend/cart/index',$data,true);
		$this->load->view('frontend/index',$data); 
	}

	function checkout(){
		$data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('cart','My Cart');
        $data['user'] = $this->model_basic->select_where($this->tbl_customer, 'id', $this->session->userdata('id'))->row();
        $data['useraddress'] = $this->model_basic->select_where('px_customer_billing_address','customer_id',$this->session->userdata('id'))->row();
        $data['usershipping'] = $this->model_basic->select_where($this->tbl_shipping_address, 'customer_id', $this->session->userdata('id'))->result();
        $data['useraddress']->province = $this->model_basic->select_where($this->tbl_shipping_province, 'id', $data['useraddress']->province)->row();
        $data['useraddress']->city = $this->model_basic->select_where($this->tbl_shipping_city, 'id', $data['useraddress']->city)->row();
        $data['useraddress']->region = $this->model_basic->select_where($this->tbl_shipping_region, 'id', $data['useraddress']->region)->row();
        $data['province_list'] = $this->model_basic->select_all($this->tbl_shipping_province);
        $data['city_list'] = $this->model_basic->select_all($this->tbl_shipping_city);
        $data['region_list'] = $this->model_basic->select_all($this->tbl_shipping_region);
		$data['address']= $this->model_basic->select_where($this->tbl_static_content,'id','6')->row();
		$data['phone']= $this->model_basic->select_where($this->tbl_static_content,'id','7')->row();
		$data['fax']= $this->model_basic->select_where($this->tbl_static_content,'id','8')->row();
        $data['kurir'] = $this->model_basic->select_all($this->tbl_jasa_pengiriman);
		$data['content'] = $this->load->view('frontend/cart/checkout',$data,true);
		$this->load->view('frontend/index',$data); 
	}

	function updateAllCart(){
    	$data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Shop','shop');

        $get_cart = $this->cart->contents();

        $qty = $_POST('cart');
        var_dump($qty);

        foreach ($get_cart as $cart) {
        	$update_cart = array(
        		'rowid' => $cart['rowid'],
        		'qty' => $cart['qty']
        		);
        	$this->cart->update($update_cart);
        }

        $data['address']= $this->model_basic->select_where($this->tbl_static_content,'id','6')->row();
        $data['phone']= $this->model_basic->select_where($this->tbl_static_content,'id','7')->row();
        $data['fax']= $this->model_basic->select_where($this->tbl_static_content,'id','8')->row();
        $data['product'] = $this->model_basic->select_all($this->tbl_product);
        foreach ($data['product'] as $d_row) {
            $d_row->price = indonesian_currency($d_row->price);
            $d_row->image = $this->model_basic->select_where_double($this->tbl_product_image, 'product_id', $d_row->id, 'primary_status', '1')->row();
        };

        $data['content'] = $this->load->view('frontend/cart/index',$data,true);
        $this->load->view('frontend/index',$data);
    }

    function clearAllCart(){
    	$data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Shop','shop');

        $this->cart->destroy();

        $data['address']= $this->model_basic->select_where($this->tbl_static_content,'id','6')->row();
        $data['phone']= $this->model_basic->select_where($this->tbl_static_content,'id','7')->row();
        $data['fax']= $this->model_basic->select_where($this->tbl_static_content,'id','8')->row();
        $data['product'] = $this->model_basic->select_all($this->tbl_product);
        foreach ($data['product'] as $d_row) {
            $d_row->price = indonesian_currency($d_row->price);
            $d_row->image = $this->model_basic->select_where_double($this->tbl_product_image, 'product_id', $d_row->id, 'primary_status', '1')->row();
        };

        $data['content'] = $this->load->view('frontend/cart/index',$data,true);
        $this->load->view('frontend/index',$data);
    }
}
