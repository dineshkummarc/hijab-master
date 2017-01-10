<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of product
 *
 * @author Edo
 */


class product extends PX_Controller {
    function __construct() {
        parent:: __construct();
        $this->controller_attr = array('controller' => 'product', 'controller_name' => 'Product', 'controller_id' => 0);
        $this->check_login();
    }
    function get_product($id) {
        $get_product = $this->model_basic->select_where($this->tbl_product, 'id', $id)->result();
        $get_product[0]->stock = $this->model_stock->sum_stock($id)->row()->stock;
        echo json_encode($get_product);
    }

    function get_product_image($id) {
        $get_product = $this->model_basic->select_where_double($this->tbl_product_image, 'product_id', $id, 'primary_status', '1')->result();
        if(!$get_product){
            $get_product = $this->model_basic->select_where($this->tbl_product_image, 'product_id', $id)->result();
        }
        echo json_encode($get_product);
    }

    function get_product_image_all($id) {
        $get_product = $this->model_basic->select_where($this->tbl_product_image, 'product_id', $id)->result();
        echo json_encode($get_product);
    }

    function get_product_color($id) {
        // $get_product = $this->model_basic->select_where($this->tbl_product,'id', $id)->row();
        $get_product = $this->model_basic->select_where_order($this->tbl_product_stock, 'product_id', $id, 'color_id', 'ASC')->result();

        if ($get_product) {
            $color = '';
            $i = 0;
            foreach ($get_product as $d_stock) {

                $get_color = $this->model_basic->select_where($this->tbl_color, 'id', $d_stock->color_id)->row()->name;
                if ($get_color) {
                    if ($get_color != $color) {
                        $color_result[$i] = new stdClass();
                        $color_result[$i]->color_id = $d_stock->color_id;
                        $color_result[$i]->color_name = $get_color;
                        $color = $get_color;
                        $i++;
                    }
                }
            }
        }
        echo json_encode($color_result);
    }

    function get_product_size($id, $color_id) {
        // $get_product = $this->model_basic->select_where($this->tbl_product,'id', $id)->row();
        $get_product = $this->model_basic->select_where_double_order($this->tbl_product_stock, 'product_id', $id, 'color_id', $color_id, 'size_id', 'ASC')->result();

        if ($get_product) {
            $size = '';
            $i = 0;
            foreach ($get_product as $d_stock) {

                $get_color = $this->model_basic->select_where($this->tbl_size, 'id', $d_stock->size_id)->row()->name;
                if ($get_color) {
                    if ($get_color != $size) {
                        $color_result[$i] = new stdClass();
                        $color_result[$i]->color_id = $d_stock->color_id;
                        $color_result[$i]->color_name = $get_color;
                        $color = $get_color;
                        $i++;
                    }
                }
            }
        }
        echo json_encode($color_result);
    }
    
    function addToWishList($product_id){
//         $data = $this->get_app_settings();
//         $data += $this->controller_attr;
//         $data += $this->get_function('Shop','shop');
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
             $response = "Delete from wishlist success";
         }
         else{
            $this->model_basic->insert_all($this->tbl_wishlist, $select);
            $response = "Add to wishlist success";
         }
         echo json_encode(array('status'=> TRUE, 'response'=>$response));
//         $data['address']= $this->model_basic->select_where($this->tbl_static_content,'id','6')->row();
//         $data['phone']= $this->model_basic->select_where($this->tbl_static_content,'id','7')->row();
//         $data['fax']= $this->model_basic->select_where($this->tbl_static_content,'id','8')->row();
//         $data['product'] = $this->model_basic->select_all($this->tbl_product);
//         foreach ($data['product'] as $d_row) {
//             $d_row->price = indonesian_currency($d_row->price);
//             $d_row->image = $this->model_basic->select_where_double($this->tbl_product_image, 'product_id', $d_row->id, 'primary_status', '1')->row();
//         };
//         $data['content'] = $this->load->view('frontend/shop/index',$data,true);
//         $this->load->view('frontend/index',$data);

     }
}
