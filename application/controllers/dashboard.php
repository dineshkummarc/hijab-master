<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends PX_Controller {
	function __construct() {
		parent::__construct();

		$this->controller_attr = array('controller' => 'dashboard','controller_name' => 'Dashboard');
		if($this->session->userdata('member')['validated']==FALSE)
		{
			redirect('login');
		}
		$this->do_underconstruct();
	}

	public function index(){
		$data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('User','User');
		$customer_id = $this->session->userdata('member')['id'];
		$data['order_count']=$this->model_basic->select_where($this->tbl_order,'customer_id',$customer_id)->num_rows();
		$data['content'] = $this->load->view('frontend/dashboard/index',$data,true);
		$data['address']= $this->model_basic->select_where($this->tbl_static_content,'id','6')->row();
		$data['phone']= $this->model_basic->select_where($this->tbl_static_content,'id','7')->row();
		$data['fax']= $this->model_basic->select_where($this->tbl_static_content,'id','8')->row();
		$this->load->view('frontend/index',$data);
	}
	public function order_confirm($invoice = ""){
		$data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('Order Confirmation','order_confirm');
		$customer_id = $this->session->userdata('member')['id'];
		if ($invoice != "") {
			$data['invoice'] = $invoice;
		}
		else
		{
			$data['invoice'] = "";
		}
		$data['order_count']=$this->model_basic->select_where($this->tbl_order,'customer_id',$customer_id)->num_rows();
		$data['content'] = $this->load->view('frontend/dashboard/order_confirm',$data,true);
		$data['address']= $this->model_basic->select_where($this->tbl_static_content,'id','6')->row();
		$data['phone']= $this->model_basic->select_where($this->tbl_static_content,'id','7')->row();
		$data['fax']= $this->model_basic->select_where($this->tbl_static_content,'id','8')->row();
		$this->load->view('frontend/index',$data);
	}

	public function photo_profile(){
		$data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('Photo Profile','User');
		$customer_id = $this->session->userdata('member')['id'];
		$user=$this->model_basic->select_where($this->tbl_customer_billing_address,'customer_id',$customer_id)->num_rows();
		if($user<=0){
			$data['count_bil']=0;
		}else{
			$data['count_bil']=0;
		}
		$data['user'] = $this->model_basic->select_where('px_customer','id',$customer_id)->row();
		$data['address']= $this->model_basic->select_where($this->tbl_static_content,'id','6')->row();
		$data['phone']= $this->model_basic->select_where($this->tbl_static_content,'id','7')->row();
		$data['fax']= $this->model_basic->select_where($this->tbl_static_content,'id','8')->row();
		$data['content'] = $this->load->view('frontend/dashboard/photo_profile',$data,true);
		$this->load->view('frontend/index',$data);
	}
	public function submit_photo(){
		$customer_id = $this->session->userdata('member')['id'];
		$attachment_file=$_FILES["photo"]["name"];
        $output_dir = "assets/uploads/customer/".$customer_id."/";
            $fileName = strtolower($_FILES["photo"]["name"]);
            if (!file_exists("assets/uploads/customer/".$customer_id)) {
    		mkdir("assets/uploads/customer/".$customer_id);
			}
            move_uploaded_file($_FILES["photo"]["tmp_name"],$output_dir.$fileName);
            //echo "File uploaded successfully";
            $new  = "assets/uploads/customer/".$customer_id."/".$fileName;
			$this->load->library('image_lib');
			if(file_exists(FCPATH."".$new)){
			$config['image_library'] = 'gd2';
			$config['source_image'] = $new;
			$config['create_thumb'] = TRUE;
			$config['maintain_ratio'] = TRUE;
			$config['width']    = 250;
			$config['height']   = 250;
			$config['new_image'] = FCPATH."assets/uploads/customer/".$customer_id."/";
			$config['thumb_marker'] = '-customer-thumb';
			$this->image_lib->initialize($config);
			$this->image_lib->resize();
			$config['width']    = 500;
			$config['height']   = 500;
			$config['thumb_marker'] = '-customer';
			$this->image_lib->initialize($config);
			$this->image_lib->resize();
			unlink($new);
			$fileName=str_replace('.jpg','-customer.jpg',$fileName);
			$data=array(
				'photo'=> $fileName,
				);
			$update=$this->db->update($this->tbl_customer, $data, "id =".$customer_id);
			if($update){
				redirect('dashboard/bil_address');
			}else{
				echo"error";
			}
        }
	}
	public function shipping_address(){
		$data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('User Address Shipping','User');
		$customer_id = $this->session->userdata('member')['id'];
		$datas=array(
			"customer_id"=>$customer_id,
			"is_deleted"=>0,
			);
		$data['shipping_address']=$this->model_basic->select_where_array($this->tbl_customer_shipping_address,$datas)->result();
		$data['address']= $this->model_basic->select_where($this->tbl_static_content,'id','6')->row();
		$data['phone']= $this->model_basic->select_where($this->tbl_static_content,'id','7')->row();
		$data['fax']= $this->model_basic->select_where($this->tbl_static_content,'id','8')->row();
		$data['content'] = $this->load->view('frontend/dashboard/list_address',$data,true);
		$this->load->view('frontend/index',$data);
	}
	public function detail_address($id=null){
		$data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('User Address Shipping','User');
		$customer_id = $this->session->userdata('member')['id'];
		if($id!=null){
			$data['shipping']=$this->model_basic->select_where($this->tbl_customer_shipping_address,'id',$id)->row();
			$data['city'] = $this->model_basic->select_where($this->tbl_shipping_city,'id',$data['shipping']->city)->row();
			$data['region'] = $this->model_basic->select_where($this->tbl_shipping_region,'id',$data['shipping']->region)->row();
		}else{
			$data['shipping']='';
		}
		$data['province_list'] = $this->model_basic->select_all($this->tbl_shipping_province);
       $data['address']= $this->model_basic->select_where($this->tbl_static_content,'id','6')->row();
		$data['phone']= $this->model_basic->select_where($this->tbl_static_content,'id','7')->row();
		$data['fax']= $this->model_basic->select_where($this->tbl_static_content,'id','8')->row();
		$data['content'] = $this->load->view('frontend/dashboard/ship_address',$data,true);
		$this->load->view('frontend/index',$data);
	}

    function invoice($invoice)
    {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Dashboard','dashboard');
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
        //tracking system
        $tracking_system = $this->model_basic->select_where_order($this->tbl_tracking_system, 'order_id', $data['invoice']->id, 'date_created', 'desc')->result();
        foreach($tracking_system as $data_row)
        {
            $data_row->status = $this->model_basic->select_where($this->tbl_tracking_status, 'status_id', $data_row->status_id)->row();
            $data_row->date_created = date('d M Y H:i:s', strtotime($data_row->date_created));
        }
        $data['product']=$order_prod;
        $data['tracking_system'] = $tracking_system;
        $data['address']= $this->model_basic->select_where($this->tbl_static_content,'id','6')->row();
        $data['phone']= $this->model_basic->select_where($this->tbl_static_content,'id','7')->row();
        $data['fax']= $this->model_basic->select_where($this->tbl_static_content,'id','8')->row();
        $data['content'] = $this->load->view('frontend/dashboard/invoice',$data,true);
        $this->load->view('frontend/index',$data); 
    }

	public function update_ship(){
		$customer_id = $this->session->userdata('member')['id'];
		$id=$this->input->post('id');
		$data_ship=array(
				"receiver_name"=>$this->input->post('receiver_name'),
				"customer_id"=>$customer_id,
				"address"=>$this->input->post('address'),
				"province"=>$this->input->post('province'),
				"city"=>$this->input->post('city'),
				"region"=>$this->input->post('region'),
				"postal_code"=>$this->input->post('postal_code'),
				"phone"=>$this->input->post('phone'),
				"title"=>$this->input->post('title'),
			);
		if($id!=''){
		$insert=$this->db->update($this->tbl_customer_shipping_address,$data_ship, "id = $id");
		}else{
		$insert=$this->db->insert($this->tbl_customer_shipping_address,$data_ship);
		}
		if($insert){
			$this->session->set_flashdata('msg','congratulations, your data have been saved');
			redirect('dashboard/shipping_address');
		}else{
			echo"error";
		}

	}

	public function submit_confirm()
	{
		$invoice = $this->input->post('code');
		$order = $this->model_basic->select_where($this->tbl_order,'invoice_number',$invoice);
		if($order->num_rows() < 1){
			$this->returnJson(array('status' => 'notfound', 'redirect' => 'dashboard/order_confirm', 'msg' => 'Sorry, your Invoice Number is not found.'));
		}
		else
		{
			$order = $order->row();

			if($order->status >= 1){
				$id_confirmation = $this->model_basic->select_where($this->tbl_order_confirmation, 'order_id', $order->id)->row()->id;
				$data_confirm = array(
						'date_created' => date('Y-m-d H:i:s',now())
					);
				$this->model_basic->update($this->tbl_tracking_system, $data_confirm, 'id', $id_confirmation);

				$this->returnJson(array('status' => 'already', 'redirect' => 'dashboard/order_confirm', 'msg' => 'Your order is already confirmed.'));
			}
			else
			{
				$data_confirm = array(
						"order_id" => $order->id,
						"account_name" => $this->input->post('acc_name'),
						"account_bank" => $this->input->post('acc_bank'),
						"bank_target" => $this->input->post('bank_target'),
						"total_payment" => $this->input->post('tot_payment'),
						"date_transfer" => $this->input->post('date_tf'),
						'date_created' => date('Y-m-d H:i:s',now()),
					);
				$insert = $this->model_basic->insert_all($this->tbl_order_confirmation, $data_confirm);
				$data_order = array(
						"status" => 1,
						'date_modified' => date('Y-m-d H:i:s',now()),
					);
				$update = $this->model_basic->update($this->tbl_order, $data_order, 'id', $order->id);

				if($insert){
					$data_tracking = array(
						'order_id' => $order->id,
						'status_id' => 2,
						'title' => "Confirmed",
						'content' => "Customer sudah konfirmasi pembayaran order.",
						'date_created' => date('Y-m-d H:i:s',now())
					);
					$insert_tracking = $this->model_basic->insert_all($this->tbl_tracking_system, $data_tracking);

					$this->returnJson(array('status' => 'ok', 'redirect' => 'dashboard/order_confirm', 'msg' => 'Congratulations, your order has been confirmed.'));
				}else{
					$this->returnJson(array('status' => 'error', 'redirect' => 'dashboard/order_confirm', 'msg' => 'Error!'));
				}
			}
		}

	}
	public function del_address($id){
		$data_ship=array(
				"is_deleted"=>1,
			);
		$insert=$this->db->update($this->tbl_customer_shipping_address,$data_ship, "id = $id");
		
		if($insert){
			$this->session->set_flashdata('msg','Your data have been removed');
			redirect('dashboard/shipping_address');
		}else{
			echo"error";
		}

	}
	public function profile(){
		$data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('User Profile','User');
		$customer_id = $this->session->userdata('member')['id'];
		$data['user'] = $this->model_basic->select_where($this->tbl_customer,'id',$customer_id)->row();
		$data['address']= $this->model_basic->select_where($this->tbl_static_content,'id','6')->row();
		$data['phone']= $this->model_basic->select_where($this->tbl_static_content,'id','7')->row();
		$data['fax']= $this->model_basic->select_where($this->tbl_static_content,'id','8')->row();
		$data['content'] = $this->load->view('frontend/dashboard/profile',$data,true);
		$this->load->view('frontend/index',$data);
	}

	function editprofile(){
		$customer_id = $this->session->userdata('member')['id'];
		$data=array(
			'nama_depan'=>$this->input->post('nama_depan'),
			'nama_belakang'=>$this->input->post('nama_belakang'),
			'tgl_lahir' => $this->input->post('tgl_lahir'),
			'jenis_kelamin' => $this->input->post('gender'),
			'date_modified'=>date('Y-m-d H:i:s',now()),
			);
		$query=$this->model_basic->update($this->tbl_customer,$data,'id',$customer_id);
		if($query){
			$this->session->set_flashdata('notif','succsess');
			$this->session->set_flashdata('msg','Berhasil, data akun anda telah berhasil di perbarui');
			$this->session->set_userdata('nama_depan',$data['nama_depan']);
			$this->session->set_userdata('nama_belakang',$data['nama_belakang']);
			redirect('dashboard/profile');
		}else{
			$this->session->set_flashdata('notif','failed');
			$this->session->set_flashdata('msg','Gagal, data akun anda gagal di perbarui');
			redirect('dashboard/profile');
		}
	}

	public function order(){
		$data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('Order History','User');
		$customer_id = $this->session->userdata('member')['id'];

        if(isset($_GET['per_page']))
        {
            $start = $_GET['per_page'] ;
        }
        else
        {
            $start = 0;
        }

		$data['order'] = $this->model_shop->select_customer_order($customer_id, 5, $start)->result();
		$data['order_count'] = $this->model_shop->select_customer_order_count($customer_id)->num_rows();
		foreach ($data['order'] as $d_row) {
			$d_row->date_created = "Tanggal : ".date('d M Y', strtotime($d_row->date_created)).' | Jam : '.date('H:i', strtotime($d_row->date_created));
			$d_row->total_order=indonesian_currency($d_row->total_order);
			$d_row->total_ship_price = indonesian_currency($d_row->total_ship_price);
			$d_row->total_payment = indonesian_currency($d_row->total_payment);
		}

		$this->load->library('pagination');
        
        $config['base_url'] = base_url().'dashboard/order?';
        $config['total_rows'] = $data['order_count'];
        $config['per_page'] = 5;
        $config['uri_segment'] = 4;
        $config['num_links'] = 4;
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

		$data += $this->get_function('User Order','User');
		$data['start_no'] = $start;
		$data['content'] = $this->load->view('frontend/dashboard/order',$data,true);
		$data['address']= $this->model_basic->select_where($this->tbl_static_content,'id','6')->row();
		$data['phone']= $this->model_basic->select_where($this->tbl_static_content,'id','7')->row();
		$data['fax']= $this->model_basic->select_where($this->tbl_static_content,'id','8')->row();
		$this->load->view('frontend/index',$data);
	}

	public function changepassword(){
		$data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('User Change Password','User');
		$customer_id = $this->session->userdata('member')['id'];
		$data['user'] = $this->model_basic->select_where('px_customer','id',$customer_id)->row();
		$data['user']->password = $this->encrypt->decode($data['user']->password);
		$data['address']= $this->model_basic->select_where($this->tbl_static_content,'id','6')->row();
		$data['phone']= $this->model_basic->select_where($this->tbl_static_content,'id','7')->row();
		$data['fax']= $this->model_basic->select_where($this->tbl_static_content,'id','8')->row();
		$data['content'] = $this->load->view('frontend/dashboard/changepassword',$data,true);
		$this->load->view('frontend/index',$data);
	}

	function update_pass(){
		$old=$this->input->post('oldpassword');
		$pass=$this->input->post('password');
		$cpass=$this->input->post('cpassword');
		$data=array(
			'password'=>$this->encrypt->encode($pass),
		);
		$user=$this->model_basic->select_where($this->tbl_customer,'id',$this->session->userdata('member')['id'])->row();
		if($this->encrypt->decode($user->password)==$old){
			if($pass==$cpass){
				$query=$this->model_basic->update($this->tbl_customer,$data,'id',$this->session->userdata('member')['id']);
				$this->returnJson(array('status' => 'ok', 'msg' => 'Password berhasil di update.'));
			}else{
				$this->session->set_flashdata('msg','Password dan Confirmation Password tidak sama');
				$this->returnJson(array('status' => 'wrongnewpass', 'msg' => 'Password dan Confirmation Password tidak sama.'));
			}
		}else{
			$this->returnJson(array('status' => 'wrongoldpass', 'msg' => 'Password Lama tidak sama.'));
		}
		
	}

	public function address(){
		$data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('User Address Shipping','User');
		$customer_id = $this->session->userdata('member')['id'];
		$data['user'] = $this->model_basic->select_where('px_customer','id',$customer_id)->row();
		$data['useraddress'] = $this->model_basic->select_where('px_customer_billing_address','customer_id',$customer_id)->row();
		$data['province_list'] = $this->model_basic->select_all($this->tbl_shipping_province);
        $data['city_list'] = $this->model_basic->select_all($this->tbl_shipping_city);
        $data['region_list'] = $this->model_basic->select_all($this->tbl_shipping_region);
        $data['address']= $this->model_basic->select_where($this->tbl_static_content,'id','6')->row();
		$data['phone']= $this->model_basic->select_where($this->tbl_static_content,'id','7')->row();
		$data['fax']= $this->model_basic->select_where($this->tbl_static_content,'id','8')->row();
		$data['content'] = $this->load->view('frontend/dashboard/address',$data,true);
		$this->load->view('frontend/index',$data);
	}

	function editaddress(){
		$data=array(
			'title'=>$this->input->post('title'),
			'address'=>$this->input->post('address'),
			'province'=>$this->input->post('province'),
			'city'=>$this->input->post('city'),
			'region'=>$this->input->post('region'),
			'postal_code'=>$this->input->post('postal_code'),
			'phone' => $this->input->post('phone')
			);
		$query=$this->model_basic->update($this->tbl_customer_billing_address,$data,'customer_id',$customer_id);
		if($query){
			$this->session->set_flashdata('notif','succsess');
			$this->session->set_flashdata('msg','Berhasil, data alamat anda telah berhasil di perbarui');
			$this->session->set_userdata('nama_depan',$data['address']);
			redirect('dashboard/address');
		}else{
			$this->session->set_flashdata('notif','failed');
			$this->session->set_flashdata('msg','Gagal, data alamat anda gagal di perbarui');
			redirect('dashboard/address');
		}
	}

	public function get_city($id){
		$data = "";
		$kabupaten = $this->model_basic->select_where($this->tbl_shipping_city,'id_province',$id);
		if ($kabupaten->num_rows() > 0) 
		{
			$data .= "<option value=''>Pilih Kota</option>";
			foreach ($kabupaten->result() as $key) 
			{
				$data.="<option value='".$key->id."'>".$key->name."</option>";
			}
		}
		
		echo json_encode($data);
	}

	public function get_region($id){
		$data = "";
		$kabupaten=$this->model_basic->select_where($this->tbl_shipping_region,'id_city',$id);
		if ($kabupaten->num_rows() > 0) 
		{
			$data .= "<option value=''>Pilih Kecamatan</option>";
			foreach ($kabupaten->result() as $key) {
				$data .= "<option value='".$key->id."'>".$key->name."</option>";
			}
		}

		echo json_encode($data);
	}
	public function kabupaten($id){
		$data = "";
		$kabupaten = $this->model_basic->select_where($this->tbl_shipping_city,'id_province',$id);
		if ($kabupaten->num_rows() > 0) 
		{
			$data .= "<option value=''>Pilih Kota</option>";
			foreach ($kabupaten->result() as $key) 
			{
				$data.="<option value='".$key->id."'>".$key->name."</option>";
			}
		}
		
		echo json_encode($data);
	}

	public function region($id){
		$data = "";
		$kabupaten=$this->model_basic->select_where($this->tbl_shipping_region,'id_city',$id);
		if ($kabupaten->num_rows() > 0) 
		{
			$data .= "<option value=''>Pilih Kecamatan</option>";
			foreach ($kabupaten->result() as $key) {
				$data .= "<option value='".$key->id."'>".$key->name."</option>";
			}
		}

		echo json_encode($data);
	}
}