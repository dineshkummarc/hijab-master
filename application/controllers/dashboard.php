<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends PX_Controller {
	function __construct() {
		parent::__construct();

		$this->controller_attr = array('controller' => 'dashboard','controller_name' => 'Dashboard');
		if($this->session->userdata('validated')==FALSE){
			redirect('login');
		}

                $this->do_underconstruct();
	}

	public function index(){
		$user=$this->model_basic->select_where($this->tbl_customer_billing_address,'customer_id',$this->session->userdata('id'))->num_rows();
		if($user<=0){
			redirect('dashboard/photo_profile');
		}
		$data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('User','User');
		$data['content'] = $this->load->view('frontend/dashboard/index',$data,true);
		$data['address']= $this->model_basic->select_where($this->tbl_static_content,'id','6')->row();
		$data['phone']= $this->model_basic->select_where($this->tbl_static_content,'id','7')->row();
		$data['fax']= $this->model_basic->select_where($this->tbl_static_content,'id','8')->row();
		$this->load->view('frontend/index',$data);
	}

	public function photo_profile(){
		$data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('Photo Profile','User');
		$user=$this->model_basic->select_where($this->tbl_customer_billing_address,'customer_id',$this->session->userdata('id'))->num_rows();
		if($user<=0){
			$data['count_bil']=0;
		}else{
			$data['count_bil']=0;
		}
		$data['user'] = $this->model_basic->select_where('px_customer','id',$this->session->userdata('id'))->row();
		$data['address']= $this->model_basic->select_where($this->tbl_static_content,'id','6')->row();
		$data['phone']= $this->model_basic->select_where($this->tbl_static_content,'id','7')->row();
		$data['fax']= $this->model_basic->select_where($this->tbl_static_content,'id','8')->row();
		$data['content'] = $this->load->view('frontend/dashboard/photo_profile',$data,true);
		$this->load->view('frontend/index',$data);
	}
	public function submit_photo(){
		$attachment_file=$_FILES["photo"]["name"];
        $output_dir = "assets/uploads/customer/".$this->session->userdata('id')."/";
            $fileName = strtolower($_FILES["photo"]["name"]);
            if (!file_exists("assets/uploads/customer/".$this->session->userdata('id'))) {
    		mkdir("assets/uploads/customer/".$this->session->userdata('id'));
			}
            move_uploaded_file($_FILES["photo"]["tmp_name"],$output_dir.$fileName);
            //echo "File uploaded successfully";
            $new  = "assets/uploads/customer/".$this->session->userdata('id')."/".$fileName;
			$this->load->library('image_lib');
			if(file_exists(FCPATH."".$new)){
			$config['image_library'] = 'gd2';
			$config['source_image'] = $new;
			$config['create_thumb'] = TRUE;
			$config['maintain_ratio'] = TRUE;
			$config['width']    = 250;
			$config['height']   = 250;
			$config['new_image'] = FCPATH."assets/uploads/customer/".$this->session->userdata('id')."/";
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
			$update=$this->db->update($this->tbl_customer, $data, "id =".$this->session->userdata('id'));
			if($update){
				redirect('dashboard/bil_address');
			}else{
				echo"error";
			}
        }
	}

	public function bil_address(){
		$data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('User Address Shipping','User');
		$user=$this->model_basic->select_where($this->tbl_customer_billing_address,'customer_id',$this->session->userdata('id'))->num_rows();
		if($user<=0){
			$data['count_bil']=0;
		}else{
			$data['count_bil']=0;
		}
		$data['province_list'] = $this->model_basic->select_all($this->tbl_shipping_province);
        $data['city_list'] = $this->model_basic->select_all($this->tbl_shipping_city);
        $data['region_list'] = $this->model_basic->select_all($this->tbl_shipping_region);
        $data['address']= $this->model_basic->select_where($this->tbl_static_content,'id','6')->row();
		$data['phone']= $this->model_basic->select_where($this->tbl_static_content,'id','7')->row();
		$data['fax']= $this->model_basic->select_where($this->tbl_static_content,'id','8')->row();
		$data['content'] = $this->load->view('frontend/dashboard/bil_address',$data,true);
		$this->load->view('frontend/index',$data);
	}

	public function register_biladdress(){
		$user=$this->model_basic->select_where($this->tbl_customer,'id',$this->session->userdata('id'))->row();
		$data_bil=array(
				"customer_id"=>$this->session->userdata('id'),
				"address"=>$this->input->post('address'),
				"province"=>$this->input->post('province'),
				"city"=>$this->input->post('city'),
				"region"=>$this->input->post('region'),
				"postal_code"=>$this->input->post('postal_code'),
				"phone"=>$this->input->post('phone'),
				"title"=>$this->input->post('title'),
			);
		$insert=$this->db->insert($this->tbl_customer_billing_address,$data_bil);
		$data_ship=array(
				"receiver_name"=>$user->nama_depan." ".$user->nama_belakang,
				"customer_id"=>$this->session->userdata('id'),
				"address"=>$this->input->post('address'),
				"province"=>$this->input->post('province'),
				"city"=>$this->input->post('city'),
				"region"=>$this->input->post('region'),
				"postal_code"=>$this->input->post('postal_code'),
				"phone"=>$this->input->post('phone'),
				"title"=>$this->input->post('title'),
			);
		$insert=$this->db->insert($this->tbl_shipping_address,$data_bil);
		if($insert){
			$this->session->set_flashdata('msg','congratulations, you have been registered in our system');
			redirect('dashboard');
		}else{
			echo"error";
		}

	}
	public function profile(){
		$data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('User Profile','User');
		$data['user'] = $this->model_basic->select_where('px_customer','id',$this->session->userdata('id'))->row();
		$data['address']= $this->model_basic->select_where($this->tbl_static_content,'id','6')->row();
		$data['phone']= $this->model_basic->select_where($this->tbl_static_content,'id','7')->row();
		$data['fax']= $this->model_basic->select_where($this->tbl_static_content,'id','8')->row();
		$data['content'] = $this->load->view('frontend/dashboard/profile',$data,true);
		$this->load->view('frontend/index',$data);
	}

	function editprofile(){
		$data=array(
			'nama_depan'=>$this->input->post('nama_depan'),
			'nama_belakang'=>$this->input->post('nama_belakang'),
			'tgl_lahir' => $this->input->post('tgl_lahir'),
			'email'=>$this->input->post('email'),
			'date_modified'=>date('Y-m-d H:i:s',now()),
			);
		$query=$this->model_basic->update($this->tbl_customer,$data,'id',$this->session->userdata('id'));
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

		$data['order'] = $this->model_basic->select_where($this->tbl_order, 'customer_id', $this->session->userdata('id'))->result();

		foreach ($data['order'] as $d_row) {
			$d_row->date_created = "Tanggal : ".date('d M Y', strtotime($d_row->date_created)).'</br>Jam : '.date('H:i', strtotime($d_row->date_created));
			$d_row->total_ship_price = indonesian_currency($d_row->total_ship_price);
			$d_row->total_payment = indonesian_currency($d_row->total_payment);
		}

		$data += $this->get_function('User Order','User');
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
		$data['user'] = $this->model_basic->select_where('px_customer','id',$this->session->userdata('id'))->row();
		$data['user']->password = $this->encrypt->decode($data['user']->password);
		$data['address']= $this->model_basic->select_where($this->tbl_static_content,'id','6')->row();
		$data['phone']= $this->model_basic->select_where($this->tbl_static_content,'id','7')->row();
		$data['fax']= $this->model_basic->select_where($this->tbl_static_content,'id','8')->row();
		$data['content'] = $this->load->view('frontend/dashboard/changepassword',$data,true);
		$this->load->view('frontend/index',$data);
	}

	public function address(){
		$data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('User Address Shipping','User');
		$data['user'] = $this->model_basic->select_where('px_customer','id',$this->session->userdata('id'))->row();
		$data['useraddress'] = $this->model_basic->select_where('px_customer_billing_address','customer_id',$this->session->userdata('id'))->row();
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
		$query=$this->model_basic->update($this->tbl_customer_billing_address,$data,'customer_id',$this->session->userdata('id'));
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

	public function kabupaten($id){
		$kabupaten=$this->model_basic->select_where($this->tbl_shipping_city,'id_province',$id)->result();
		$data="<option value=''>Pilih Kota</option>";
		foreach ($kabupaten as $key) {
			$data.="<option value='".$key->id."'>".$key->name."</option>";
		}
		echo json_encode($data);
	}

	public function region($id){
		$kabupaten=$this->model_basic->select_where($this->tbl_shipping_region,'id_city',$id)->result();
		$data="<option value=''>Pilih Kecamatan</option>";
		foreach ($kabupaten as $key) {
			$data.="<option value='".$key->id."'>".$key->name."</option>";
		}
		echo json_encode($data);
	}
}