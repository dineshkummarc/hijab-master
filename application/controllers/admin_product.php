<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_product extends PX_Controller {

    function __construct() {
        parent:: __construct();
        $this->controller_attr = array('controller' => 'admin_product', 'controller_name' => 'Admin Product', 'controller_id' => 0);
        $this->check_login();
    }

    public function index() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Category','category');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_READ);
        $data['submenu'] = $this->get_submenu($data['controller']);
        $data['content'] = $this->load->view('backend/product/index',$data,true);
        $this->load->view('backend/index',$data);
    }

    public function category() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Category', 'category');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_READ);

        $data['category_list'] = $this->model_basic->select_all($this->tbl_category);
        $data['content'] = $this->load->view('backend/product/category_list', $data, true);
        $this->load->view('backend/index', $data);
    }

    public function category_form() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Category', 'category');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_CREATE);
        $id = $this->input->post('id');
        if ($id) {
            $data['data'] = $this->model_basic->select_where($this->tbl_category, 'id', $id)->row();
        } else
            $data['data'] = null;
        $data['content'] = $this->load->view('backend/product/category_form', $data, true);
        $this->load->view('backend/index', $data);
    }

    function category_add() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Category', 'category');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_CREATE);
        $table_field = $this->db->list_fields($this->tbl_category);
        $insert = array();
        foreach ($table_field as $field) {
            $insert[$field] = $this->input->post($field);
        }
        $insert['id_created'] = $this->session->userdata('admin')['admin_id'];
        $insert['id_modified'] = $this->session->userdata('admin')['admin_id'];
        $insert['date_created'] = date('Y-m-d H:i:s', now());
        $insert['date_modified'] = date('Y-m-d H:i:s', now());

        if ($this->input->post('name')) {
            $do_insert = $this->model_basic->insert_all($this->tbl_category, $insert);

            if ($do_insert) {
                $this->returnJson(array('status' => 'ok', 'msg' => 'Insert Data success', 'redirect' => $data['controller'] . '/' . $data['function']));
            } else {
                $this->returnJson(array('status' => 'error', 'msg' => 'Error'));
            }
        } else
            $this->returnJson(array('status' => 'error', 'msg' => 'Form jangan kosong'));
    }

    function category_edit() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Category', 'category');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_UPDATE);

        $table_field = $this->db->list_fields($this->tbl_category);
        $update = array();
        foreach ($table_field as $field) {
            $update[$field] = $this->input->post($field);
        }
        unset($update['date_created']);
        unset($update['id_created']);
        $update['id_modified'] = $this->session->userdata('admin')['admin_id'];
        $update['date_modified'] = date('Y-m-d H:i:s', now());

        $do_update = $this->model_basic->update($this->tbl_category, $update, 'id', $update['id']);

        if ($do_update) {
            $this->returnJson(array('status' => 'ok', 'msg' => 'Edit data success', 'redirect' => $data['controller'] . '/' . $data['function']));
        } else {
            $this->returnJson(array('status' => 'error', 'msg' => 'Error'));
        }
    }

    function category_delete() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Category', 'category');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_DELETE);
        $id = $this->input->post('id');
        $deleted_data = $this->model_basic->select_where($this->tbl_category, 'id', $id)->row();
        $do_delete = $this->model_basic->delete($this->tbl_category, 'id', $id);
        if ($do_delete) {
            $this->returnJson(array('status' => 'ok', 'msg' => 'Delete Success', 'redirect' => $data['controller'] . '/' . $data['function']));
        } else {
            $this->returnJson(array('status' => 'failed', 'msg' => 'Delete failed'));
        }
    }

    function category_image($id){
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Category Image', 'category_image');
        $data += $this->get_menu();
        //$this->check_userakses($data['function_id'], ACT_CREATE);
        $data['id'] = $id;
        $data['potrait'] = $this->model_basic->select_where($this->tbl_category,'id',$id)->row()->potrait_image;
        $data['landscape'] = $this->model_basic->select_where($this->tbl_category,'id',$id)->row()->landscape_image;
        $data['content'] = $this->load->view('backend/product/category_image',$data,true);
        $this->load->view('backend/index',$data);
    }

    function category_image_add($type, $id){
        // print_r($_POST);die();
        $data = $this->controller_attr;
        $data += $this->get_function('Category Image', 'category_image');
        //$menu = $this->get_menu_id($data['function']);$this->userakses($menu->id, 2);
        $img_name_crop = uniqid().'-hijab.jpg';
        if($this->input->post('image')) {
            $origw = $this->input->post('origwidth');
            $origh = $this->input->post('origheight');
            $fakew = $this->input->post('fakewidth');
            $fakeh = $this->input->post('fakeheight');
            $x = $this->input->post('x') * $origw / $fakew;
            $y = $this->input->post('y') * $origh / $fakeh;
            # ambil width crop
            $targ_w = $this->input->post('w') * $origw / $fakew;
            # ambil heigth crop
            $targ_h = $this->input->post('h') * $origh / $fakeh;
            # rasio gambar crop
            $jpeg_quality = 100;
            if(!is_dir(FCPATH . "assets/uploads/category/"))
                mkdir(FCPATH . "assets/uploads/category/");
            if(!is_dir(FCPATH . "assets/uploads/category/".$id))
                mkdir(FCPATH . "assets/uploads/category/".$id);
            if(basename($this->input->post('image')) && $this->input->post('image') != null){
                $src = $this->input->post('image');
            }
            # inisial handle copy gambar
            $ext = pathinfo($src, PATHINFO_EXTENSION);

            if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'JPG' || $ext == 'JPEG')
                $img_r = imagecreatefromjpeg($src);
            if($ext == 'png' || $ext == 'PNG')
                $img_r = imagecreatefrompng($src);
            if($ext == 'gif' || $ext == 'GIF')
                $img_r = imagecreatefromgif($src);

            $dst_r = ImageCreateTrueColor( $targ_w, $targ_h );
            # simpan hasil croping pada folder lain
            $path_img_crop = realpath(FCPATH . "assets/uploads/category/".$id);
            # nama gambar yg di crop
            # proses copy
            imagecopyresampled($dst_r,$img_r,0,0,$x,$y,$targ_w,$targ_h,$targ_w,$targ_h);
            # buat gambar
            imagejpeg($dst_r,$path_img_crop .'/'. $img_name_crop,$jpeg_quality);
            $this->makeThumbnails($path_img_crop.'/', $img_name_crop, 300, 453);
            $this->delete_temp('temp_folder');
            $insert = $this->db->where('id', $id)->update($this->tbl_category, array($type.'_image'=>$img_name_crop));
            if($insert)
                $this->returnJson(array('status' => 'ok','message' => 'Insert Success','redirect' => $data['controller'].'/'.$data['function'].'/'.$id));
            else
                $this->returnJson(array('status'=>'error','message'=>'Insert Failed'));
        }
        else
            $this->returnJson(array('status' => 'error','message' => 'Please Complete The Form'));
    }

    function category_image_get(){
        $id = $this->input->post('id');
        $data = $this->controller_attr;
        $data += $this->get_function('Category Image','category_image');
        $data_get = $this->model_basic->select_where($this->tbl_category,'id',$id)->row();
        if($data_get){
            $filename = $this->model_basic->select_where($this->tbl_category,'id',$id)->row()->potrait_image;
            $this->returnJson(array('status'=>'ok','data'=>$data_get, 'filename'=>$filename));
        }
        else{
            $this->returnJson(array('status'=>'error','message'=>'Data Not Found'));
        }
    }

    function category_image_edit($type, $id){
        $data = $this->controller_attr;
        $data += $this->get_function('Category Image','category_image');
        //$menu = $this->get_menu_id($data['function']);$this->userakses($menu->id, 3);
        $id = $this->input->post('id');
        $img_name_crop = uniqid().'-hijab.jpg';
        $foto = $this->input->post('image');
        $old_foto = $this->input->post('old_image');
        $data_update = array(
            'id' => $id
            );
        if($foto && (basename($foto) != $old_foto))
            $data_update['filename'] = $img_name_crop;
        else if($this->input->post('x') || $this->input->post('y') || $this->input->post('w') || $this->input->post('h'))
            $data_update['filename'] = $img_name_crop;

        if(!$this->db->where('id', $id)->update($this->tbl_category, array($type.'_image'=>$img_name_crop)))
        {
            $this->returnJson(array('status' => 'error', 'message' => 'Update Failed'));
        }
        else
        {
            if(($foto && (basename($foto) != $old_foto)) || ($this->input->post('x') || $this->input->post('y') || $this->input->post('w') || $this->input->post('h')))
            {
                $origw = $this->input->post('origwidth');
                $origh = $this->input->post('origheight');
                $fakew = $this->input->post('fakewidth');
                $fakeh = $this->input->post('fakeheight');
                $x = $this->input->post('x') * $origw / $fakew;
                $y = $this->input->post('y') * $origh / $fakeh;
                # ambil width crop
                $targ_w = $this->input->post('w') * $origw / $fakew;
                # abmil heigth crop
                $targ_h = $this->input->post('h') * $origh / $fakeh;
                # rasio gambar crop
                $jpeg_quality = 90;
                if(!is_dir(FCPATH . "assets/uploads/category/"))
                    mkdir(FCPATH . "assets/uploads/category/");
                if(!is_dir(FCPATH . "assets/uploads/category/".$id))
                    mkdir(FCPATH . "assets/uploads/category/".$id);
                if(basename($foto) && $foto != null){
                    $src = $this->input->post('image');
                }
                else if($this->input->post('x')||$this->input->post('y')||$this->input->post('w')||$this->input->post('h'))
                    $src = "assets/uploads/category/".$id.'/'.$old_foto;
                # inisial handle copy gambar
                $ext = pathinfo($src, PATHINFO_EXTENSION);

                if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'JPG' || $ext == 'JPEG')
                    $img_r = imagecreatefromjpeg($src);
                if($ext == 'png' || $ext == 'PNG')
                    $img_r = imagecreatefrompng($src);
                if($ext == 'gif' || $ext == 'GIF')
                    $img_r = imagecreatefromgif($src);

                $dst_r = ImageCreateTrueColor( $targ_w, $targ_h );
                # simpan hasil croping pada folder lain
                $path_img_crop = realpath(FCPATH . "assets/uploads/category/".$id);
                # nama gambar yg di crop
                # proses copy
                imagecopyresampled($dst_r,$img_r,0,0,$x,$y,$targ_w,$targ_h,$targ_w,$targ_h);
                # buat gambar
                imagejpeg($dst_r,$path_img_crop .'/'. $img_name_crop,$jpeg_quality);
                $this->makeThumbnails($path_img_crop.'/', $img_name_crop, 300, 454);
                @unlink(FCPATH."assets/uploads/category/".$id.'/'.$old_foto);
                $this->delete_temp('temp_folder');
            }
            $this->returnJson(array('status' => 'ok', 'message' => 'Update Success','redirect' => $this->controller_attr['controller'].'/'.$data['function'].'/'.$id));
        }
    }


    public function editor_picks() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Editor Picks', 'editor_picks');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_READ);

        $data['editor_picks_list'] = $this->model_basic->select_all($this->tbl_editor_picks);
        $data['content'] = $this->load->view('backend/product/editor_picks_list', $data, true);
        $this->load->view('backend/index', $data);
    }

    public function editor_picks_form() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Editor Picks', 'editor_picks');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_CREATE);
        $id = $this->input->post('id');
        if ($id) {
            $data['data'] = $this->model_basic->select_where($this->tbl_editor_picks, 'id', $id)->row();
        } else
            $data['data'] = null;
        $data['content'] = $this->load->view('backend/product/editor_picks_form', $data, true);
        $this->load->view('backend/index', $data);
    }

    function editor_picks_add() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Editor Picks', 'editor_picks');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_CREATE);
        $table_field = $this->db->list_fields($this->tbl_editor_picks);
        $insert = array();
        foreach ($table_field as $field) {
            $insert[$field] = $this->input->post($field);
        }

        if ($this->input->post('name')) {
            $do_insert = $this->model_basic->insert_all($this->tbl_editor_picks, $insert);

            if ($do_insert) {
                $this->returnJson(array('status' => 'ok', 'msg' => 'Insert Data success', 'redirect' => $data['controller'] . '/' . $data['function']));
            } else {
                $this->returnJson(array('status' => 'error', 'msg' => 'Error'));
            }
        } else
            $this->returnJson(array('status' => 'error', 'msg' => 'Form jangan kosong'));
    }

    function editor_picks_edit() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Editor Picks', 'editor_picks');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_UPDATE);

        $table_field = $this->db->list_fields($this->tbl_editor_picks);
        $update = array();
        foreach ($table_field as $field) {
            $update[$field] = $this->input->post($field);
        }

        $do_update = $this->model_basic->update($this->tbl_editor_picks, $update, 'id', $update['id']);

        if ($do_update) {
            $this->returnJson(array('status' => 'ok', 'msg' => 'Edit data success', 'redirect' => $data['controller'] . '/' . $data['function']));
        } else {
            $this->returnJson(array('status' => 'error', 'msg' => 'Error'));
        }
    }

    function editor_picks_delete() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Editor Picks', 'editor_picks');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_DELETE);
        $id = $this->input->post('id');
        $deleted_data = $this->model_basic->select_where($this->tbl_editor_picks, 'id', $id)->row();
        $do_delete = $this->model_basic->delete($this->tbl_editor_picks, 'id', $id);
        if ($do_delete) {
            $this->returnJson(array('status' => 'ok', 'msg' => 'Delete Success', 'redirect' => $data['controller'] . '/' . $data['function']));
        } else {
            $this->returnJson(array('status' => 'failed', 'msg' => 'Delete failed'));
        }
    }

    function editor_picks_image($id){
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Editor Picks Image', 'editor_picks_image');
        $data += $this->get_menu();
        //$this->check_userakses($data['function_id'], ACT_CREATE);
        $data['id'] = $id;
        $data['name'] = $this->model_basic->select_where($this->tbl_editor_picks,'id',$id)->row()->name;
        $data['image'] = $this->model_basic->select_where($this->tbl_editor_picks,'id',$id)->row()->image;
        $data['content'] = $this->load->view('backend/product/editor_picks_image',$data,true);
        $this->load->view('backend/index',$data);
    }

    function editor_picks_image_add(){
        $data = $this->controller_attr;
        $data += $this->get_function('Editor Picks Image', 'editor_picks_image');
        //$menu = $this->get_menu_id($data['function']);$this->userakses($menu->id, 2);
        $id = $this->input->post('editor_picksimage-id');
        $img_name_crop = uniqid().'-hijab.jpg';
        if($this->input->post('image')) {
            $origw = $this->input->post('origwidth');
            $origh = $this->input->post('origheight');
            $fakew = $this->input->post('fakewidth');
            $fakeh = $this->input->post('fakeheight');
            $x = $this->input->post('x') * $origw / $fakew;
            $y = $this->input->post('y') * $origh / $fakeh;
            # ambil width crop
            $targ_w = $this->input->post('w') * $origw / $fakew;
            # ambil heigth crop
            $targ_h = $this->input->post('h') * $origh / $fakeh;
            # rasio gambar crop
            $jpeg_quality = 100;
            if(!is_dir(FCPATH . "assets/uploads/editor_picks/"))
                mkdir(FCPATH . "assets/uploads/editor_picks/");
            if(!is_dir(FCPATH . "assets/uploads/editor_picks/".$id))
                mkdir(FCPATH . "assets/uploads/editor_picks/".$id);
            if(basename($this->input->post('image')) && $this->input->post('image') != null){
                $src = $this->input->post('image');
            }
            # inisial handle copy gambar
            $ext = pathinfo($src, PATHINFO_EXTENSION);

            if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'JPG' || $ext == 'JPEG')
                $img_r = imagecreatefromjpeg($src);
            if($ext == 'png' || $ext == 'PNG')
                $img_r = imagecreatefrompng($src);
            if($ext == 'gif' || $ext == 'GIF')
                $img_r = imagecreatefromgif($src);

            $dst_r = ImageCreateTrueColor( $targ_w, $targ_h );
            # simpan hasil croping pada folder lain
            $path_img_crop = realpath(FCPATH . "assets/uploads/editor_picks/".$id);
            # nama gambar yg di crop
            # proses copy
            imagecopyresampled($dst_r,$img_r,0,0,$x,$y,$targ_w,$targ_h,$targ_w,$targ_h);
            # buat gambar
            imagejpeg($dst_r,$path_img_crop .'/'. $img_name_crop,$jpeg_quality);
            $this->makeThumbnails($path_img_crop.'/', $img_name_crop, 300, 453);
            $this->delete_temp('temp_folder');
            $insert = $this->db->where('id', $id)->update($this->tbl_editor_picks, array('image'=>$img_name_crop));
            if($insert)
                $this->returnJson(array('status' => 'ok','message' => 'Insert Success','redirect' => $data['controller'].'/'.$data['function'].'/'.$id));
            else
                $this->returnJson(array('status'=>'error','message'=>'Insert Failed'));
        }
        else
            $this->returnJson(array('status' => 'error','message' => 'Please Complete The Form'));
    }

    function editor_picks_image_get(){
        $id = $this->input->post('id');
        $data = $this->controller_attr;
        $data += $this->get_function('Editor Picks Image','editor_picks_image');
        $data_get = $this->model_basic->select_where($this->tbl_editor_picks,'id',$id)->row();
        if($data_get){
            $this->returnJson(array('status'=>'ok','data'=>$data_get));
        }
        else{
            $this->returnJson(array('status'=>'error','message'=>'Data Not Found'));
        }
    }

    function editor_picks_image_edit(){
        $data = $this->controller_attr;
        $data += $this->get_function('Editor Picks Image','editor_picks_image');
        //$menu = $this->get_menu_id($data['function']);$this->userakses($menu->id, 3);
        $id = $this->input->post('editor_picksimage-id');
        $img_name_crop = uniqid().'-hijab.jpg';
        $foto = $this->input->post('image');
        $old_foto = $this->input->post('old_image');
        $data_update = array(
            'id' => $id
            );
        if($foto && (basename($foto) != $old_foto))
            $data_update['filename'] = $img_name_crop;
        else if($this->input->post('x') || $this->input->post('y') || $this->input->post('w') || $this->input->post('h'))
            $data_update['filename'] = $img_name_crop;

        if(!$this->db->where('id', $id)->update($this->tbl_editor_picks, array('image'=>$img_name_crop)))
        {
            $this->returnJson(array('status' => 'error', 'message' => 'Update Failed'));
        }
        else
        {
            if(($foto && (basename($foto) != $old_foto)) || ($this->input->post('x') || $this->input->post('y') || $this->input->post('w') || $this->input->post('h')))
            {
                $origw = $this->input->post('origwidth');
                $origh = $this->input->post('origheight');
                $fakew = $this->input->post('fakewidth');
                $fakeh = $this->input->post('fakeheight');
                $x = $this->input->post('x') * $origw / $fakew;
                $y = $this->input->post('y') * $origh / $fakeh;
                # ambil width crop
                $targ_w = $this->input->post('w') * $origw / $fakew;
                # abmil heigth crop
                $targ_h = $this->input->post('h') * $origh / $fakeh;
                # rasio gambar crop
                $jpeg_quality = 90;
                if(!is_dir(FCPATH . "assets/uploads/editor_picks/".$id))
                    mkdir(FCPATH . "assets/uploads/editor_picks/".$id);
                if(basename($foto) && $foto != null){
                    $src = $this->input->post('image');
                }
                else if($this->input->post('x')||$this->input->post('y')||$this->input->post('w')||$this->input->post('h'))
                    $src = "assets/uploads/editor_picks/".$id.'/'.$old_foto;
                # inisial handle copy gambar
                $ext = pathinfo($src, PATHINFO_EXTENSION);

                if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'JPG' || $ext == 'JPEG')
                    $img_r = imagecreatefromjpeg($src);
                if($ext == 'png' || $ext == 'PNG')
                    $img_r = imagecreatefrompng($src);
                if($ext == 'gif' || $ext == 'GIF')
                    $img_r = imagecreatefromgif($src);

                $dst_r = ImageCreateTrueColor( $targ_w, $targ_h );
                # simpan hasil croping pada folder lain
                $path_img_crop = realpath(FCPATH . "assets/uploads/editor_picks/".$id);
                # nama gambar yg di crop
                # proses copy
                imagecopyresampled($dst_r,$img_r,0,0,$x,$y,$targ_w,$targ_h,$targ_w,$targ_h);
                # buat gambar
                imagejpeg($dst_r,$path_img_crop .'/'. $img_name_crop,$jpeg_quality);
                $this->makeThumbnails($path_img_crop.'/', $img_name_crop, 300, 454);
                @unlink(FCPATH."assets/uploads/category/".$id.'/'.$old_foto);
                $this->delete_temp('temp_folder');
            }
            $this->returnJson(array('status' => 'ok', 'message' => 'Update Success','redirect' => $this->controller_attr['controller'].'/'.$data['function'].'/'.$id));
        }
    }

    public function color() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Color', 'color');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_READ);

        $data['color_list'] = $this->model_basic->select_all($this->tbl_color);
        $data['content'] = $this->load->view('backend/product/color_list', $data, true);
        $this->load->view('backend/index', $data);
    }

    public function color_form() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Color', 'color');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_CREATE);
        $id = $this->input->post('id');
        if ($id) {
            $data['data'] = $this->model_basic->select_where($this->tbl_color, 'id', $id)->row();
        } else
            $data['data'] = null;
        $data['content'] = $this->load->view('backend/product/color_form', $data, true);
        $this->load->view('backend/index', $data);
    }

    function color_add() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Color', 'color');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_CREATE);
        $table_field = $this->db->list_fields($this->tbl_color);
        $insert = array();
        foreach ($table_field as $field) {
            $insert[$field] = $this->input->post($field);
        }
        $insert['id_created'] = $this->session->userdata('admin')['admin_id'];
        $insert['id_modified'] = $this->session->userdata('admin')['admin_id'];
        $insert['date_created'] = date('Y-m-d H:i:s', now());
        $insert['date_modified'] = date('Y-m-d H:i:s', now());

        if ($this->input->post('name')) {
            $do_insert = $this->model_basic->insert_all($this->tbl_color, $insert);

            if ($do_insert) {
                $this->returnJson(array('status' => 'ok', 'msg' => 'Insert Data success', 'redirect' => $data['controller'] . '/' . $data['function']));
            } else {
                $this->returnJson(array('status' => 'error', 'msg' => 'Error'));
            }
        } else
            $this->returnJson(array('status' => 'error', 'msg' => 'Form jangan kosong'));
    }

    function color_edit() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Color', 'color');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_UPDATE);

        $table_field = $this->db->list_fields($this->tbl_color);
        $update = array();
        foreach ($table_field as $field) {
            $update[$field] = $this->input->post($field);
        }
        unset($update['date_created']);
        unset($update['id_created']);
        $update['id_modified'] = $this->session->userdata('admin')['admin_id'];
        $update['date_modified'] = date('Y-m-d H:i:s', now());

        $do_update = $this->model_basic->update($this->tbl_color, $update, 'id', $update['id']);

        if ($do_update) {
            $this->returnJson(array('status' => 'ok', 'msg' => 'Edit data success', 'redirect' => $data['controller'] . '/' . $data['function']));
        } else {
            $this->returnJson(array('status' => 'error', 'msg' => 'Error'));
        }
    }

    function color_delete() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Color', 'color');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_DELETE);
        $id = $this->input->post('id');
        $deleted_data = $this->model_basic->select_where($this->tbl_color, 'id', $id)->row();
        $do_delete = $this->model_basic->delete($this->tbl_color, 'id', $id);
        if ($do_delete) {
            $this->returnJson(array('status' => 'ok', 'msg' => 'Delete Success', 'redirect' => $data['controller'] . '/' . $data['function']));
        } else {
            $this->returnJson(array('status' => 'failed', 'msg' => 'Delete failed'));
        }
    }

    public function size() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Size', 'size');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_READ);

        $data['size_list'] = $this->model_basic->select_all($this->tbl_size);
        $data['content'] = $this->load->view('backend/product/size_list', $data, true);
        $this->load->view('backend/index', $data);
    }

    public function size_form() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Size', 'size');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_CREATE);
        $id = $this->input->post('id');
        if ($id) {
            $data['data'] = $this->model_basic->select_where($this->tbl_size, 'id', $id)->row();
        } else
            $data['data'] = null;
        $data['content'] = $this->load->view('backend/product/size_form', $data, true);
        $this->load->view('backend/index', $data);
    }

    function size_add() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Size', 'size');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_CREATE);
        $table_field = $this->db->list_fields($this->tbl_size);
        $insert = array();
        foreach ($table_field as $field) {
            $insert[$field] = $this->input->post($field);
        }
        $insert['id_created'] = $this->session->userdata('admin')['admin_id'];
        $insert['id_modified'] = $this->session->userdata('admin')['admin_id'];
        $insert['date_created'] = date('Y-m-d H:i:s', now());
        $insert['date_modified'] = date('Y-m-d H:i:s', now());

        if ($this->input->post('name')) {
            $do_insert = $this->model_basic->insert_all($this->tbl_size, $insert);

            if ($do_insert) {
                $this->returnJson(array('status' => 'ok', 'msg' => 'Insert Data success', 'redirect' => $data['controller'] . '/' . $data['function']));
            } else {
                $this->returnJson(array('status' => 'error', 'msg' => 'Error'));
            }
        } else
            $this->returnJson(array('status' => 'error', 'msg' => 'Form jangan kosong'));
    }

    function size_edit() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Size', 'size');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_UPDATE);

        $table_field = $this->db->list_fields($this->tbl_size);
        $update = array();
        foreach ($table_field as $field) {
            $update[$field] = $this->input->post($field);
        }
        unset($update['date_created']);
        unset($update['id_created']);
        $update['id_modified'] = $this->session->userdata('admin')['admin_id'];
        $update['date_modified'] = date('Y-m-d H:i:s', now());

        $do_update = $this->model_basic->update($this->tbl_size, $update, 'id', $update['id']);

        if ($do_update) {
            $this->returnJson(array('status' => 'ok', 'msg' => 'Edit data success', 'redirect' => $data['controller'] . '/' . $data['function']));
        } else {
            $this->returnJson(array('status' => 'error', 'msg' => 'Error'));
        }
    }

    function size_delete() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Size', 'size');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_DELETE);
        $id = $this->input->post('id');
        $deleted_data = $this->model_basic->select_where($this->tbl_size, 'id', $id)->row();
        $do_delete = $this->model_basic->delete($this->tbl_size, 'id', $id);
        if ($do_delete) {
            $this->returnJson(array('status' => 'ok', 'msg' => 'Delete Success', 'redirect' => $data['controller'] . '/' . $data['function']));
        } else {
            $this->returnJson(array('status' => 'failed', 'msg' => 'Delete failed'));
        }
    }

    public function brand() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Brand', 'brand');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_READ);

        $data['brand_list'] = $this->model_basic->select_all($this->tbl_brand);
        $data['content'] = $this->load->view('backend/product/brand_list', $data, true);
        $this->load->view('backend/index', $data);
    }

    public function brand_form() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Brand', 'brand');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_CREATE);
        $id = $this->input->post('id');
        if ($id) {
            $data['data'] = $this->model_basic->select_where($this->tbl_brand, 'id', $id)->row();
        } else
            $data['data'] = null;
        $data['content'] = $this->load->view('backend/product/brand_form', $data, true);
        $this->load->view('backend/index', $data);
    }

    function brand_add() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Brand', 'brand');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_CREATE);
        $table_field = $this->db->list_fields($this->tbl_brand);
        // $img_name_crop = uniqid() . '-brand.jpg';
        $insert = array();
        foreach ($table_field as $field) {
            $insert[$field] = $this->input->post($field);
        }
        $insert['url'] = str_replace(' ', '', $this->input->post('name'));
        // $insert['photo'] = $img_name_crop;
        $insert['id_created'] = $this->session->userdata('admin')['admin_id'];
        $insert['id_modified'] = $this->session->userdata('admin')['admin_id'];
        $insert['date_created'] = date('Y-m-d H:i:s', now());
        $insert['date_modified'] = date('Y-m-d H:i:s', now());

        if ($insert['name'] && $insert['diskon'] && $insert['description']) {
            $do_insert = $this->model_basic->insert_all($this->tbl_brand, $insert);
            if ($do_insert) {
                // if ($this->input->post('photo')) {
                //     if (!is_dir(FCPATH . 'assets/uploads/brand/' . $do_insert->id))
                //         mkdir(FCPATH . 'assets/uploads/brand/' . $do_insert->id);
                //     if (basename($this->input->post('photo')) && $this->input->post('photo') != null) {
                //         $src = $this->input->post('photo');
                //     }
                //     copy($src, 'assets/uploads/brand/' . $do_insert->id . '/' . $img_name_crop);
                //     $this->makeThumbnails('assets/uploads/brand/' . $do_insert->id . '/', $img_name_crop, 500, 300);
                //     $this->delete_temp('temp_folder');
                //     $this->returnJson(array('status' => 'ok', 'msg' => 'Input data success', 'redirect' => $data['controller'] . '/' . $data['function']));
                // } else {
                //     $this->returnJson(array('status' => 'ok', 'msg' => 'Input data success', 'redirect' => $data['controller'] . '/' . $data['function']));
                // }
            } else
                $this->returnJson(array('status' => 'error', 'msg' => 'Form jangan Kosong'));
        }
    }

    function brand_edit() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Brand', 'brand');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_UPDATE);

        // $img_name_crop = uniqid() . '-brand.jpg';
        // $foto = $this->input->post('photo');
        // $old_foto = $this->input->post('old_photo');
        $table_field = $this->db->list_fields($this->tbl_brand);
        $update = array();
        foreach ($table_field as $field) {
            $update[$field] = $this->input->post($field);
        }
        $update['url'] = str_replace(' ', '', $this->input->post('name'));
        unset($update['date_created']);
        unset($update['id_created']);
        $update['date_modified'] = date('Y-m-d H:i:s', now());
        $update['id_modified'] = $this->session_admin['admin_id'];
        // if (($foto && (basename($foto) != $old_foto)))
        //     $update['photo'] = $img_name_crop;
        // else
        //     $update['photo'] = $this->input->post('old_photo');

        if ($update['name'] && $update['diskon'] && $update['description']) {
            $do_update = $this->model_basic->update($this->tbl_brand, $update, 'id', $update['id']);
            if ($do_update) {
                // if (($foto && (basename($foto) != $old_foto))) {
                //     if (!is_dir(FCPATH . 'assets/uploads/brand/' . $update['id']))
                //         mkdir(FCPATH . 'assets/uploads/brand/' . $update['id']);
                //     if (basename($this->input->post('photo')) && $this->input->post('photo') != null) {
                //         $src = $this->input->post('photo');
                //     }
                //     if (copy($src, 'assets/uploads/brand/' . $update['id'] . '/' . $img_name_crop)) {
                //         $this->makeThumbnails('assets/uploads/brand/' . $update['id'] . '/', $img_name_crop, 500, 300);
                //         @unlink('assets/uploads/brand/' . $update['id'] . '/' . $this->input->post('old_photo'));
                //         @unlink('assets/uploads/brand/' . $update['id'] . '/thumb' . $this->input->post('old_photo'));
                //         $this->delete_temp('temp_folder');
                //     } else {
                //         $this->delete_folder('brand/' . $update['id']);
                //         $this->returnJson(array('status' => 'error', 'msg' => 'Upload Falied'));
                //     }
                // }
                $this->returnJson(array('status' => 'ok', 'msg' => 'Update success', 'redirect' => $data['controller'] . '/' . $data['function']));
            } else
                $this->returnJson(array('status' => 'error', 'msg' => 'Failed when updating data'));
        } else
            $this->returnJson(array('status' => 'error', 'msg' => 'Please complete the form'));
    }

    function brandedit() {
        $id = $this->input->post('id');
        $brand = $this->model_basic->select_where($this->tbl_brand, 'id', $id)->row();
        if ($brand) {
            if ($brand->promo_status == 0)
                $change_status = 1;
            else
                $change_status = 0;
            $update = array('promo_status' => $change_status);
            if (!$this->model_basic->update($this->tbl_brand, $update, 'id', $id))
                $this->returnJson(array('status' => 'failed', 'msg' => 'Update Status Failed'));
            else
                $this->returnJson(array('status' => 'ok', 'promo_status' => $change_status, 'id' => $id));
        }
        else {
            $this->returnJson(array('status' => 'failed', 'msg' => 'Update Status Failed'));
        }
    }

    function brand_delete() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Brand', 'brand');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_DELETE);
        $id = $this->input->post('id');
        $deleted_data = $this->model_basic->select_where($this->tbl_brand, 'id', $id)->row();
        $do_delete = $this->model_basic->delete($this->tbl_brand, 'id', $id);
        if ($do_delete) {
            $this->delete_folder('brand/' . $id);
            $this->returnJson(array('status' => 'ok', 'msg' => 'Delete Success', 'redirect' => $data['controller'] . '/' . $data['function']));
        } else {
            $this->returnJson(array('status' => 'failed', 'msg' => 'Delete failed'));
        }
    }

    function brand_image($id){
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Brand Image', 'brand_image');
        $data += $this->get_menu();
        //$this->check_userakses($data['function_id'], ACT_CREATE);
        $data['id'] = $id;
        $data['name'] = $this->model_basic->select_where($this->tbl_brand,'id',$id)->row()->name;
        $data['image'] = $this->model_basic->select_where($this->tbl_brand,'id',$id)->row()->photo;
        $data['content'] = $this->load->view('backend/product/brand_image',$data,true);
        $this->load->view('backend/index',$data);
    }

    function brand_image_add(){
        $data = $this->controller_attr;
        $data += $this->get_function('Brand Image', 'brand_image');
        //$menu = $this->get_menu_id($data['function']);$this->userakses($menu->id, 2);
        $id = $this->input->post('brandimage-id');
        $img_name_crop = uniqid().'-hijab.jpg';
        if($this->input->post('image')) {
            $origw = $this->input->post('origwidth');
            $origh = $this->input->post('origheight');
            $fakew = $this->input->post('fakewidth');
            $fakeh = $this->input->post('fakeheight');
            $x = $this->input->post('x') * $origw / $fakew;
            $y = $this->input->post('y') * $origh / $fakeh;
            # ambil width crop
            $targ_w = $this->input->post('w') * $origw / $fakew;
            # ambil heigth crop
            $targ_h = $this->input->post('h') * $origh / $fakeh;
            # rasio gambar crop
            $jpeg_quality = 100;
            if(!is_dir(FCPATH . "assets/uploads/brand/"))
                mkdir(FCPATH . "assets/uploads/brand/");
            if(!is_dir(FCPATH . "assets/uploads/brand/".$id))
                mkdir(FCPATH . "assets/uploads/brand/".$id);
            if(basename($this->input->post('image')) && $this->input->post('image') != null){
                $src = $this->input->post('image');
            }
            # inisial handle copy gambar
            $ext = pathinfo($src, PATHINFO_EXTENSION);

            if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'JPG' || $ext == 'JPEG')
                $img_r = imagecreatefromjpeg($src);
            if($ext == 'png' || $ext == 'PNG')
                $img_r = imagecreatefrompng($src);
            if($ext == 'gif' || $ext == 'GIF')
                $img_r = imagecreatefromgif($src);

            $dst_r = ImageCreateTrueColor( $targ_w, $targ_h );
            # simpan hasil croping pada folder lain
            $path_img_crop = realpath(FCPATH . "assets/uploads/brand/".$id);
            # nama gambar yg di crop
            # proses copy
            imagecopyresampled($dst_r,$img_r,0,0,$x,$y,$targ_w,$targ_h,$targ_w,$targ_h);
            # buat gambar
            imagejpeg($dst_r,$path_img_crop .'/'. $img_name_crop,$jpeg_quality);
            $this->makeThumbnails($path_img_crop.'/', $img_name_crop, 300, 453);
            $this->delete_temp('temp_folder');
            $insert = $this->db->where('id', $id)->update($this->tbl_brand, array('image'=>$img_name_crop));
            if($insert)
                $this->returnJson(array('status' => 'ok','message' => 'Insert Success','redirect' => $data['controller'].'/'.$data['function'].'/'.$id));
            else
                $this->returnJson(array('status'=>'error','message'=>'Insert Failed'));
        }
        else
            $this->returnJson(array('status' => 'error','message' => 'Please Complete The Form'));
    }

    function brand_image_get(){
        $id = $this->input->post('id');
        $data = $this->controller_attr;
        $data += $this->get_function('Brand Image','brand_image');
        $data_get = $this->model_basic->select_where($this->tbl_brand,'id',$id)->row();
        if($data_get){
            $this->returnJson(array('status'=>'ok','data'=>$data_get));
        }
        else{
            $this->returnJson(array('status'=>'error','message'=>'Data Not Found'));
        }
    }

    function brand_image_edit(){
        $data = $this->controller_attr;
        $data += $this->get_function('Brand Image','brand_image');
        //$menu = $this->get_menu_id($data['function']);$this->userakses($menu->id, 3);
        $id = $this->input->post('brandimage-id');
        $img_name_crop = uniqid().'-hijab.jpg';
        $foto = $this->input->post('image');
        $old_foto = $this->input->post('old_image');
        $data_update = array(
            'id' => $id
            );
        if($foto && (basename($foto) != $old_foto))
            $data_update['filename'] = $img_name_crop;
        else if($this->input->post('x') || $this->input->post('y') || $this->input->post('w') || $this->input->post('h'))
            $data_update['filename'] = $img_name_crop;

        if(!$this->db->where('id', $id)->update($this->tbl_brand, array('photo'=>$img_name_crop)))
        {
            $this->returnJson(array('status' => 'error', 'message' => 'Update Failed'));
        }
        else
        {
            if(($foto && (basename($foto) != $old_foto)) || ($this->input->post('x') || $this->input->post('y') || $this->input->post('w') || $this->input->post('h')))
            {
                $origw = $this->input->post('origwidth');
                $origh = $this->input->post('origheight');
                $fakew = $this->input->post('fakewidth');
                $fakeh = $this->input->post('fakeheight');
                $x = $this->input->post('x') * $origw / $fakew;
                $y = $this->input->post('y') * $origh / $fakeh;
                # ambil width crop
                $targ_w = $this->input->post('w') * $origw / $fakew;
                # abmil heigth crop
                $targ_h = $this->input->post('h') * $origh / $fakeh;
                # rasio gambar crop
                $jpeg_quality = 90;
                if(!is_dir(FCPATH . "assets/uploads/brand/".$id))
                    mkdir(FCPATH . "assets/uploads/brand/".$id);
                if(basename($foto) && $foto != null){
                    $src = $this->input->post('image');
                }
                else if($this->input->post('x')||$this->input->post('y')||$this->input->post('w')||$this->input->post('h'))
                    $src = "assets/uploads/brand/".$id.'/'.$old_foto;
                # inisial handle copy gambar
                $ext = pathinfo($src, PATHINFO_EXTENSION);

                if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'JPG' || $ext == 'JPEG')
                    $img_r = imagecreatefromjpeg($src);
                if($ext == 'png' || $ext == 'PNG')
                    $img_r = imagecreatefrompng($src);
                if($ext == 'gif' || $ext == 'GIF')
                    $img_r = imagecreatefromgif($src);

                $dst_r = ImageCreateTrueColor( $targ_w, $targ_h );
                # simpan hasil croping pada folder lain
                $path_img_crop = realpath(FCPATH . "assets/uploads/brand/".$id);
                # nama gambar yg di crop
                # proses copy
                imagecopyresampled($dst_r,$img_r,0,0,$x,$y,$targ_w,$targ_h,$targ_w,$targ_h);
                # buat gambar
                imagejpeg($dst_r,$path_img_crop .'/'. $img_name_crop,$jpeg_quality);
                $this->makeThumbnails($path_img_crop.'/', $img_name_crop, 300, 454);
                @unlink(FCPATH."assets/uploads/category/".$id.'/'.$old_foto);
                $this->delete_temp('temp_folder');
            }
            $this->returnJson(array('status' => 'ok', 'message' => 'Update Success','redirect' => $this->controller_attr['controller'].'/'.$data['function'].'/'.$id));
        }
    }


    public function image() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Image', 'image');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_READ);

        $data['product_list'] = $this->model_basic->select_all($this->tbl_product);
        $data['content'] = $this->load->view('backend/product/product_image_list', $data, true);
        $this->load->view('backend/index', $data);
    }

    public function album_image_product($id_album_image) {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Product Album Image', 'admin_product');

        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_READ);
        $data['id_album_image'] = $id_album_image;
        $data['data'] = $this->model_basic->select_where($this->tbl_product_image, 'product_id', $id_album_image)->result();
        foreach ($data['data'] as $d_row) {
            $d_row->product = $this->model_basic->select_where($this->tbl_product, 'id', $d_row->product_id)->row();
        }
        $data['content'] = $this->load->view('backend/product/product_album_image_list', $data, true);
        $this->load->view('backend/index', $data);
    }

    function image_get() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Product Album Image', 'admin_product');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_READ);
        $id = $this->input->post('id');
        $data['row'] = $this->model_basic->select_where($this->tbl_product_image, 'id', $id)->row();
        if (is_file('assets/uploads/product/' . $data['row']->product_id . '/' . $data['row']->photo)) {
            $data['row']->photo_file = 'assets/uploads/product/' . $data['row']->product_id . '/' . $data['row']->photo;
            $data['row']->photo_status = 'ok';
        } else
            $data['row']->photo_status = 'error';
        if ($data['row'])
            $this->returnJson(array('status' => 'ok', 'data' => $data));
        else
            $this->returnJson(array('status' => 'error', 'msg' => 'Data not found'));
    }

    public function image_form() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Image', 'image');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_CREATE);
        $id = $this->input->post('id');
        if ($id) {
            $data['data'] = $this->model_basic->select_where($this->tbl_product_image, 'id', $id)->row();
        } else
            $data['data'] = null;
        $data['product_list'] = $this->model_basic->select_all($this->tbl_product);
        $data['content'] = $this->load->view('backend/product/product_image_form', $data, true);
        $this->load->view('backend/index', $data);
    }

    function image_add() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Image', 'admin_product');
        $data += $this->get_menu();
        $img_name_crop = uniqid() . '-product.jpg';
        $this->check_userakses($data['function_id'], ACT_CREATE);
        $table_field = $this->db->list_fields($this->tbl_product_image);
        $insert = array();
        foreach ($table_field as $field) {
            $insert[$field] = $this->input->post($field);
        }
        $insert['photo'] = $img_name_crop;
        $insert['primary_status'] = 0;
        $insert['id_created'] = $this->session->userdata('admin')['admin_id'];
        $insert['id_modified'] = $this->session->userdata('admin')['admin_id'];
        $insert['date_created'] = date('Y-m-d H:i:s', now());
        $insert['date_modified'] = date('Y-m-d H:i:s', now());

        if ($insert['product_id']) {
            $do_insert = $this->model_basic->insert_all($this->tbl_product_image, $insert);
            if ($do_insert) {
                $origw = $this->input->post('origwidth');
                $origh = $this->input->post('origheight');
                $fakew = $this->input->post('fakewidth');
                $fakeh = $this->input->post('fakeheight');
                $x = $this->input->post('x') * $origw / $fakew;
                $y = $this->input->post('y') * $origh / $fakeh;
                # ambil width crop
                $targ_w = $this->input->post('w') * $origw / $fakew;
                # ambil heigth crop
                $targ_h = $this->input->post('h') * $origh / $fakeh;
                # rasio gambar crop
                $jpeg_quality = 100;
                if (!is_dir(FCPATH . 'assets/uploads/product/' . $insert['product_id']))
                    mkdir(FCPATH . 'assets/uploads/product/' . $insert['product_id']);
                if (basename($this->input->post('photo')) && $this->input->post('photo') != null) {
                    $src = $this->input->post('photo');
                }
                # inisial handle copy gambar
                $ext = pathinfo($src, PATHINFO_EXTENSION);

                if ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'JPG' || $ext == 'JPEG')
                    $img_r = imagecreatefromjpeg($src);
                if ($ext == 'png' || $ext == 'PNG')
                    $img_r = imagecreatefrompng($src);
                if ($ext == 'gif' || $ext == 'GIF')
                    $img_r = imagecreatefromgif($src);

                $dst_r = ImageCreateTrueColor($targ_w, $targ_h);
                $path_img_crop = realpath(FCPATH . 'assets/uploads/product/' . $insert['product_id']);
                imagecopyresampled($dst_r, $img_r, 0, 0, $x, $y, $targ_w, $targ_h, $targ_w, $targ_h);
                # buat gambar
                if (!imagejpeg($dst_r, $path_img_crop . '/' . $img_name_crop, $jpeg_quality)) {
                    $this->model_basic->delete($this->tbl_product_image, 'id', $insert['product_id']);
                    $this->delete_folder('product/' . $insert['product_id']);
                    $this->returnJson(array('status' => 'error', 'msg' => 'data gagal diupload'));
                } else {
                    $this->makeThumbnails('assets/uploads/product/' . $insert['product_id'] . '/', $img_name_crop, 500, 300);
                    $this->delete_temp('temp_folder');
                    $this->returnJson(array('status' => 'ok', 'msg' => 'Input data berhasil', 'redirect' => $data['function'] . '/album_image_product/' . $insert['product_id']));
                }
            } else
                $this->returnJson(array('status' => 'error', 'msg' => 'Form jangan Kosong'));
        }
    }

    function image_edit() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Image', 'admin_product');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_UPDATE);

        $img_name_crop = uniqid() . '-product.jpg';
        $foto = $this->input->post('photo');
        $old_foto = $this->input->post('old_photo');
        $table_field = $this->db->list_fields($this->tbl_product_image);
        $update = array();
        foreach ($table_field as $field) {
            $update[$field] = $this->input->post($field);
        }
        unset($update['date_created']);
        unset($update['id_created']);
        $update['date_modified'] = date('Y-m-d H:i:s', now());
        $update['id_modified'] = $this->session_admin['admin_id'];
        if (($foto && (basename($foto) != $old_foto)) || ($this->input->post('x') || $this->input->post('y') || $this->input->post('w') || $this->input->post('h')))
            $update['photo'] = $img_name_crop;
        else
            $update['photo'] = $this->input->post('old_photo');

        if ($update['product_id']) {
            $do_update = $this->model_basic->update($this->tbl_product_image, $update, 'id', $update['id']);
            if ($do_update) {
                if (($foto && (basename($foto) != $old_foto)) || ($this->input->post('x') || $this->input->post('y') || $this->input->post('w') || $this->input->post('h'))) {
                    $origw = $this->input->post('origwidth');
                    $origh = $this->input->post('origheight');
                    $fakew = $this->input->post('fakewidth');
                    $fakeh = $this->input->post('fakeheight');
                    $x = $this->input->post('x') * $origw / $fakew;
                    $y = $this->input->post('y') * $origh / $fakeh;
                    # ambil width crop
                    $targ_w = $this->input->post('w') * $origw / $fakew;
                    # abmil heigth crop
                    $targ_h = $this->input->post('h') * $origh / $fakeh;
                    # rasio gambar crop
                    $jpeg_quality = 100;
                    if (!is_dir(FCPATH . 'assets/uploads/product/' . $update['product_id']))
                        mkdir(FCPATH . 'assets/uploads/product/' . $update['product_id']);
                    if (basename($foto) && $foto != null)
                        $src = $this->input->post('photo');
                    else if ($this->input->post('x') || $this->input->post('y') || $this->input->post('w') || $this->input->post('h'))
                        $src = "assets/uploads/product/" . $update['product_id'] . '/' . $old_foto;
                    $ext = pathinfo($src, PATHINFO_EXTENSION);

                    if ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'JPG' || $ext == 'JPEG')
                        $img_r = imagecreatefromjpeg($src);
                    if ($ext == 'png' || $ext == 'PNG')
                        $img_r = imagecreatefrompng($src);
                    if ($ext == 'gif' || $ext == 'GIF')
                        $img_r = imagecreatefromgif($src);

                    $dst_r = ImageCreateTrueColor($targ_w, $targ_h);
                    # simpan hasil croping pada folder lain
                    $path_img_crop = realpath(FCPATH . "assets/uploads/product/" . $update['product_id']);
                    # nama gambar yg di crop
                    # proses copy
                    imagecopyresampled($dst_r, $img_r, 0, 0, $x, $y, $targ_w, $targ_h, $targ_w, $targ_h);
                    # buat gambar
                    if (imagejpeg($dst_r, $path_img_crop . '/' . $img_name_crop, $jpeg_quality)) {
                        @unlink('assets/uploads/product/' . $update['product_id'] . '/' . $this->input->post('old_photo'));
                        @unlink('assets/uploads/product/' . $update['product_id'] . '/thumb' . $this->input->post('old_photo'));
                    }
                    @unlink('assets/uploads/product/' . $update['product_id'] . '/thumb' . $update['photo']);
                    $this->makeThumbnails('assets/uploads/product/' . $update['product_id'] . '/', $update['photo'], 500, 300);
                    $this->delete_temp('temp_folder');
                }
                $this->returnJson(array('status' => 'ok', 'msg' => 'Update success', 'redirect' => $data['controller'] . '/album_image_product/' . $update['product_id']));
            } else
                $this->returnJson(array('status' => 'error', 'msg' => 'Failed when updating data'));
        } else
            $this->returnJson(array('status' => 'error', 'msg' => 'Please complete the form'));
    }

    function primary_status_edit($image_id) {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Image', 'admin_product');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_UPDATE);
        $image = $this->model_basic->select_where($this->tbl_product_image, 'id', $image_id)->row();
        $product_id = $image->product_id;
        $data_update = array('primary_status' => 0);
        $this->model_basic->update($this->tbl_product_image, $data_update, 'product_id', $product_id);
        if ($image->primary_status != 1) {
            $data_update_primary = array('primary_status' => 1);
            $this->model_basic->update($this->tbl_product_image, $data_update_primary, 'id', $image_id);
            redirect($data['controller'] . '/album_image_product/' . $product_id . '?edit=success');
        } else if ($image->primary_status != 0) {
            $data_update_primary = array('primary_status' => 0);
            $this->model_basic->update($this->tbl_product_image, $data_update_primary, 'id', $image_id);
            redirect($data['controller'] . '/album_image_product/' . $product_id . '?edit=success');
        } else {
            redirect($data['controller'] . '/album_image_product/' . $product_id . '?edit=failed');
        }
    }

    function album_image_delete() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Image', 'admin_product');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_DELETE);
        $id = $this->input->post('id');
        $deleted_data = $this->model_basic->select_where($this->tbl_product_image, 'id', $id)->row();
        $do_delete = $this->model_basic->delete($this->tbl_product_image, 'id', $id);
        if ($do_delete) {
            @unlink('assets/uploads/product/' . $deleted_data->product_id . '/thumb' . $deleted_data->photo);
            @unlink('assets/uploads/product/' . $deleted_data->product_id . '/' . $deleted_data->photo);
            $this->returnJson(array('status' => 'ok', 'msg' => 'Delete Success', 'redirect' => $data['controller'] . '/album_image_product/' . $deleted_data->product_id));
        } else {
            $this->returnJson(array('status' => 'failed', 'msg' => 'Delete failed'));
        }
    }

    public function stock($id) {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Stock', 'product_list');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_READ);

        $data['stock_list'] = $this->model_basic->select_where($this->tbl_product_stock, 'product_id', $id)->result();
        foreach ($data['stock_list'] as $d_row) {
            $d_row->product = $this->model_basic->select_where($this->tbl_product, 'id', $d_row->product_id)->row();
            $d_row->color = $this->model_basic->select_where($this->tbl_color, 'id', $d_row->color_id)->row();
            $d_row->size = $this->model_basic->select_where($this->tbl_size, 'id', $d_row->size_id)->row();
        }
        $data['product_id'] = $id;
        $data['content'] = $this->load->view('backend/product/stock_list', $data, true);
        $this->load->view('backend/index', $data);
    }

    function stockeditnumber() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Stock', 'product_list');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_UPDATE);
        $ids = $this->input->post('id');
        $product_id = $this->input->post('product_id');
        $stock = $this->input->post('stock');
        $this->db->trans_begin();
        foreach ($ids as $key => $id) {
            $update = array('stock' => $stock[$key]);
            $do_update = $this->model_basic->update($this->tbl_product_stock, $update, 'id', $id);
        }
        $this->db->trans_complete();
        if($this->db->trans_status() == TRUE)
        {
            $this->db->trans_commit();
            redirect($data['controller'] . '/stock/'.$product_id.'?edit=success');
        }
        else
        {
            $this->db->trans_rollback();
            redirect($data['controller'] . '/stock/'.$product_id.'?edit=failed');
        }
    }

    public function product_list() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Product List', 'product_list');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_READ);

        $data['product_list'] = $this->model_basic->select_all($this->tbl_product);
        $data['content'] = $this->load->view('backend/product/product_list', $data, true);
        $this->load->view('backend/index', $data);
    }

    public function product_list_form() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Product', 'product_list');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_CREATE);
        $id = $this->input->post('id');
        if ($id) {
            $data['data'] = $this->model_basic->select_where($this->tbl_product, 'id', $id)->row();
            $data['data']->color = $this->model_stock->select_color($this->tbl_product_stock, 'product_id', $id)->result();
            $data['data']->size = $this->model_stock->select_size($this->tbl_product_stock, 'product_id', $id)->result();
            $data['data']->editor = $this->model_stock->select_editor($this->tbl_product_editor_picks, 'product_id', $id)->result();
            $data['data']->group = $this->model_stock->select_group($this->tbl_product_group, 'product_id', $id)->result();
        } else
            $data['data'] = null;
        $data['editor_picks_list'] = $this->model_basic->select_all($this->tbl_editor_picks);
        $data['group_list'] = $this->model_basic->select_all($this->tbl_group);
        $data['size_list'] = $this->model_basic->select_all($this->tbl_size);
        $data['brand_list'] = $this->model_basic->select_all($this->tbl_brand);
        $data['color_list'] = $this->model_basic->select_all($this->tbl_color);
        $data['category_list'] = $this->model_basic->select_all($this->tbl_category);
        $data['content'] = $this->load->view('backend/product/product_form', $data, true);
        $this->load->view('backend/index', $data);
    }

    function product_list_add() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Product', 'product_list');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_CREATE);
        $table_field = $this->db->list_fields($this->tbl_product);
        $insert = array();
        foreach ($table_field as $field) {
            $insert[$field] = $this->input->post($field);
        }
        $insert['id_created'] = $this->session->userdata('admin')['admin_id'];
        $insert['id_modified'] = $this->session->userdata('admin')['admin_id'];
        $insert['date_created'] = date('Y-m-d H:i:s', now());
        $insert['date_modified'] = date('Y-m-d H:i:s', now());
        $insert['delete_flag'] = 0;

        if ($this->input->post('name_product')) {
            $this->db->trans_begin();
            $do_insert = $this->model_basic->insert_all($this->tbl_product, $insert);
            if ($do_insert) {
                $product_id = $do_insert->id;
                $color = $this->input->post('color');
                $size = $this->input->post('size');
                $stock = 0;
                $id_created = $this->session->userdata('admin')['admin_id'];
                $date_created = date('Y-m-d H:i:s', now());
                $id_modified = $this->session->userdata('admin')['admin_id'];
                $date_modified = date('Y-m-d H:i:s', now());
                foreach ($size as $data_row) {
                    foreach ($color as $row) {
                        $data_input_stock = array(
                            'product_id' => $product_id,
                            'color_id' => $row,
                            'size_id' => $data_row,
                            'stock' => $stock,
                            'id_created' => $id_created,
                            'date_created' => $date_created,
                            'id_modified' => $id_modified,
                            'date_modified' => $date_modified
                        );
                        $this->model_basic->insert_all($this->tbl_product_stock, $data_input_stock);
                    }
                }
                if ($this->input->post('editor')) {
                    $product_id = $do_insert->id;
                    $editor = $this->input->post('editor');
                    foreach ($editor as $inputdata) {
                        $data_editor = array(
                            'product_id' => $product_id,
                            'editor_picks_id' => $inputdata
                        );
                        $this->model_basic->insert_all($this->tbl_product_editor_picks, $data_editor);
                    }
                }
                if ($this->input->post('group')) {
                    $product_id = $do_insert->id;
                    $group = $this->input->post('group');
                    foreach ($group as $inputdata) {
                        $data_group = array(
                            'product_id' => $product_id,
                            'group_id' => $inputdata
                        );
                        $this->model_basic->insert_all($this->tbl_product_group, $data_group);
                    }
                }
            } else {
                $this->returnJson(array('status' => 'error', 'msg' => 'Insert Data Error, Please Try Again'));
            }
            if($this->db->trans_status() == TRUE)
            {
                $this->db->trans_commit();
                $this->returnJson(array('status' => 'ok', 'msg' => 'Insert Data success', 'redirect' => $data['controller'] . '/' . $data['function']));
            }
            else
            {
                $this->db->trans_rollback();
                $this->returnJson(array('status' => 'error', 'msg' => 'Insert Data Error, Please Try Again'));
            }
        } else
            $this->returnJson(array('status' => 'error', 'msg' => 'Form jangan kosong'));
    }

    function product_list_edit() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Product', 'product_list');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_UPDATE);

        $table_field = $this->db->list_fields($this->tbl_product);
        $update = array();
        foreach ($table_field as $field) {
            $update[$field] = $this->input->post($field);
        }
        unset($update['delete_flag']);
        unset($update['date_created']);
        unset($update['id_created']);
        $update['id_modified'] = $this->session->userdata('admin')['admin_id'];
        $update['date_modified'] = date('Y-m-d H:i:s', now());
        $update['delete_flag'] = 0;

        $do_update = $this->model_basic->update($this->tbl_product, $update, 'id', $update['id']);

        if ($do_update) {
            $this->db->trans_begin();
            $product_id = $update['id'];
            $stack = array();
            $i = 0;
            $color = $this->input->post('color');
            $size = $this->input->post('size');
            $stock = 0;
            $id_created = $this->session->userdata('admin')['admin_id'];
            $date_created = date('Y-m-d H:i:s', now());
            $id_modified = $this->session->userdata('admin')['admin_id'];
            $date_modified = date('Y-m-d H:i:s', now());
            foreach ($size as $data_row) {
                foreach ($color as $row) {
                    $data_stock_db = $this->model_stock->get_data_stock_by_condition($product_id, $data_row, $row);
                    if ($data_stock_db->num_rows() != 0) {
                        $stack[$i] = $data_stock_db->row()->id;
                        $i++;
                    } else {
                        $data_input_stock = array(
                            'product_id' => $product_id,
                            'color_id' => $row,
                            'size_id' => $data_row,
                            'stock' => $stock,
                            'id_created' => $id_created,
                            'date_created' => $date_created,
                            'id_modified' => $id_modified,
                            'date_modified' => $date_modified
                        );
                        $insert = $this->model_basic->insert_all($this->tbl_product_stock, $data_input_stock);
                        $stack[$i] = $insert->id;
                        $i++;
                    }
                }
            }
            if (count($stack) != 0) {
                $id_delete = $this->model_stock->get_data_not_in($product_id, $stack);
                if ($id_delete->num_rows() != 0) {
                    foreach ($id_delete->result() as $del)
                        $this->model_basic->delete($this->tbl_product_stock, 'id', $del->id);
                }
            }
            if ($this->input->post('editor') == 0) {
                $this->model_basic->delete($this->tbl_product_editor_picks, 'product_id', $update['id']);
            }
            if ($this->input->post('editor')) {
                $this->model_basic->delete($this->tbl_product_editor_picks, 'product_id', $update['id']);
                $product_id = $update['id'];
                $editor = $this->input->post('editor');
                foreach ($editor as $event) {
                    $data_editor = array(
                        'product_id' => $product_id,
                        'editor_picks_id' => $event
                    );
                    $this->model_basic->insert_all($this->tbl_product_editor_picks, $data_editor);
                }
            }
            if ($this->input->post('group') == 0) {
                $this->model_basic->delete($this->tbl_product_group, 'product_id', $update['id']);
            }
            if ($this->input->post('group')) {
                $this->model_basic->delete($this->tbl_product_group, 'product_id', $update['id']);
                $product_id = $update['id'];
                $group = $this->input->post('group');
                foreach ($group as $inputdata) {
                    $data_group = array(
                        'product_id' => $product_id,
                        'group_id' => $inputdata
                    );
                    $this->model_basic->insert_all($this->tbl_product_group, $data_group);
                }
            }
            if($this->db->trans_status() == TRUE)
            {
                $this->db->trans_commit();
                $this->returnJson(array('status' => 'ok', 'msg' => 'Edit data success', 'redirect' => $data['controller'] . '/' . $data['function']));
            }
            else
            {
                $this->db->trans_rollback();
                $this->returnJson(array('status' => 'error', 'msg' => 'Update Data Error, Please Try Again'));
            }
        } else {
            $this->returnJson(array('status' => 'error', 'msg' => 'Update Data Error, Please Try Again'));
        }
    }

    function statusproductedit() {
        $id = $this->input->post('id');
        $produk = $this->model_basic->select_where($this->tbl_product, 'id', $id)->row();
        if ($produk) {
            if ($produk->delete_flag == 0)
                $change_status = 1;
            else
                $change_status = 0;
            $update = array('delete_flag' => $change_status);
            if (!$this->model_basic->update($this->tbl_product, $update, 'id', $id))
                $this->returnJson(array('status' => 'failed', 'msg' => 'Update Status Failed'));
            else
                $this->returnJson(array('status' => 'ok', 'produk_status' => $change_status, 'id' => $id));
        }
        else {
            $this->returnJson(array('status' => 'failed', 'msg' => 'Update Status Failed'));
        }
    }

    function product_list_delete() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Product', 'product_list');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_DELETE);
        $id = $this->input->post('id');
        $deleted_data = $this->model_basic->select_where($this->tbl_product, 'id', $id)->row();
        $do_delete = $this->model_basic->delete($this->tbl_product, 'id', $id);
        if ($do_delete) {
            $this->model_basic->delete($this->tbl_product_editor_picks, 'product_id', $id);
            $this->model_basic->delete($this->tbl_product_group, 'product_id', $id);
            $this->model_basic->delete($this->tbl_product_image, 'product_id', $id);
            $this->model_basic->delete($this->tbl_product_stock, 'product_id', $id);
            $this->delete_folder('/product/' . $deleted_data->id);
            $this->returnJson(array('status' => 'ok', 'msg' => 'Delete Success', 'redirect' => $data['controller'] . '/' . $data['function']));
        } else {
            $this->returnJson(array('status' => 'failed', 'msg' => 'Delete failed'));
        }
    }

    public function product_list_detail($id) {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Product', 'product_list');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_READ);
        $data['product'] = $this->model_basic->select_where($this->tbl_product, 'id', $id)->row();
        $data['product']->category = $this->model_basic->select_where($this->tbl_category, 'id', $data['product']->category_id)->row();
        $data['product']->stock = $this->model_basic->select_where($this->tbl_product_stock, 'id', $data['product']->stock_id)->row();
        $data['product']->stock->size = $this->model_basic->select_where($this->tbl_size, 'id', $data['product']->stock->size_id)->row();
        $data['product']->stock->color = $this->model_basic->select_where($this->tbl_color, 'id', $data['product']->stock->color_id)->row();
        $data['product']->price = $this->indonesian_currency($data['product']->price);
        $data['product']->date_created = tgl_indo(date('Y-m-d', strtotime($data['product']->date_created)));
        $data['product']->date_modified = tgl_indo(date('Y-m-d', strtotime($data['product']->date_modified)));

        $data['content'] = $this->load->view('backend/product/product_detail', $data, true);
        $this->load->view('backend/index', $data);
    }

    public function product_group_list() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Product Group', 'product_group_list');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_READ);

        $data['product_group_list'] = $this->model_basic->select_all($this->tbl_group);
        $data['content'] = $this->load->view('backend/product/product_group_list', $data, true);
        $this->load->view('backend/index', $data);
    }

    public function product_group_list_form() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Product Group', 'product_group_list');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_CREATE);
        $id = $this->input->post('id');
        if ($id) {
            $data['data'] = $this->model_basic->select_where($this->tbl_group, 'id', $id)->row();
        } else
            $data['data'] = null;
        $data['content'] = $this->load->view('backend/product/product_group_form', $data, true);
        $this->load->view('backend/index', $data);
    }

    function product_group_list_add() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Product Group', 'product_group_list');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_CREATE);
        $table_field = $this->db->list_fields($this->tbl_group);
        $insert = array();
        foreach ($table_field as $field) {
            $insert[$field] = $this->input->post($field);
        }

        if ($this->input->post('name')) {
            $do_insert = $this->model_basic->insert_all($this->tbl_group, $insert);

            if ($do_insert) {
                $this->returnJson(array('status' => 'ok', 'msg' => 'Insert Data success', 'redirect' => $data['controller'] . '/' . $data['function']));
            } else {
                $this->returnJson(array('status' => 'error', 'msg' => 'Error'));
            }
        } else
            $this->returnJson(array('status' => 'error', 'msg' => 'Form jangan kosong'));
    }

    function product_group_list_edit() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Product Group', 'product_group_list');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_UPDATE);

        $table_field = $this->db->list_fields($this->tbl_group);
        $update = array();
        foreach ($table_field as $field) {
            $update[$field] = $this->input->post($field);
        }

        $do_update = $this->model_basic->update($this->tbl_group, $update, 'id', $update['id']);

        if ($do_update) {
            $this->returnJson(array('status' => 'ok', 'msg' => 'Edit data success', 'redirect' => $data['controller'] . '/' . $data['function']));
        } else {
            $this->returnJson(array('status' => 'error', 'msg' => 'Error'));
        }
    }

    function product_group_list_delete() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Product Group', 'product_group_list');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_DELETE);
        $id = $this->input->post('id');
        $deleted_data = $this->model_basic->select_where($this->tbl_group, 'id', $id)->row();
        $do_delete = $this->model_basic->delete($this->tbl_group, 'id', $id);
        if ($do_delete) {
            $this->returnJson(array('status' => 'ok', 'msg' => 'Delete Success', 'redirect' => $data['controller'] . '/' . $data['function']));
        } else {
            $this->returnJson(array('status' => 'failed', 'msg' => 'Delete failed'));
        }
    }

    function penjualan_stock_excel() {
        $product = $this->model_excel->get_penjualan_item();

        $sheet_name = 'Data_Penjualan_Stock';
        $file_name = 'Data_Penjualan_Stock';
        $this->load->library('excel');
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setTitle($sheet_name)->setDescription("none");
        $objPHPExcel->setActiveSheetIndex(0);
        $no = 1;
        $fields = array(
            'No',
            'Nama Barang',
            'Warna',
            'Ukuran',
            'Harga',
            'Diskon',
            'Berat',
            'Barcode',
            'Deskripsi');
        $col = 1;
        $row = 2;
        $objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow($col, $row, $col + 8, $row)->setCellValueByColumnAndRow($col, $row, 'DATA PENJUALAN BARANG');
        $alignvcenterhcenter = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
            )
        );

        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col, $row, $col + 11, $row)->applyFromArray($alignvcenterhcenter);

        foreach ($fields as $field) {
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 4, $field);
            $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col, 4)->getFont()->setSize(11);
            $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col, 4)->getFont()->setBold(true);
            $col++;
        }

        $no = 1;

        foreach ($product as $data) {
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $row + 3, $no);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $row + 3, $data->name_product);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $row + 3, $data->warna);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $row + 3, $data->ukuran);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $row + 3, $data->price);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $row + 3, $data->discount);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $row + 3, $data->weight);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, $row + 3, $data->barcode);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9, $row + 3, $data->description);
            $row++;
            $no++;
        }

        $objPHPExcel->setActiveSheetIndex(0);

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $filename = $file_name . '.xls';
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $objWriter->save('php://output');
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

    function productshow() {
        $id = $this->input->post('id');
        $product = $this->model_basic->select_where($this->tbl_product, 'id', $id)->row();
        if ($product) {
            if ($product->show_flag == 0)
                $change_status = 1;
            else
                $change_status = 0;
            $update = array('show_flag' => $change_status);
            if (!$this->model_basic->update($this->tbl_product, $update, 'id', $id))
                $this->returnJson(array('status' => 'failed', 'msg' => 'Update Status Failed'));
            else
                $this->returnJson(array('status' => 'ok', 'show_flag' => $change_status, 'id' => $id));
        }
        else {
            $this->returnJson(array('status' => 'failed', 'msg' => 'Update Status Failed'));
        }
    }

}
