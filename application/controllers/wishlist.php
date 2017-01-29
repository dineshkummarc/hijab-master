<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Wishlist extends PX_Controller{
	function __construct(){
		parent::__construct();
		$this->controller_attr = array('controller' => 'wishlist','controller_name' => 'Wishlist');
                $this->do_underconstruct();
                if($this->session->userdata('member')['validated']===FALSE)
		{
			redirect('login');
		}
		$this->do_underconstruct();
	}

	public function index(){
		$data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('Wishlist','wishlist');
		$data['address']= $this->model_basic->select_where($this->tbl_static_content,'id','6')->row();
		$data['phone']= $this->model_basic->select_where($this->tbl_static_content,'id','7')->row();
		$data['fax']= $this->model_basic->select_where($this->tbl_static_content,'id','8')->row();

		$data['wishlist'] = $this->model_basic->select_where($this->tbl_wishlist, 'customer_id', $this->session->userdata('member')['id'])->result();
		foreach ($data['wishlist'] as $d_row) {
			$d_row->image = $this->model_basic->select_where_double($this->tbl_product_image, 'product_id', $d_row->product_id, 'primary_status', '1')->row();
			$d_row->product = $this->model_basic->select_where($this->tbl_product, 'id', $d_row->product_id)->row();			
			$d_row->product->price = indonesian_currency($d_row->product->price);
		}

		$data['content'] = $this->load->view('frontend/wishlist/index',$data,true);
		$this->load->view('frontend/index',$data);
	}

	function wishlist_add($product_id){
		$data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('Wishlist','wishlist');
		$customer_id=$this->session->userdata('member')['id'];
		$insert_wishlist = array(
			'product_id' => $product_id,
			'customer_id' => $this->session->userdata('member')['id']
			);
		$this->model_basic->insert_all($this->tbl_wishlist, $insert_wishlist);
		redirect('wishlist');
	}

	function wishlist_delete($id){
		$data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('Wishlist','wishlist');
		$this->model_basic->delete($this->tbl_wishlist, 'id', $id);
		redirect('wishlist');
	}
}