<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends PX_Controller{
	function __construct(){
		parent::__construct();

		$this->controller_attr = array('controller' => 'login','controller_name' => 'Login');
                $this->do_underconstruct();
    $this->load->library('facebook');
    $this->load->library('googleplus');
	}

	public function index(){
    $data = $this->get_app_settings();
		$data += $this->controller_attr;
		$data += $this->get_function('Login','login');
    $data['address']= $this->model_basic->select_where($this->tbl_static_content,'id','6')->row();
    $data['phone']= $this->model_basic->select_where($this->tbl_static_content,'id','7')->row();
    $data['fax']= $this->model_basic->select_where($this->tbl_static_content,'id','8')->row();
    $data['login_url'] = $this->facebook->getLoginUrl(array(
                'redirect_uri' => site_url('login/login_fb'), 
                 'scope'         => 'email, user_birthday, user_location, user_work_history, user_hometown, user_photos,'
            ));
    $data['login_google'] = $this->googleplus->loginURL();
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
                'validated' => TRUE
              );
      				$this->session->set_userdata('member', $data);
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

  function login_fb(){
     $user = $this->facebook->getUser();
        if ($user) {
            try {
                $user_profile = $this->facebook->api('/me/?fields=name,email,gender');
            } catch (FacebookApiException $e) {
                $user = null;
            }
        }else {
          die();
        }
        if ($user) {
          if($user_profile['email']==''){
            $this->session->set_flashdata('msg','Maaf email facebook anda di rahasiakan, silahkan login dengan cara biasa.');
              redirect('login');
        }
          $this->db->where('email', $user_profile['email']);
          $query = $this->db->get($this->tbl_customer);
          if($query->num_rows() == 1)
    {
      $row = $query->row();
      $data = array(
                    'id' => $row->id,
                    'email' => $row->email,
                    'password' => $row->password,
                    'nama_depan'=>$row->nama_depan,
                    'nama_belakang'=>$row->nama_belakang,
                    'phone'=>$row->phone,
                    'validated' => true
                    );

           $this->session->set_userdata('member',$data);
         }else{
        $data_new = array(
        'nama_depan' => $user_profile['name'],
        'email' => $user_profile['email'],
        'date_created' => date('Y-m-d h:i:s', now()),
      );
      $insert = $this->db->insert($this->tbl_customer, $data_new);
      $this->db->where('email', $user_profile['email']);
          $query = $this->db->get($this->tbl_customer);
          $row = $query->row();
      $data = array(
                    'id' => $row->id,
                    'email' => $row->email,
                    'nama_depan'=>$row->nama_depan,
                    'nama_belakang'=>$row->nama_belakang,
                    'validated' => true
                    );

           $this->session->set_userdata('member',$data);
         }
         
             redirect('dashboard');

        }else{
          redirect('login');
        }
   
  }
     public function login_google(){
            if (isset($_GET['code'])) {
      
      $this->googleplus->getAuthenticate();
     $user_profile=$this->googleplus->getUserInfo();
          $this->db->where('email', $user_profile['email']);
          $query = $this->db->get($this->tbl_customer);
          if($query->num_rows() == 1)
    {
      $row = $query->row();
      $data = array(
         'id' => $row->id,
                    'email' => $row->email,
                    'password' => $row->password,
                    'nama_depan'=>$row->nama_depan,
                    'nama_belakang'=>$row->nama_belakang,
                    'validated' => true
                    );

           $this->session->set_userdata('member',$data);
         }else{
        $data_new = array(
        'nama_depan' => $user_profile['name'],
        'email' => $user_profile['email'],
        'date_created' => date('Y-m-d h:i:s', now()),
      );
      $insert = $this->db->insert($this->tbl_customer, $data_new);
      $this->db->where('email', $user_profile['email']);
          $query = $this->db->get($this->tbl_customer);
          $row = $query->row();
      $data = array(
          'id' => $row->id,
                    'email' => $row->email,
                    'password' => $row->password,
                    'nama_depan'=>$row->nama_depan,
                    'nama_belakang'=>$row->nama_belakang,
                    'validated' => true
                    );

           $this->session->set_userdata('member',$data);
         }redirect('dashboard');
    } 
   
  }

	function logout(){
    $this->load->library('facebook');
    //$this->load->library('googleplus');
    //$this->googleplus->revokeToken();
    // Logs off session from website
    //$this->facebook->destroySession();
    $this->session->unset_userdata('member');
    // Make sure you destory website session as well.

    redirect('login');
	}
}