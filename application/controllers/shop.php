<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shop extends PX_Controller {

	public function __construct() {
		parent::__construct();
		$this->controller_attr = array('controller' => 'shop','controller_name' => 'Shop','controller_id' => 0);
                $this->do_underconstruct();
        $this->load->model('model_product');
	}


	function index(){
		$data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('Shop','shop');
		$data['address']= $this->model_basic->select_where($this->tbl_static_content,'id','6')->row();
		$data['phone']= $this->model_basic->select_where($this->tbl_static_content,'id','7')->row();
		$data['fax']= $this->model_basic->select_where($this->tbl_static_content,'id','8')->row();

        if(isset($_GET['sortby']))
        {
            $sortby = $_GET['sortby'] ;
            $url_sortby = 'sortby='.$_GET['sortby'];
        }
        else
        {
            $sortby = "";
            $url_sortby = "";
        }
        if(isset($_GET['show']))
        {
            $show = $_GET['show'] ;
            $url_show = '&show='.$_GET['show'];
        }
        else
        {
            $show = 9;
            $url_show = "";
        }
        $per_page = $show;
        if(isset($_GET['per_page']))
        {
            $start = $_GET['per_page'] ;
        }
        else
        {
            $start = 0;
        }
        $data['product'] = $this->model_shop->get_product_where($sortby, $per_page, $start);
        //print_r($this->db->last_query());
		foreach ($data['product']->result() as $d_row) {
            $price_disc= $d_row->price/100*$d_row->discount;
            $d_row->price_disc=indonesian_currency($d_row->price-$price_disc);
			$d_row->price = indonesian_currency($d_row->price);
            $image = $this->model_basic->select_where($this->tbl_product_image, 'product_id', $d_row->id);
            if ($image->num_rows() > 0) {
                    $d_row->image=$image->row()->photo;
                }else{
                    $d_row->image="";
                }
            $d_row->brand = $this->model_basic->select_where($this->tbl_brand, 'id', $d_row->brand_id)->row();
            
		}
        $data['category']=$this->model_basic->select_where($this->tbl_category,'delete_flag','0')->result();
        $data['color']=$this->model_basic->select_all($this->tbl_color);
        $data['brand']=$this->model_basic->select_all($this->tbl_brand);
        $data['size']=$this->model_basic->select_all($this->tbl_size);

        $this->load->library('pagination');
        
        $config['base_url'] = base_url().'shop?'.$url_sortby.$url_show;
        $config['total_rows'] = $this->model_shop->get_product_count();
        $config['per_page'] = $per_page;
        $config['uri_segment'] = 3;
        $config['num_links'] = 3;
        $config['page_query_string'] = TRUE;
        $config['full_tag_open'] = '<ul>';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = '&gt;';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&lt;';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';
   
        $this->pagination->initialize($config);
        
        $data["links"] = $this->pagination->create_links();

        $data['start_items'] = $start + 1;
        $data['to_items'] = $start + $data['product']->num_rows();
        $data['total_items'] = $config['total_rows'];
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
            $price_disc= $d_row->price/100*$d_row->discount;
            $d_row->price_disc=indonesian_currency($d_row->price-$price_disc);
            $d_row->price = indonesian_currency($d_row->price);
            $image=$this->model_basic->select_where($this->tbl_product_image, 'product_id', $d_row->id)->row();
            $d_row->image = $image->photo;
            $d_row->brand = $this->model_basic->select_where($this->tbl_brand, 'id', $d_row->brand_id)->row();
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
		$data['detail']->image = $this->model_basic->select_where_order($this->tbl_product_image, 'product_id', $data['detail']->id, 'primary_status', '1')->result();
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



     function addToWishList($product_id){
         $data = $this->get_app_settings();
         $data += $this->controller_attr;
         $data += $this->get_function('Shop','shop');
         $id = $this->session->userdata('id');

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
     function search(){
        $category=$this->input->post('category');
        $brand=$this->input->post('brand');
        $color=$this->input->post('color');
        $price=$this->input->post('price');
        $size=$this->input->post('size');
        $category = explode("category%5B%5D=", $category);
        $category = str_replace("&","",$category);
        $brand = explode("brand%5B%5D=", $brand);
        $brand = str_replace("&","",$brand);
        $color = explode("color%5B%5D=", $color);
        $color = str_replace("&","",$color);
        $size = explode("size%5B%5D=", $size);
        $size = str_replace("&","",$size);
        // foreach ($size as $key => $value) {
        //     echo $value;
        // }
        $data='';
        $data['product']=$this->model_product->search_product($category,$brand,$color,$price,$size);
        // print_r($this->db->last_query());die();
        foreach ($data['product']->result() as $d_row) {
            $price_disc= $d_row->price/100*$d_row->discount;
            $d_row->price_disc=indonesian_currency($d_row->price-$price_disc);
            $d_row->price = indonesian_currency($d_row->price);
            $image=$this->model_basic->select_where($this->tbl_product_image, 'product_id', $d_row->id);
            if ($image->num_rows() > 0) {
                    $d_row->image=$image->row()->photo;
                }else{
                    $d_row->image="";
                }
            $d_row->brand = $this->model_basic->select_where($this->tbl_brand, 'id', $d_row->brand_id)->row();
        }
        $response = $this->load->view('frontend/shop/page',$data,TRUE);
        echo json_encode(array('status'=>TRUE,'response'=>$response));
     }


}
