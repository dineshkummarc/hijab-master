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

    function add_to_cart()
    {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Cart','cart');

        $where = array(
                'product_id' => $this->input->post('id_product'),
                'size_id' => $this->input->post('size'),
                'color_id' => $this->input->post('color'),
                );
        $stock=$this->model_basic->select_where_array($this->tbl_product_stock,$where)->row();

        if($stock->stock == 0){
            $this->returnJson(array('status' => 'outofstock', 'msg' => 'Sorry, this product currently out of stock.'));
        }

        $get_product = $this->model_basic->select_where($this->tbl_product,'id',$this->input->post('id_product'))->row();
        $get_image_product = $this->model_basic->select_where($this->tbl_product_image,'product_id', $this->input->post('id_product'))->row();
        $size = $this->model_basic->select_where($this->tbl_size,'id',$this->input->post('size'))->row();
        $color = $this->model_basic->select_where($this->tbl_color,'id',$this->input->post('color'))->row();

        $insert_data = array(
            'id' => $stock->id,     
            'qty' => $this->input->post('qty'),
            'price' => $get_product->price,
            'name' => $get_product->name_product,
            'options' => array(
                            'weight' => $get_product->weight,
                            'pict' => $get_image_product->photo,
                            'product_id' => $this->input->post('id_product'),
                            'size' => $this->input->post('size'),
                            'color' => $this->input->post('color'),
                            'n_size' => $size->name,
                            'n_color' => $color->name,
                        )
        );
        $insert = $this->cart->insert($insert_data);
        if ($insert) {
            $this->returnJson(array('status' => 'ok', 'msg' => 'Your item has been added to cart.', 'redirect' => 'cart'));
        }else{
            $this->returnJson(array('status' => 'error', 'msg' => 'Add to cart failed.', 'redirect' => 'cart'));
        }
    }

    function add_to_wishlist()
    {
        if (!$this->session->userdata('member')) {
            $this->returnJson(array('status' => 'noncustomer', 'msg' => 'You must login to add this item.', 'redirect' => 'login'));
        }
        $data = array(
            'product_id' => $this->input->post('id'),
            'customer_id' => $this->session->userdata('member')['id'],
            );
        $exist_wishlist = $this->model_basic->select_where_array($this->tbl_wishlist, $data);
        if ($exist_wishlist->num_rows() > 0) 
        {
            $this->returnJson(array('status' => 'failed', 'msg' => 'This item is already in your wishlist.'));
        }
        else
        {
            $insert = $this->model_basic->insert_all($this->tbl_wishlist, $data);
            $this->returnJson(array('status' => 'ok', 'msg' => 'Your item has been added to your wishlist.'));
        }

    }

    function checkout(){
        if($this->session->userdata('member')['validated'] == FALSE)
        {
            $this->session->set_flashdata('msg_check','Anda harus login atau register untuk melakukan step berikutnya.');
            redirect('login');
        }
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('cart','My Cart');
        $customer_id = $this->session->userdata('member')['id'];

        $data['user'] = $this->model_basic->select_where($this->tbl_customer, 'id', $customer_id)->row();
        $data['usershipping'] = $this->model_basic->select_where($this->tbl_shipping_address, 'customer_id', $customer_id)->result();
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

    function apply_voucher()
    {
        $now = date('Y-m-d H:i:s', now());
        $code = $this->input->post('coupon');
        $filter = array('voucher' => $code, 'status' => 1);
        $voucher = $this->model_basic->select_where_array($this->tbl_voucher, $filter);
        if ($voucher->num_rows() > 0) {
            $voucher = $voucher->row();
            if ($now >= $voucher->date_start && $now <= $voucher->date_end) {
                $disc = ($this->cart->total() * $voucher->discount) / 100;
                $total_price = $this->cart->total() - $disc;
                $this->session->set_userdata('voucher', array('voucher_id' => $voucher->id, 'discount' => $voucher->discount));
                $this->returnJson(array('status' => 'ok', 'msg' => '<p>Anda berhasil menggunakan voucher.</p>', 'data' => array('disc_percentage' => $voucher->discount, 'disc' => $this->indonesian_currency($disc), 'total_price' => $this->indonesian_currency($total_price))));
            }
            else
            {
                $this->returnJson(array('status' => 'expired', 'msg' => '<p>Voucher anda tidak berlaku.</p>'));
            }
        }
        else
        {
            $this->returnJson(array('status' => 'error', 'msg' => '<p>Voucher tidak ditemukan.</p>'));
        }


    }

    function get_new_address()
    {
        $total_price = $this->cart->total();

        echo json_encode($total_price);
    }

    function check_product_stock()
    {
        foreach ($this->cart->contents() as $item) {
            if ($item['rowid'] == $this->input->post('rowid')) {
                $product_stock_id = $item['id'];
            }
        }
        $stock = $this->model_basic->select_where($this->tbl_product_stock, 'id', $product_stock_id);
        if ($stock->num_rows > 0) {
            $stock = $stock->row()->stock;
            $this->returnJson(array('status' => 'ok', 'stock' => $stock));
        }
        else
        {
            $this->returnJson(array('status' => 'outofstock', 'stock' => 0));
        }

    }

    function count_total_price()
    {
        //update cart
        $data_update = array(
            'rowid' => $this->input->post('rowid'), 
            'qty' => $this->input->post('qty')
            );
        $update = $this->cart->update($data_update); 

        $other_price = 0;
        foreach ($this->cart->contents() as $item) {
            if ($item['rowid'] == $this->input->post('rowid')) {
                $price = $item['price']; 
            }else{
                $other_price += $item['price'] * $item['qty'];
            }
        }
        $subtotal = $price * $this->input->post('qty');
        $total_price =  $subtotal + $other_price;
        
        if ($update) {
            $data = array('subtotal' => $this->indonesian_currency($subtotal), 'total_price' => $this->indonesian_currency($total_price));
            $this->returnJson(array('status' => 'ok', 'data' => $data));
        }
        
    }

    function clear_all_cart(){
    	$data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Cart','cart');

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

    function clear_cart_item(){
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Cart','cart');

        //update cart
        $data_update = array(
            'rowid' => $this->input->post('id'), 
            'qty' => 0
            );
        $update = $this->cart->update($data_update);
        if ($update) {
             $this->returnJson(array('status' => 'ok', 'redirect' => 'cart'));
         } else {
            $this->returnJson(array('status' => 'failed', 'redirect' => 'cart'));
         }
    }

    function get_shipping_address($id){
        $address=$this->model_basic->select_where($this->tbl_shipping_address,'id',$id)->row();
        $province=$this->model_basic->select_where($this->tbl_shipping_province,'id',$address->province)->row();
        $city=$this->model_basic->select_where($this->tbl_shipping_city,'id',$address->city)->row();
        $region=$this->model_basic->select_where($this->tbl_shipping_region,'id',$address->region)->row();
        $address->name_province = $province->name;
        $address->name_city = $city->name;
        $address->name_region = $region->name;
        $berat = 0;
        foreach ($this->cart->contents() as $item) {
            $berat += $this->cart->product_options($item['rowid'])['weight'] * $item['qty'];
        }
        $ongkir = ceil($berat/1000);
        $ongkir = $region->price * $berat;
        $address->cost = $ongkir;
        if ($this->session->userdata('voucher')) {
            $discount = $this->cart->total() * ($this->session->userdata('voucher')['discount'] / 100);
        }
        else
        {
            $discount = 0;
        }
        $address->tot_price = $this->cart->total() - $discount + $ongkir;

        echo json_encode($address);
    }

    function get_ongkir(){
        $region_id = $this->input->post('region_id');
        $region=$this->model_basic->select_where($this->tbl_shipping_region,'id',$region_id)->row();
        $berat=0;
        foreach ($this->cart->contents() as $cart) {
            $berat += $this->cart->product_options($cart['rowid'])['weight'] * $cart['qty'];
        }
        $ongkir=ceil($berat/1000);
        $ongkir=$region->price*$berat;
        $address = new stdClass();
        $address->cost= $ongkir;
        if ($this->session->userdata('voucher')) {
            $discount = $this->cart->total() * ($this->session->userdata('voucher')['discount'] / 100);
        }
        else
        {
            $discount = 0;
        }
        $address->tot_price = $this->cart->total() - $discount + $ongkir;

        echo json_encode($address);
    }

    function submit_order(){
        $invoice = $this->model_product->uniq_code();
        $customer_id = $this->session->userdata('member')['id'];;
        $shipping_id = $this->input->post('shipping_id');
        if ($this->session->userdata('voucher')) {
            $voucher_id = $this->session->userdata('voucher')['voucher_id'];
        }
        else
        {
            $voucher_id = 0;
        }
        if ($shipping_id == 0) {
            $customer_phone = $this->model_basic->select_where($this->tbl_shipping_address, 'customer_id', $customer_id)->row()->phone;
            $data_shipping_address = array(
                    'customer_id' => $customer_id,
                    'receiver_name' => $this->input->post('name_ship'),
                    'title' => "New Address",
                    'address' => $this->input->post('tujuan_ship'),
                    'province' => $this->input->post('province_ship'),
                    'city' => $this->input->post('city_ship'),
                    'region' => $this->input->post('region_ship'),
                    'postal_code' => $this->input->post('postcode_ship'),
                    'phone' => $this->input->post('phone_ship')
                );
            $shipping_id = $this->model_basic->insert_all($this->tbl_shipping_address, $data_shipping_address)->id;
        }else{
            $shipping_id = $this->input->post('shipping_id');
        }
        $random_code=rand(100,999);
        $data_order = array(
            'customer_id' => $customer_id,
            'ship_address_id' => $shipping_id,
            'voucher_id' => $voucher_id,
            'invoice_number' => $invoice,
            'total_order' => $this->cart->total(),
            'total_ship_price' => $this->input->post('cost'),
            'total_discount' => $this->cart->total() * ($this->session->userdata('voucher')['discount'] / 100),
            'total_payment' => $this->input->post('tot_price') + $random_code,
            'random_code' => $random_code,
            'status' => 0,
            'date_created' => date('Y-m-d H:i:s', now())
        );
        $order_id = $this->model_basic->insert_all($this->tbl_order, $data_order)->id;
        foreach ($this->cart->contents() as $item) {
            $item_option = $this->cart->product_options($item['rowid']);
            $where = array(
                'id' => $item['id']
                );
            $stock = $this->model_basic->select_where_array($this->tbl_product_stock, $where)->row();
            $data = array(
                'product_id' => $item_option['product_id'],
                'order_id' => $order_id,
                'size_id' => $item_option['size'],
                'color_id' => $item_option['color'],
                'product_stock_id' => $item['id'],
                'price' => $item['price'],
                'quantity' => $item['qty'],
                );
            $insert = $this->model_basic->insert_all($this->tbl_product_order, $data);
            $data_stock = array(
                'stock' => $stock->stock - $item['qty']
                );
            $this->model_basic->update($this->tbl_product_stock, $data_stock, 'id', $stock->id);
        }
        if($insert)
        {
            //send order success email
            $mail_data = new stdClass();
            $mail_data->receiver = $this->model_basic->select_where($this->tbl_customer, 'id', $customer_id)->row()->email;
            $mail_data->subject = "Order Success";
            $mail_data->message  = "";
            
             //insert to tracking system
             $data_tracking = array('order_id' => $order_id,
                                    'status_id' => 0,
                                    'title' => "Menunggu Konfirmasi",
                                    'content' => "Menunggu Konfirmasi Pembayaran dari Customer",
                                    'date_created' =>date('Y-m-d H:i:s', now()) 
                                );
             $this->model_basic->insert_all($this->tbl_tracking_system, $data_tracking);
             $this->session->unset_userdata('voucher');
             $this->cart->destroy();
            
             $this->returnJson(array('status' => 'ok', 'msg' => 'Insert Data success', 'redirect' => 'cart/thankyou/'.$invoice));
        }
        else
        {
            $this->returnJson(array('status' => 'error', 'msg' => 'Insert Data failed', 'redirect' => 'checkout'));
        }
    }

    function thankyou($invoice){
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Cart','cart');
        if($invoice==null){
            redirect('login');
        }
        $customer_id = $this->session->userdata('member')['id'];
        $data['invoice']=$this->model_basic->select_where($this->tbl_order,'invoice_number',$invoice)->row();
        $data['customer']=$this->model_basic->select_where($this->tbl_customer,'id',$data['invoice']->customer_id)->row();
        $data['ship_address']=$this->model_basic->select_where($this->tbl_shipping_address,'id',$data['invoice']->ship_address_id)->row();
       
        $data['prov_ship']=$this->model_basic->select_where($this->tbl_shipping_province,'id',$data['ship_address']->province)->row();
        $data['city_ship']=$this->model_basic->select_where($this->tbl_shipping_city,'id',$data['ship_address']->city)->row();
        $data['region_ship']=$this->model_basic->select_where($this->tbl_shipping_region,'id',$data['ship_address']->region)->row();
        $order_prod=$this->model_basic->select_where($this->tbl_product_order,'order_id',$data['invoice']->id)->result();
        foreach ($order_prod as $key) {
            $product=$this->model_basic->select_where($this->tbl_product,'id',$key->product_id)->row();
            $size=$this->model_basic->select_where($this->tbl_size,'id',$key->size_id)->row();
            $color=$this->model_basic->select_where($this->tbl_color,'id',$key->color_id)->row();
            $image=$this->model_basic->select_where($this->tbl_product_image, 'product_id', $key->product_id)->row();
            $key->image = $image->photo;
            $key->name=$product->name_product;
            $key->price=$product->price;
            $key->color=$color->name;
            $key->size=$size->name;
        }
        $data['product']=$order_prod;
        $data['address']= $this->model_basic->select_where($this->tbl_static_content,'id','6')->row();
        $data['phone']= $this->model_basic->select_where($this->tbl_static_content,'id','7')->row();
        $data['fax']= $this->model_basic->select_where($this->tbl_static_content,'id','8')->row();
        $data['content'] = $this->load->view('frontend/cart/thankyou',$data,true);
        $this->load->view('frontend/index',$data); 
    }
}
