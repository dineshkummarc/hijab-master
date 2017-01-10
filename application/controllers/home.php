<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends PX_Controller {

    public function __construct() {
        parent::__construct();

        $this->controller_attr = array('controller' => 'home', 'controller_name' => 'Home', 'controller_id' => 0);
        $this->do_underconstruct();
        $this->load->model('model_product');
    }

    function index() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Home', 'home');
        $data['banner'] = $this->model_basic->select_all($this->tbl_banner);
        $data['r_product'] = $this->model_basic->select_all($this->tbl_group);
        $f_product = $this->model_basic->select_all($this->tbl_group);
        foreach ($f_product as $key) {
            $product = $this->model_product->group_product_random($key->id)->result();
            $key->product = $product;
            foreach ($product as $product) {
                $image = $this->model_basic->select_where_double($this->tbl_product_image, 'product_id', $product->id, 'primary_status', '1');
                if ($image->num_rows() > 0) {
                    $product->image = $image->row()->photo;
                } else {
                    $image = $this->model_basic->select_where($this->tbl_product_image, 'product_id', $product->id);
                    if ($image->num_rows() > 0) {
                        $product->image = $image->row()->photo;
                    } else {
                        $product->image = "";
                    }
                }
            }
        }

        $data['f_product'] = $f_product;
        $data['address'] = $this->model_basic->select_where($this->tbl_static_content, 'id', '6')->row();
        $data['phone'] = $this->model_basic->select_where($this->tbl_static_content, 'id', '7')->row();
        $data['fax'] = $this->model_basic->select_where($this->tbl_static_content, 'id', '8')->row();
        $data['content'] = $this->load->view('frontend/home/index', $data, true);
        $this->load->view('frontend/index', $data);
    }

}
