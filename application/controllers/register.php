<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Register extends PX_Controller {
	function __construct() {
		parent::__construct();
		$this->controller_attr = array('controller' => 'register','controller_name' => 'Register');
		if($this->session->userdata('validated')){
	      redirect('dashboard');
	    }
            $this->do_underconstruct();
	}

	function do_register(){
		$data = array(
				'nama_depan' => $this->input->post('nama_depan'),
				'nama_belakang' => $this->input->post('nama_belakang'),
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
				'tgl_lahir' => $this->input->post('tgl_lahir'),
				'email' => $this->input->post('email'),
				'status_customer' => 1,
				'password'=> $this->encrypt->encode($this->input->post('password')),
				'date_created' => date('Y-m-d h:i:s', now()),
				'date_modified' => date('Y-m-d h:i:s', now())
			);

		$this->session->set_flashdata($data);
		$this->db->where('email', $this->input->post('email'));
		$query = $this->db->get('px_customer');
		if ($query->num_rows() == 1) {
			$this->session->set_flashdata('msg', 'Email anda sudah terdaftar di sistem Kami');
			redirect('login');
		}else{
			if ($this->input->post('password') != $this->input->post('cpassword')) {
				$this->session->set_flashdata('notif','Gagal');
				redirect('login');
			}else{
				$insert = $this->db->insert('px_customer', $data);
				if ($insert) {
					$row = $this->db->query("select * from px_customer where email='".$this->input->post('email')."'")->row();
					$data = array(
						'id' => $row->id,
						'email' => $row->email,
						'nama_depan' => $row->nama_depan,
						'nama_belakang' => $row->nama_belakang,
						'validated' => true
					);
					$this->session->set_userdata($data);
					$data_customer_address = array(
						'customer_id' => $row->id);
					$this->db->insert('px_customer_billing_address', $data_customer_address);
                    if($this->cart->contents()){
                        $get_cart = $this->cart->contents();
                        $this->cart->destroy();
                        foreach ($get_cart as $d_cart){
                            $insert_data = array(
                                'id' => $d_cart['id'],
                                'name' => $d_cart['name'],
                                'price' => $d_cart['price'],
                                'qty' => $d_cart['qty'],
                                'customer_id' => $this->session->userdata('id'),
                                'pict' => $d_cart['pict']
                            );
                        }
                        $this->cart->insert($insert_data);
                    }
					redirect('dashboard');
				}else{
					echo "Failed";
				}
			}
		}
	}
}