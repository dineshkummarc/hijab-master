<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_site_content extends PX_Controller {

    public function __construct() {
        parent::__construct();
        $this->check_login();
        $this->controller_attr = array('controller' => 'admin_site_content', 'controller_name' => 'Admin Site Content', 'controller_id' => 0);
    }

    public function index() {
        
    }

    function banner() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Admin Banner', 'banner');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_READ);

        $data['data'] = $this->model_basic->select_all($this->tbl_banner);
        $data['content'] = $this->load->view('backend/admin_site_content/banner', $data, true);
        $this->load->view('backend/index', $data);
    }

    function banner_form() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Admin Banner', 'banner');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_CREATE);
        $id = $this->input->post('id');
        if ($id) {
            $data['data'] = $this->model_basic->select_where($this->tbl_banner, 'id', $id)->row();
        }
        else
            $data['data'] = null;
        $data['content'] = $this->load->view('backend/admin_site_content/banner_form', $data, true);
        $this->load->view('backend/index', $data);
    }

    function banner_add() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Admin Banner', 'banner');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_CREATE);

        $img_name_crop = uniqid() . '-banner.jpg';
        $table_field = $this->db->list_fields($this->tbl_banner);
        $insert = array();
        foreach ($table_field as $field) {
            $insert[$field] = $this->input->post($field);
        }
        $insert['date_created'] = date('Y-m-d H:i:s', now());
        $insert['date_modified'] = date('Y-m-d H:i:s', now());
        $insert['id_creator'] = $this->session_admin['admin_id'];
        $insert['id_modifier'] = $this->session_admin['admin_id'];
        $insert['banner'] = $img_name_crop;
        if ($insert['banner']) {
            $do_insert = $this->model_basic->insert_all($this->tbl_banner, $insert);
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
                if (!is_dir(FCPATH . 'assets/uploads/banner/' . $do_insert->id))
                    mkdir(FCPATH . 'assets/uploads/banner/' . $do_insert->id);
                if(basename($this->input->post('banner')) && $this->input->post('banner') != null){
                        $src = $this->input->post('banner');
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
                $path_img_crop = realpath(FCPATH . 'assets/uploads/banner/'.$do_insert->id);
                imagecopyresampled($dst_r,$img_r,0,0,$x,$y,$targ_w,$targ_h,$targ_w,$targ_h);
                # buat gambar
                if(!imagejpeg($dst_r,$path_img_crop .'/'. $img_name_crop,$jpeg_quality)){
                        $this->model_basic->delete($this->tbl_banner,'id',$do_insert->id);
                        $this->delete_folder('banner/'.$do_insert->id);
                        $this->returnJson(array('status' => 'error','msg' => 'data gagal diupload'));
                }
                else{
                        $this->delete_temp('temp_folder');
                        $this->returnJson(array('status' => 'ok','msg' => 'Input data berhasil','redirect' => $data['controller'].'/'.$data['function']));
                }
            }
            else
                $this->returnJson(array('status' => 'error', 'msg' => 'Failed when saving data'));
        }
        else
            $this->returnJson(array('status' => 'error', 'msg' => 'Please complete the form'));
    }

    function banner_edit() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Admin Banner', 'banner');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_UPDATE);

        $img_name_crop = uniqid() . '-banner.jpg';
        $foto = $this->input->post('banner');
        $old_foto = $this->input->post('old_banner');
        $table_field = $this->db->list_fields($this->tbl_banner);
        $update = array();
        foreach ($table_field as $field) {
            $update[$field] = $this->input->post($field);
        }
        unset($update['id_creator']);
        unset($update['date_created']);

        $update['id_modifier'] = $this->session_admin['admin_id'];
        $update['date_modified'] = date('Y-m-d H:i:s', now());

        if(($foto && (basename($foto) != $old_foto)) || ($this->input->post('x') || $this->input->post('y') || $this->input->post('w') || $this->input->post('h')))
                $update['banner'] = $img_name_crop;
        else
                $update['banner'] = $this->input->post('old_banner');

        if ($update['banner']) {
            $do_update = $this->model_basic->update($this->tbl_banner, $update, 'id', $update['id']);
            if ($do_update) {
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
                    $jpeg_quality = 100;
                    if (!is_dir(FCPATH . 'assets/uploads/banner/' . $update['id']))
                        mkdir(FCPATH . 'assets/uploads/banner/' . $update['id']);
                    if(basename($foto) && $foto != null)
                            $src = $this->input->post('banner');
                    else if($this->input->post('x')||$this->input->post('y')||$this->input->post('w')||$this->input->post('h'))
                            $src = "assets/uploads/banner/".$update['id'].'/'.$old_foto;
                    $ext = pathinfo($src, PATHINFO_EXTENSION);

                    if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'JPG' || $ext == 'JPEG')
                            $img_r = imagecreatefromjpeg($src);
                    if($ext == 'png' || $ext == 'PNG')
                            $img_r = imagecreatefrompng($src);
                    if($ext == 'gif' || $ext == 'GIF')
                            $img_r = imagecreatefromgif($src);

                    $dst_r = ImageCreateTrueColor( $targ_w, $targ_h );
                    # simpan hasil croping pada folder lain
                    $path_img_crop = realpath(FCPATH . "assets/uploads/banner/".$update['id']);
                    # nama gambar yg di crop
                    # proses copy
                    imagecopyresampled($dst_r,$img_r,0,0,$x,$y,$targ_w,$targ_h,$targ_w,$targ_h);
                    # buat gambar
                    if(imagejpeg($dst_r,$path_img_crop .'/'. $img_name_crop,$jpeg_quality))
                            @unlink('assets/uploads/banner/'.$update['id'].'/'.$this->input->post('old_banner'));
                    $this->delete_temp('temp_folder');
                }
                $this->returnJson(array('status' => 'ok', 'msg' => 'Update success', 'redirect' => $data['controller'] . '/' . $data['function']));
            }
            else
                $this->returnJson(array('status' => 'error', 'msg' => 'Failed when updating data'));
        }
        else
            $this->returnJson(array('status' => 'error', 'msg' => 'Please complete the form'));
    }

    function banner_delete() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Admin Banner', 'banner');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_DELETE);
        $id = $this->input->post('id');
        $do_delete = $this->model_basic->delete($this->tbl_banner, 'id', $id);
        if ($do_delete) {
            $this->delete_folder('banner/' . $id);
            $this->returnJson(array('status' => 'ok', 'msg' => 'Delete Success', 'redirect' => $data['controller'] . '/' . $data['function']));
        }
        else
            $this->returnJson(array('status' => 'error', 'msg' => 'Delete Failed'));
    }

    function static_content() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Admin Static Content', 'static_content');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_READ);
        $data['data'] = $this->model_basic->select_all($this->tbl_static_content);
        $data['content'] = $this->load->view('backend/admin_site_content/static_content', $data, true);
        $this->load->view('backend/index', $data);
    }

    function static_content_form() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Admin Static Content', 'static_content');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_CREATE);
        $id = $this->input->post('id');
        if ($id) {
            $data['data'] = $this->model_basic->select_where($this->tbl_static_content, 'id', $id)->row();
            $content = new domDocument;
            libxml_use_internal_errors(true);
            $content->loadHTML($data['data']->content);
            libxml_use_internal_errors(false);
            libxml_use_internal_errors(false);
            $content->preserveWhiteSpace = false;
            $images = $content->getElementsByTagName('img');
            if ($images) {
                foreach ($images as $image) {
                    $data['data']->image[] = $image->getAttribute('src');
                }
            }
        }
        else
            $data['data'] = null;
        $data['content'] = $this->load->view('backend/admin_site_content/static_content_form', $data, true);
        $this->load->view('backend/index', $data);
    }

    function static_content_add() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Admin Static Content', 'static_content');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_CREATE);

        $images = $this->input->post('images');
        $table_field = $this->db->list_fields($this->tbl_static_content);
        $insert = array();
        foreach ($table_field as $field) {
            $insert[$field] = $this->input->post($field);
        }
        $insert['date_created'] = date('Y-m-d H:i:s', now());
        $insert['date_modified'] = date('Y-m-d H:i:s', now());
        $insert['id_creator'] = $this->session_admin['admin_id'];
        $insert['id_modifier'] = $this->session_admin['admin_id'];
        if ($insert['title'] && $insert['content']) {
            $do_insert = $this->model_basic->insert_all($this->tbl_static_content, $insert);
            if ($do_insert) {
                if ($images) {
                    if (!is_dir(FCPATH . "assets/uploads/static_content/" . $do_insert->id))
                        mkdir(FCPATH . "assets/uploads/static_content/" . $do_insert->id);
                    $content = $insert['content'];
                    foreach ($images as $im) {
                        if (strpos($content, $im) !== false) {
                            $new_im = 'assets/uploads/static_content/' . $do_insert->id . '/' . basename($im);
                            @copy($im, $new_im);
                            $content = str_replace($im, $new_im, $content);
                        }
                    }
                    $update['content'] = $content;
                    $do_update = $this->model_basic->update($this->tbl_static_content, $update, 'id', $do_insert->id);
                    $this->delete_temp('temp_folder');
                }
                $this->returnJson(array('status' => 'ok', 'msg' => 'Input data success', 'redirect' => $data['controller'] . '/' . $data['function']));
            }
            else
                $this->returnJson(array('status' => 'error', 'msg' => 'Failed when saving data'));
        }
        else
            $this->returnJson(array('status' => 'error', 'msg' => 'Please complete the form'));
    }

    function static_content_edit() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Admin Static Content', 'static_content');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_UPDATE);

        $images = $this->input->post('images');
        $table_field = $this->db->list_fields($this->tbl_static_content);
        $update = array();
        foreach ($table_field as $field) {
            $update[$field] = $this->input->post($field);
        }
        unset($update['date_created']);
        $update['date_modified'] = date('Y-m-d H:i:s', now());
        $update['id_modifier'] = $this->session_admin['admin_id'];
        if ($images) {
            if (!is_dir(FCPATH . "assets/uploads/static_content/" . $update['id']))
                mkdir(FCPATH . "assets/uploads/static_content/" . $update['id']);
            $content = $update['content'];
            foreach ($images as $im) {
                if (strpos($content, $im) !== false) {
                    $new_im = 'assets/uploads/static_content/' . $update['id'] . '/' . basename($im);
                    if ($im != $new_im)
                        @copy($im, $new_im);
                    $content = str_replace($im, $new_im, $content);
                }
                else
                    @unlink($im);
            }
            $update['content'] = $content;
            $this->delete_temp('temp_folder');
        }
        if ($update['title'] && $update['content']) {
            $do_update = $this->model_basic->update($this->tbl_static_content, $update, 'id', $update['id']);
            if ($do_update)
                $this->returnJson(array('status' => 'ok', 'msg' => 'Update success', 'redirect' => $data['controller'] . '/' . $data['function']));
            else
                $this->returnJson(array('status' => 'error', 'msg' => 'Failed when updating data'));
        }
        else
            $this->returnJson(array('status' => 'error', 'msg' => 'Please complete the form'));
    }

    function static_content_delete() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Admin Static Content', 'static_content');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_DELETE);
        $id = $this->input->post('id');
        $do_delete = $this->model_basic->delete($this->tbl_static_content, 'id', $id);
        if ($do_delete) {
            $this->delete_folder('static_content/' . $id);
            $this->returnJson(array('status' => 'ok', 'msg' => 'Delete Success', 'redirect' => $data['controller'] . '/' . $data['function']));
        }
        else
            $this->returnJson(array('status' => 'error', 'msg' => 'Delete Failed'));
    }

    function album() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Admin Album', 'album');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_READ);

        $data['data'] = $this->model_basic->select_all($this->tbl_album);
        $data['content'] = $this->load->view('backend/admin_site_content/album', $data, true);
        $this->load->view('backend/index', $data);
    }

    function album_form() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Admin Album', 'album');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_CREATE);
        $id = $this->input->post('id');

        if ($id) {
            $data['data'] = $this->model_basic->select_where($this->tbl_album, 'id', $id)->row();
            $data['data']->album_image = $this->model_basic->select_where($this->tbl_album_files, 'id_album', $id)->result();
        }
        else
            $data['data'] = null;
        $data['content'] = $this->load->view('backend/admin_site_content/album_form', $data, true);
        $this->load->view('backend/index', $data);
    }

    function album_add() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Admin Album', 'album');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_CREATE);

        $table_field = $this->db->list_fields($this->tbl_album);
        $insert = array();
        foreach ($table_field as $field) {
            $insert[$field] = $this->input->post($field);
        }
        if ($insert['name']) {
            $do_insert = $this->model_basic->insert_all($this->tbl_album, $insert);
            if ($do_insert) {
                $this->returnJson(array('status' => 'ok', 'msg' => 'Input data success', 'redirect' => $data['controller'] . '/' . $data['function']));
            }
            else
                $this->returnJson(array('status' => 'error', 'msg' => 'Failed when saving data'));
        }
        else
            $this->returnJson(array('status' => 'error', 'msg' => 'Please complete the form'));
    }

    function album_edit() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Admin Album', 'album');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_UPDATE);

        $table_field = $this->db->list_fields($this->tbl_album);
        $update = array();
        foreach ($table_field as $field) {
            $update[$field] = $this->input->post($field);
        }

        if (!is_dir(FCPATH . 'assets/uploads/album/' . $update['id']))
            mkdir(FCPATH . 'assets/uploads/album/' . $update['id']);

        if ($update['name']) {
            $do_update = $this->model_basic->update($this->tbl_album, $update, 'id', $update['id']);
            if ($do_update) {
                $this->delete_temp('temp_folder');
                $this->returnJson(array('status' => 'ok', 'msg' => 'Update success', 'redirect' => $data['controller'] . '/' . $data['function']));
            }
            else
                $this->returnJson(array('status' => 'error', 'msg' => 'Failed when updating data'));
        }
        else
            $this->returnJson(array('status' => 'error', 'msg' => 'Please complete the form'));
    }

    function album_update_status() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Admin Album', 'album');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_UPDATE);

        $id = $this->input->post('id_album');
        $status = $this->input->post('status');

        $update = array(
            'status' => $status
        );
        $do_update = $this->model_basic->update($this->tbl_album, $update, 'id', $id);
        if ($do_update) {
            $this->returnJson(array('status' => 'ok', 'msg' => 'Update success', 'redirect' => $data['controller'] . '/' . $data['function']));
        }
        else
            $this->returnJson(array('status' => 'error', 'msg' => 'Failed when updating data'));
    }

    function album_delete() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Admin Album', 'album');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_DELETE);

        $id = $this->input->post('id');
        $do_delete = $this->model_basic->delete($this->tbl_album, 'id', $id);
        $do_delete_album_image = $this->model_basic->delete($this->tbl_album_files, 'id_album', $id);
        if ($do_delete) {
            $this->delete_folder('album/' . $id);
            $this->returnJson(array('status' => 'ok', 'msg' => 'Delete Success', 'redirect' => $data['controller'] . '/' . $data['function']));
        }
        else
            $this->returnJson(array('status' => 'error', 'msg' => 'Delete Failed'));
    }

    function album_image($id_album) {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Admin Album Image', 'album');

        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_READ);
        $data['id_album'] = $id_album;
        $data['data'] = $this->model_basic->select_where($this->tbl_album_files, 'id_album', $id_album)->result();
        $data['content'] = $this->load->view('backend/admin_site_content/album_image', $data, true);
        $this->load->view('backend/index', $data);
    }

    function album_image_add() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Admin Album Image', 'album');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_CREATE);

        $img_name_crop = uniqid() . '-gallery.jpg';
        $table_field = $this->db->list_fields($this->tbl_album_files);
        $insert = array();
        foreach ($table_field as $field) {
            $insert[$field] = $this->input->post($field);
        }
        $insert['file'] = $img_name_crop;
        if ($insert['caption']) {
            $do_insert = $this->model_basic->insert_all($this->tbl_album_files, $insert);
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
                if (!is_dir(FCPATH . 'assets/uploads/album/' . $insert['id_album']))
                    mkdir(FCPATH . 'assets/uploads/album/' . $insert['id_album']);
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
                # simpan hasil croping pada folder lain
                $path_img_crop = realpath(FCPATH . 'assets/uploads/album/' . $insert['id_album']);
                # nama gambar yg di crop
                # proses copy
                imagecopyresampled($dst_r, $img_r, 0, 0, $x, $y, $targ_w, $targ_h, $targ_w, $targ_h);
                # buat gambar
                if (!imagejpeg($dst_r, $path_img_crop . '/' . $img_name_crop, $jpeg_quality)) {
                    $this->model_basic->delete($this->tbl_album_files, 'id', $insert['id_album']);
                    $this->delete_folder('album_image/' . $insert['id_album']);
                    $this->returnJson(array('status' => 'error', 'msg' => 'Upload Falied'));
                } else {
                    $this->makeThumbnails($path_img_crop.'/', $img_name_crop, 300, 300);
                    $this->delete_temp('temp_folder');
                    $redirect = $data['controller'] . '/album_image/' . $insert['id_album'];
                    $this->returnJson(array('status' => 'ok', 'msg' => 'Input data success', 'redirect' => $redirect));
                }
            }
            else
                $this->returnJson(array('status' => 'error', 'msg' => 'Failed when saving data'));
        }
        else
            $this->returnJson(array('status' => 'error', 'msg' => 'Please complete the form'));
    }

    function album_image_edit() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Admin Album Image', 'album');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_UPDATE);

        $img_name_crop = uniqid() . '-gallery.jpg';
        $foto = $this->input->post('photo');
        $old_foto = $this->input->post('old_photo');
        $table_field = $this->db->list_fields($this->tbl_album_files);
        $update = array();
        foreach ($table_field as $field) {
            $update[$field] = $this->input->post($field);
        }

        if (($foto && (basename($foto) != $old_foto)) || ($this->input->post('x') || $this->input->post('y') || $this->input->post('w') || $this->input->post('h')))
            $update['file'] = $img_name_crop;
        else
            $update['file'] = $this->input->post('old_photo');

        if ($update['caption']) {
            $do_update = $this->model_basic->update($this->tbl_album_files, $update, 'id', $update['id']);
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
                    if (!is_dir(FCPATH . 'assets/uploads/album/' . $update['id_album']))
                        mkdir(FCPATH . 'assets/uploads/album/' . $update['id_album']);

                    if (basename($foto) && $foto != null)
                        $src = $this->input->post('photo');
                    else if ($this->input->post('x') || $this->input->post('y') || $this->input->post('w') || $this->input->post('h'))
                        $src = "assets/uploads/album/" . $update['id_album'] . '/' . $old_foto;
                    # inisial handle copy gambar
                    $ext = pathinfo($src, PATHINFO_EXTENSION);

                    if ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'JPG' || $ext == 'JPEG')
                        $img_r = imagecreatefromjpeg($src);
                    if ($ext == 'png' || $ext == 'PNG')
                        $img_r = imagecreatefrompng($src);
                    if ($ext == 'gif' || $ext == 'GIF')
                        $img_r = imagecreatefromgif($src);

                    $dst_r = ImageCreateTrueColor($targ_w, $targ_h);
                    # simpan hasil croping pada folder lain
                    $path_img_crop = realpath(FCPATH . "assets/uploads/album/" . $update['id_album']);
                    # nama gambar yg di crop
                    # proses copy
                    imagecopyresampled($dst_r, $img_r, 0, 0, $x, $y, $targ_w, $targ_h, $targ_w, $targ_h);
                    # buat gambar
                    if (imagejpeg($dst_r, $path_img_crop . '/' . $img_name_crop, $jpeg_quality))
                    {
                        @unlink('assets/uploads/album/' . $update['id_album'] . '/' . $this->input->post('old_photo'));
                        $this->makeThumbnails($path_img_crop.'/', $img_name_crop, 300, 300);
                    }
                    $this->delete_temp('temp_folder');
                }
                $redirect = $data['controller'] . '/album_image/' . $update['id_album'];
                $this->returnJson(array('status' => 'ok', 'msg' => 'Update success', 'redirect' => $redirect));
            }
            else
                $this->returnJson(array('status' => 'error', 'msg' => 'Failed when updating data'));
        }
        else
            $this->returnJson(array('status' => 'error', 'msg' => 'Please complete the form'));
    }

    function album_image_delete() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Admin Album Image', 'album');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_DELETE);
        $id = $this->input->post('id');
        $deleted_data = $this->model_basic->select_where($this->tbl_album_files, 'id', $id)->row();
        $do_delete = $this->model_basic->delete($this->tbl_album_files, 'id', $id);
        if ($do_delete) {
            @unlink('assets/uploads/album/' . $deleted_data->id_album . '/' . $deleted_data->file);
            @unlink('assets/uploads/album/' . $deleted_data->id_album . '/' .'thumb' .$deleted_data->file);
            $redirect = $data['controller'] . '/album_image/' . $deleted_data->id_album;
            $this->returnJson(array('status' => 'ok', 'msg' => 'Delete Success', 'redirect' => $redirect));
        }
        else
            $this->returnJson(array('status' => 'error', 'msg' => 'Delete Failed'));
    }

    function album_image_get() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Admin Album Image', 'album');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_READ);
        $id = $this->input->post('id');
        $data['row'] = $this->model_basic->select_where($this->tbl_album_files, 'id', $id)->row();
        if (is_file('assets/uploads/album/' . $data['row']->id_album . '/' . $data['row']->file)) {
            $data['row']->photo_file = 'assets/uploads/album/' . $data['row']->id_album . '/' . $data['row']->file;
            $data['row']->photo_status = 'ok';
        }
        else
            $data['row']->photo_status = 'error';
        if ($data['row'])
            $this->returnJson(array('status' => 'ok', 'data' => $data));
        else
            $this->returnJson(array('status' => 'error', 'msg' => 'Data not found'));
    }

    function news() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Admin News', 'news');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_READ);
        $data['data'] = $this->model_basic->select_all_order($this->tbl_news, 'id', 'DESC');
        $data['content'] = $this->load->view('backend/admin_site_content/news', $data, true);
        $this->load->view('backend/index', $data);
    }

    function news_form() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Admin News', 'news');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_CREATE);
        $id = $this->input->post('id');
        if ($id) {
            $data['data'] = $this->model_basic->select_where($this->tbl_news, 'id', $id)->row();
            $content = new domDocument;
            libxml_use_internal_errors(true);
            $content->loadHTML($data['data']->content);
            libxml_use_internal_errors(false);
            $content->preserveWhiteSpace = false;
            $images = $content->getElementsByTagName('img');
            if ($images) {
                foreach ($images as $image) {
                    $data['data']->image[] = $image->getAttribute('src');
                }
            }
        }
        else
            $data['data'] = null;
        $data['content'] = $this->load->view('backend/admin_site_content/news_form', $data, true);
        $this->load->view('backend/index', $data);
    }

    function news_add() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Admin News', 'news');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_CREATE);
        $images = $this->input->post('images');
        $table_field = $this->db->list_fields($this->tbl_news);
        $insert = array();
        foreach ($table_field as $field) {
            $insert[$field] = $this->input->post($field);
        }
        $insert['date_created'] = date('Y-m-d H:i:s', now());
        $insert['date_modified'] = date('Y-m-d H:i:s', now());
        $insert['id_creator'] = $this->session_admin['admin_id'];
        $insert['id_modifier'] = $this->session_admin['admin_id'];
        if ($insert['title'] && $insert['content']) {
            $do_insert = $this->model_basic->insert_all($this->tbl_news, $insert);
            if ($do_insert) {
                if ($images) {
                    if (!is_dir(FCPATH . "assets/uploads/news/" . $do_insert->id))
                        mkdir(FCPATH . "assets/uploads/news/" . $do_insert->id);
                    $content = $insert['content'];
                    foreach ($images as $im) {
                        if (strpos($content, $im) !== false) {
                            $new_im = 'assets/uploads/news/' . $do_insert->id . '/' . basename($im);
                            @copy($im, $new_im);
                            $content = str_replace($im, $new_im, $content);
                        }
                    }
                    $update['content'] = $content;
                    $do_update = $this->model_basic->update($this->tbl_news, $update, 'id', $do_insert->id);
                    $this->delete_temp('temp_folder');
                }    
                $this->returnJson(array('status' => 'ok', 'msg' => 'Input data success', 'redirect' => $data['controller'] . '/' . $data['function']));
            }
            else
                $this->returnJson(array('status' => 'error', 'msg' => 'Failed when saving data'));
        }
        else
            $this->returnJson(array('status' => 'error', 'msg' => 'Please complete the form'));
    }

    function news_edit() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Admin News', 'news');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_UPDATE);
        
        $images = $this->input->post('images');
        $table_field = $this->db->list_fields($this->tbl_news);
        $update = array();
        foreach ($table_field as $field) {
            $update[$field] = $this->input->post($field);
        }
        unset($update['date_created']);
        unset($update['photo_small']);
        unset($update['photo_landscape']);
        $update['date_modified'] = date('Y-m-d H:i:s', now());
        $update['id_modifier'] = $this->session_admin['admin_id'];
        if ($images) {
            if (!is_dir(FCPATH . "assets/uploads/news/" . $update['id']))
                mkdir(FCPATH . "assets/uploads/news/" . $update['id']);
            $content = $update['content'];
            foreach ($images as $im) {
                if (strpos($content, $im) !== false) {
                    $new_im = 'assets/uploads/news/' . $update['id'] . '/' . basename($im);
                    if ($im != $new_im)
                        @copy($im, $new_im);
                    $content = str_replace($im, $new_im, $content);
                }
                else
                    @unlink($im);
            }
            $update['content'] = $content;
        }
        if ($update['title'] && $update['content']) {
            $do_update = $this->model_basic->update($this->tbl_news, $update, 'id', $update['id']);
            if ($do_update)
            {
                $this->delete_temp('temp_folder');
                $this->returnJson(array('status' => 'ok', 'msg' => 'Update success', 'redirect' => $data['controller'] . '/' . $data['function']));
            }
            else
                $this->returnJson(array('status' => 'error', 'msg' => 'Failed when updating data'));
            $this->delete_temp('temp_folder');
        }
        else
            $this->returnJson(array('status' => 'error', 'msg' => 'Please complete the form'));
    }

    function news_delete() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Admin News', 'news');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_DELETE);
        $id = $this->input->post('id');
        $do_delete = $this->model_basic->delete($this->tbl_news, 'id', $id);
        if ($do_delete) {
            $this->delete_folder('news/' . $id);
            $this->returnJson(array('status' => 'ok', 'msg' => 'Delete Success', 'redirect' => $data['controller'] . '/' . $data['function']));
        }
        else
            $this->returnJson(array('status' => 'error', 'msg' => 'Delete Failed'));
    }
    
    function news_images($id)
    {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('News Images', 'news');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_READ);
        if ($id) {
            $data['data'] = $this->model_basic->select_where($this->tbl_news, 'id', $id)->row();
        }
        else
            $data['data'] = null;
        $data['content'] = $this->load->view('backend/admin_site_content/news_images', $data, true);
        $this->load->view('backend/index', $data);
    }
    
    function news_photo_landscape()
    {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('News Photo Landscape', 'news');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_READ);
        $id = $this->input->post('id');
        if ($id) {
            $data['data'] = $this->model_basic->select_where($this->tbl_news, 'id', $id)->row();
        }
        else
            $data['data'] = null;
        $data['content'] = $this->load->view('backend/admin_site_content/news_photo_landscape', $data, true);
        $this->load->view('backend/index', $data);
    }
    
    function photo_landscape_edit()
    {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('News Photo Landscape', 'news');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_UPDATE);
        
        $foto = $this->input->post('photo_landscape');
        $old_foto = $this->input->post('old_photo_landscape');
        $img_name_crop = uniqid() . '-news.jpg';
        $update = array();
        $update['id'] = $this->input->post('id');
        $update['date_modified'] = date('Y-m-d H:i:s', now());
        $update['id_modifier'] = $this->session_admin['admin_id'];
        if (($foto && (basename($foto) != $old_foto)) || ($this->input->post('x') || $this->input->post('y') || $this->input->post('w') || $this->input->post('h')))
            $update['photo_landscape'] = $img_name_crop;
        else
            $update['photo_landscape'] = $this->input->post('old_photo_landscape');
        if ($update['photo_landscape']) {
            $do_update = $this->model_basic->update($this->tbl_news, $update, 'id', $update['id']);
            if ($do_update)
            {
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
                    if (!is_dir(FCPATH . 'assets/uploads/news/' . $update['id']))
                        mkdir(FCPATH . 'assets/uploads/news/' . $update['id']);

                    if (basename($foto) && $foto != null)
                        $src = $this->input->post('photo_landscape');
                    else if ($this->input->post('x') || $this->input->post('y') || $this->input->post('w') || $this->input->post('h'))
                        $src = "assets/uploads/news/" . $update['id'] . '/' . $old_foto;
                    # inisial handle copy gambar
                    $ext = pathinfo($src, PATHINFO_EXTENSION);

                    if ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'JPG' || $ext == 'JPEG')
                        $img_r = imagecreatefromjpeg($src);
                    if ($ext == 'png' || $ext == 'PNG')
                        $img_r = imagecreatefrompng($src);
                    if ($ext == 'gif' || $ext == 'GIF')
                        $img_r = imagecreatefromgif($src);

                    $dst_r = ImageCreateTrueColor($targ_w, $targ_h);
                    # simpan hasil croping pada folder lain
                    $path_img_crop = realpath(FCPATH . "assets/uploads/news/" . $update['id']);
                    # nama gambar yg di crop
                    # proses copy
                    imagecopyresampled($dst_r, $img_r, 0, 0, $x, $y, $targ_w, $targ_h, $targ_w, $targ_h);
                    # buat gambar
                    if (imagejpeg($dst_r, $path_img_crop . '/' . $img_name_crop, $jpeg_quality))
                        @unlink('assets/uploads/news/' . $update['id'] . '/' . $this->input->post('old_photo_landscape'));
                    $this->delete_temp('temp_folder');
                }
                $this->returnJson(array('status' => 'ok', 'msg' => 'Update success', 'redirect' => $data['controller'] . '/news_images/'.$update['id']));
            }
            else
                $this->returnJson(array('status' => 'error', 'msg' => 'Failed when updating data'));
            $this->delete_temp('temp_folder');
        }
        else
            $this->returnJson(array('status' => 'error', 'msg' => 'Please complete the form'));
    }

}