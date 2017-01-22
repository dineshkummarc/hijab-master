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
				'password'=> $this->encrypt->encode($this->input->post('password')),
				'date_created' => date('Y-m-d h:i:s', now()),
				'date_modified' => date('Y-m-d h:i:s', now())
			);
		$this->session->set_flashdata($data);
		$this->db->where('email', $this->input->post('email'));
		$query = $this->db->get('px_customer');
		if ($query->num_rows() == 1) {
			$this->session->set_flashdata('notif', 'Email yang anda masukan sudah terdaftar di sistem Kami');
			redirect('login');
		}else{
			if ($this->input->post('password') != $this->input->post('cpassword')) {
				$this->session->set_flashdata('notif','Password yang anda masukan tidak sama');
				redirect('login');
			}else{
				$insert = $this->db->insert('px_customer', $data);
				
				if ($insert) {
					$row=$this->model_basic->select_where($this->tbl_customer,'email',$this->input->post('email'))->row();
					$data = array(
						'id' => $row->id,
						'email' => $row->email,
						'nama_depan' => $row->nama_depan,
						'nama_belakang' => $row->nama_belakang,
						'validated' => true
					);
					$this->session->set_userdata('member', $data);
					redirect('dashboard');
				}else{
					echo "Failed";
				}
			}
		}
	}
}