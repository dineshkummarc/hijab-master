<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shop extends PX_Controller {

	public function __construct() {
		parent::__construct();
		$this->controller_attr = array('controller' => 'shop','controller_name' => 'Shop','controller_id' => 0);
                $this->do_underconstruct();
	}


	function index(){
		$data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('Shop','shop');
		$data['address']= $this->model_basic->select_where($this->tbl_static_content,'id','6')->row();
		$data['phone']= $this->model_basic->select_where($this->tbl_static_content,'id','7')->row();
		$data['fax']= $this->model_basic->select_where($this->tbl_static_content,'id','8')->row();
		$data['product'] = $this->model_basic->select_all($this->tbl_product);
		foreach ($data['product'] as $d_row) {
			$d_row->price = indonesian_currency($d_row->price);
			$d_row->image = $this->model_basic->select_where_double($this->tbl_product_image, 'product_id', $d_row->id, 'primary_status', '1')->row();
            $d_row->brand = $this->model_basic->select_where($this->tbl_brand, 'id', $d_row->brand_id)->row();
		}

		$data['content'] = $this->load->view('frontend/shop/index',$data,true);
		$this->load->view('frontend/index',$data); 
	}

    public function brand($url_brand = ''){
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Shop','shop');
        $data['address']= $this->model_basic->select_where($this->tbl_static_content,'id','6')->row();
        $data['phone']= $this->model_basic->select_where($this->tbl_static_content,'id','7')->row();
        $data['fax']= $this->model_basic->select_where($this->tbl_static_content,'id','8')->row();

        $data['brand'] = $this->model_basic->select_where($this->tbl_brand, 'url', $url_brand)->row();

        $data['product'] = $this->model_basic->select_where($this->tbl_product, 'brand_id', $data['brand']->id)->result();
        foreach ($data['product'] as $d_row) {
            $d_row->image = $this->model_basic->select_where_double($this->tbl_product_image, 'product_id', $d_row->id, 'primary_status', '1')->row();
            $d_row->price = indonesian_currency($d_row->price);
        }

        $data['content'] = $this->load->view('frontend/brand/index',$data,true);
        $this->load->view('frontend/index',$data); 
    }

	function detail($id){
		$data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('Shop','shop');
		$data['address']= $this->model_basic->select_where($this->tbl_static_content,'id','6')->row();
		$data['phone']= $this->model_basic->select_where($this->tbl_static_content,'id','7')->row();
		$data['fax']= $this->model_basic->select_where($this->tbl_static_content,'id','8')->row();

		$data['detail'] = $this->model_basic->select_where($this->tbl_product, 'id', $id)->row();
		$data['detail']->price = indonesian_currency($data['detail']->price);
		$data['detail']->size = $this->model_stock->select_size($this->tbl_product_stock, 'product_id', $id)->result();
		$data['detail']->color = $this->model_stock->select_color($this->tbl_product_stock, 'product_id', $id)->result();
		$data['detail']->image = $this->model_basic->select_where_order($this->tbl_product_image, 'product_id', $data['detail']->id, 'primary_status', '1')->row();
        $stock = '';
        if((int)$this->model_stock->sum_stock($id)->row()->stock > 0)
            $stock = 'In Stock';
                else
                    $stock = 'Out of Stock';
        $data['detail']->stock = $stock;
		foreach ($data['detail']->size as $d_row) {
			$d_row->size = $this->model_basic->select_where($this->tbl_size, 'id', $d_row->size_id)->row();
		}
		foreach ($data['detail']->color as $data_row) {
			$data_row->color = $this->model_basic->select_where($this->tbl_color, 'id', $data_row->color_id)->row();
		}
		$data['content'] = $this->load->view('frontend/shop/detail',$data,true);
		$this->load->view('frontend/index',$data); 
	}

	function addToCart($product_id)
    {

        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Shop','shop');
        $id = $this->session->userdata('id');
        if($id == false)
            $id = 0;
        //var_dump($id);
//
    //       $get_customer = $this->model_basic->select_where($this->tbl_customer,'id',$id)->row();
        $get_product = $this->model_basic->select_where($this->tbl_product,'id',$product_id)->row();
        $get_image_product = $this->model_basic->select_where($this->tbl_product_image,'product_id', $product_id)->row();

//        $insert =array(
//            'total' => $this->input->post('total'),
//            'product_id' => $get_product->id,
//            'customer_id' => $get_customer->id
//        );
//        $this->model_basic->insert_all($this->tbl_cart, $insert);
//        $data['address']= $this->model_basic->select_where($this->tbl_static_content,'id','6')->row();
//        $data['phone']= $this->model_basic->select_where($this->tbl_static_content,'id','7')->row();
//        $data['fax']= $this->model_basic->select_where($this->tbl_static_content,'id','8')->row();
//        $data['product'] = $this->model_basic->select_all($this->tbl_product);
//        foreach ($data['product'] as $d_row) {
//            $d_row->price = indonesian_currency($d_row->price);
//            $d_row->image = $this->model_basic->select_where_double($this->tbl_product_image, 'product_id', $d_row->id, 'primary_status', '1')->row();
//        };
//        $data['content'] = $this->load->view('frontend/shop/index',$data,true);
//        $this->load->view('frontend/index',$data);
        $insert_data = array(
            'id' => $get_product->id,
            'name' => $get_product->name_product,
            'price' => $get_product->price,
            'qty' => 1,
            'customer_id' => $id,
            'pict' => $get_image_product->photo
        );
//        var_dump($insert_data);
        $cek_wishlist = array(
            'product_id' => $get_product->id,
            'customer_id' => $id);
        $check = $this->model_basic->select_where_array($this->tbl_wishlist, $cek_wishlist);

        if ($check) {
            $this->model_basic->delete_where_array($this->tbl_wishlist, $cek_wishlist);
        }

        $this->cart->insert($insert_data);
//        var_dump($this->cart->contents());
        $data['address']= $this->model_basic->select_where($this->tbl_static_content,'id','6')->row();
        $data['phone']= $this->model_basic->select_where($this->tbl_static_content,'id','7')->row();
        $data['fax']= $this->model_basic->select_where($this->tbl_static_content,'id','8')->row();
        $data['product'] = $this->model_basic->select_all($this->tbl_product);
        foreach ($data['product'] as $d_row) {
            $d_row->price = indonesian_currency($d_row->price);
            $d_row->image = $this->model_basic->select_where_double($this->tbl_product_image, 'product_id', $d_row->id, 'primary_status', '1')->row();
        };
        $data['content'] = $this->load->view('frontend/shop/index',$data,true);
        $this->load->view('frontend/index',$data);
    }

    function updateToCart($id)
    {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Shop','shop');
//        $id = $this->session->userdata('id');
//
       // $get_customer = $this->model_basic->select_where($this->tbl_customer,'id',$id)->row();
        //$get_product = $this->model_basic->select_where($this->tbl_product,'id',$product_id)->row();

//        $insert =array(
//            'total' => $this->input->post('total'),
//            'product_id' => $get_product->id,
//            'customer_id' => $get_customer->id
//        );
//        $this->model_basic->insert_all($this->tbl_cart, $insert);
//        $data['address']= $this->model_basic->select_where($this->tbl_static_content,'id','6')->row();
//        $data['phone']= $this->model_basic->select_where($this->tbl_static_content,'id','7')->row();
//        $data['fax']= $this->model_basic->select_where($this->tbl_static_content,'id','8')->row();
//        $data['product'] = $this->model_basic->select_all($this->tbl_product);
//        foreach ($data['product'] as $d_row) {
//            $d_row->price = indonesian_currency($d_row->price);
//            $d_row->image = $this->model_basic->select_where_double($this->tbl_product_image, 'product_id', $d_row->id, 'primary_status', '1')->row();
//        };
//        $data['content'] = $this->load->view('frontend/shop/index',$data,true);
//        $this->load->view('frontend/index',$data);
        $insert_data = array(
            'rowid' => $id,
            'qty' => 0
        );
       // var_dump($this->cart->contents());

        $this->cart->update($insert_data);
      // var_dump($this->cart->contents());
        $data['address']= $this->model_basic->select_where($this->tbl_static_content,'id','6')->row();
        $data['phone']= $this->model_basic->select_where($this->tbl_static_content,'id','7')->row();
        $data['fax']= $this->model_basic->select_where($this->tbl_static_content,'id','8')->row();
        $data['product'] = $this->model_basic->select_all($this->tbl_product);
        foreach ($data['product'] as $d_row) {
            $d_row->price = indonesian_currency($d_row->price);
            $d_row->image = $this->model_basic->select_where_double($this->tbl_product_image, 'product_id', $d_row->id, 'primary_status', '1')->row();
        };
        $data['content'] = $this->load->view('frontend/shop/index',$data,true);
        $this->load->view('frontend/index',$data);
    }
// <<<<<<< HEAD
// =======

     function addToWishList($product_id){
         $data = $this->get_app_settings();
         $data += $this->controller_attr;
         $data += $this->get_function('Shop','shop');
         $id = $this->session->userdata('id');

 //        var_dump($this->cart->contents());

         $select= array(
             'product_id' => $product_id,
             'customer_id' => $id
         );
         //       $get_customer = $this->model_basic->select_where($this->tbl_customer,'id',$id)->row();
         $get_product = $this->model_basic->select_where_array($this->tbl_wishlist,$select)->row();
 //        var_dump($get_product);
         if($get_product){
             $this->model_basic->delete_where_array($this->tbl_wishlist,$select);
         }
         else{
            $this->model_basic->insert_all($this->tbl_wishlist, $select);
         }
         $data['address']= $this->model_basic->select_where($this->tbl_static_content,'id','6')->row();
         $data['phone']= $this->model_basic->select_where($this->tbl_static_content,'id','7')->row();
         $data['fax']= $this->model_basic->select_where($this->tbl_static_content,'id','8')->row();
         $data['product'] = $this->model_basic->select_all($this->tbl_product);
         foreach ($data['product'] as $d_row) {
             $d_row->price = indonesian_currency($d_row->price);
             $d_row->image = $this->model_basic->select_where_double($this->tbl_product_image, 'product_id', $d_row->id, 'primary_status', '1')->row();
         };
         $data['content'] = $this->load->view('frontend/shop/index',$data,true);
         $this->load->view('frontend/index',$data);

     }

     function process_checkout()
     {
         $customer_id = $this->session->userdata('id');
         $shipping_id = $this->input->post('shipping_id');
         $kurir = $this->input->post('jasa_pengiriman_id');
         $get_cart = $this->cart->contents();
         $ck = $this->input->post('input_different');
        $shipping= array(
            'id' => $shipping_id,
            'customer_id' => $customer_id
        );
         $invoice = $this->invoiceGenerator();

         $get_customer_info = $this->model_basic->select_all($this->tbl_customer,'id',$customer_id);
         $get_shipping_info = $this->model_basic->select_where_array($this->tbl_shipping_address,$shipping);
         $get_kurir_info = $this->model_basic->select_all($this->tbl_jasa_pengiriman,'id',$kurir);

         foreach ($get_cart as $item) {
             $insert =array(
                 'customer_id' => $customer_id,
                 'ship_address_id' => $shipping_id,
                 'invoice_number' => $invoice,
                 'total_order' =>1,
                 'total_ship_price' => '17000',
                 'total_payment' => '76000',
                 'status' => 0,
                 'date_created' =>  date('Y-m-d H:i:s', now()),
                 'date_modified' =>  date('Y-m-d H:i:s', now())
             );
             $do_insert = $this->model_basic->insert_all($this->tbl_order, $insert);
             if($do_insert){
                 $this->cart->destroy();
                 $data['address']= $this->model_basic->select_where($this->tbl_static_content,'id','6')->row();
                 $data['phone']= $this->model_basic->select_where($this->tbl_static_content,'id','7')->row();
                 $data['fax']= $this->model_basic->select_where($this->tbl_static_content,'id','8')->row();
                 $data['product'] = $this->model_basic->select_all($this->tbl_product);
                 foreach ($data['product'] as $d_row) {
                     $d_row->price = indonesian_currency($d_row->price);
                     $d_row->image = $this->model_basic->select_where_double($this->tbl_product_image, 'product_id', $d_row->id, 'primary_status', '1')->row();
                 };
                 $data['content'] = $this->load->view('frontend/shop/index',$data,true);
                 $this->load->view('frontend/index',$data);
             }
             else{

             }
         }

     }


}
