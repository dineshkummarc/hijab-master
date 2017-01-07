<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends PX_Controller {

	public function __construct() {
		parent::__construct();
		$this->controller_attr = array('controller' => 'cart','controller_name' => 'Cart','controller_id' => 0);
                $this->do_underconstruct();
        $this->load->model('model_product');
	}


	function index(){
		$data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('cart','My Cart');
        $data['cart']=$this->cart->contents();
		$data['address']= $this->model_basic->select_where($this->tbl_static_content,'id','6')->row();
		$data['phone']= $this->model_basic->select_where($this->tbl_static_content,'id','7')->row();
		$data['fax']= $this->model_basic->select_where($this->tbl_static_content,'id','8')->row();
		$data['content'] = $this->load->view('frontend/cart/index',$data,true);
		$this->load->view('frontend/index',$data); 
	}

	function checkout(){
        if($this->session->userdata('validated')==FALSE){
            $this->session->set_flashdata('msg_check','Anda harus login atau register untuk melakukan step berikutnya.');
            redirect('login');
        }
		$data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('cart','My Cart');
        $data['user'] = $this->model_basic->select_where($this->tbl_customer, 'id', $this->session->userdata('id'))->row();
        $data['useraddress'] = $this->model_basic->select_where($this->tbl_customer_billing_address,'customer_id',$this->session->userdata('id'))->row();
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

        $no=0;
        foreach ($get_cart as $cart) {
            $no++;
        	$update_cart = array(
        		'rowid' => $cart['rowid'],
        		'qty' => $_POST['qty'][$no],
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

        redirect('cart');
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
            redirect('cart');
    }

    function address($id){
        $address=$this->model_basic->select_where($this->tbl_shipping_address,'id',$id)->row();
        $province=$this->model_basic->select_where($this->tbl_shipping_province,'id',$address->province)->row();
        $city=$this->model_basic->select_where($this->tbl_shipping_city,'id',$address->city)->row();
        $region=$this->model_basic->select_where($this->tbl_shipping_region,'id',$address->region)->row();
        $address->name_province=$province->name;
        $address->name_city=$city->name;
        $address->name_region=$region->name;
        $address->cost=$region->price;
        $address->tot_price=$region->price+$this->cart->total();
        echo json_encode($address);
    }

    function submit_order(){
        $invoice=$this->model_product->uniq_code();
        $random_code=rand(100,999);
        $data_order=array(
            'customer_id'=>$this->session->userdata('id'),
            'ship_address_id'=>$this->input->post('shipping_id'),
            'invoice_number'=>$invoice,
            'total_order'=>$this->cart->total(),
            'total_ship_price'=>$this->input->post('cost'),
            'total_payment'=>$this->input->post('tot_price')+$random_code,
            'random_code'=>$random_code,
            'status' => 1,
            'date_created' =>  date('Y-m-d H:i:s', now()),
            'date_modified' =>  date('Y-m-d H:i:s', now())
        );
        $this->db->insert($this->tbl_order,$data_order);
        $order_id=$this->db->insert_id();
        foreach ($this->cart->contents() as $cart) {
            $where=array(
                'product_id'=>$cart['id'],
                'size_id'=>$cart['size'],
                'color_id'=>$cart['color'],
                );
            $stock=$this->model_basic->select_where_array($this->tbl_product_stock,$where)->row();
            $data=array(
                'product_id'=>$cart['id'],
                'order_id'=>$order_id,
                'size_id'=>$cart['size'],
                'color_id'=>$cart['color'],
                'product_stock_id'=>$stock->id,
                'price'=>$cart['price'],
                'quantity'=>$cart['qty'],
                );
            $insert=$this->db->insert($this->tbl_product_order,$data);
            $data_stock=array(
                'stock'=>$stock->stock-$cart['qty'],
                );
            $update=$this->db->update($this->tbl_product_stock, $data_stock, array('id' => $stock->id));
        }
        if($insert){
             $this->cart->destroy();
            redirect('cart/thankyou/'.$invoice);
        }else{
            echo"error";
        }
    }

    function thankyou($invoice){
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Cart','cart');
        $data['address']= $this->model_basic->select_where($this->tbl_static_content,'id','6')->row();
        $data['phone']= $this->model_basic->select_where($this->tbl_static_content,'id','7')->row();
        $data['fax']= $this->model_basic->select_where($this->tbl_static_content,'id','8')->row();
        $data['content'] = $this->load->view('frontend/cart/thankyou',$data,true);
        $this->load->view('frontend/index',$data); 
    }
}
