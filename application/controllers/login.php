<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends PX_Controller{
	function __construct(){
		parent::__construct();

		$this->controller_attr = array('controller' => 'login','controller_name' => 'Login');
                $this->do_underconstruct();
	}

	public function index(){
    $data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('Login','login');
    $data['address']= $this->model_basic->select_where($this->tbl_static_content,'id','6')->row();
    $data['phone']= $this->model_basic->select_where($this->tbl_static_content,'id','7')->row();
    $data['fax']= $this->model_basic->select_where($this->tbl_static_content,'id','8')->row();
		$data['content'] = $this->load->view('frontend/login/index',$data,true);
		$this->load->view('frontend/index',$data);
	}

	function do_login(){
		$this->form_validation->set_rules('email', 'EMAIL', 'trim|required|valid_email');
    	$this->form_validation->set_rules('password', 'PASSWORD', 'trim|required');
    	if ($this->form_validation->run() == FALSE) {
      		$this->index();
      	}else{
      		$this->db->where('email', $this->input->post('email'));
      		$query = $this->db->get('px_customer');
      		if ($query->num_rows() == 1) {
      			$row = $query->row();
      			$pass = $this->encrypt->decode($row->password);
      			if ($pass == $this->input->post('password')) {
      				$data = array(
      					'id' => $row->id,
      					'email' => $row->email,
	                    'nama_depan'=>$row->nama_depan,
	                    'nama_belakang'=>$row->nama_belakang,
	                    'validated' => true
	                    );
      				$this->session->set_userdata($data);
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
                                'pict' => $d_cart['pict'],
                                'product_id'  => $d_cart['product_id'],
                                'size' => $d_cart['size'],
                                'color' => $d_cart['color'],
                                'n_size' => $d_cart['n_size'],
                                'n_color' => $d_cart['n_color']
                            );
                        }
                        $this->cart->insert($insert_data);
                    }
                 	redirect('dashboard');
      			}else{
      				$this->session->set_flashdata('msg','Password yang anda masukan salah');
                	$this->session->set_flashdata('email',$this->input->post('email'));

                    redirect('login');
      			}
      		}else{
      			$this->session->set_flashdata('msg','Email yang anda masukan belum terdaftar');
                $this->session->set_flashdata('email',$this->input->post('email'));
                redirect('login');
      		}
      	}
	}

	function logout(){
		$this->session->sess_destroy();
		redirect('login');
	}
}