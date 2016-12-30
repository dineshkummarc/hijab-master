<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class PX_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // DEFAULT TIME ZONE
        date_default_timezone_set('Asia/Jakarta');

        // TABLE 
        $this->tbl_prefix = 'px_';
        $this->tbl_adm_config = $this->tbl_prefix . 'adm_config';
        $this->tbl_album = $this->tbl_prefix . 'album';
        $this->tbl_album_files = $this->tbl_prefix . 'album_files';
        $this->tbl_banner = $this->tbl_prefix.'banner';
        $this->tbl_brand = $this->tbl_prefix.'brand';
        $this->tbl_color = $this->tbl_prefix.'color';
        $this->tbl_customer = $this->tbl_prefix.'customer';
        $this->tbl_customer_billing_address = $this->tbl_prefix.'customer_billing_address';
        $this->tbl_editor_picks = $this->tbl_prefix.'editor_picks';
        $this->tbl_flag = $this->tbl_prefix.'flag';
        $this->tbl_group = $this->tbl_prefix.'group';
        $this->tbl_jasa_pengiriman = $this->tbl_prefix.'jasa_pengiriman';
        $this->tbl_order = $this->tbl_prefix.'order';
        $this->tbl_product = $this->tbl_prefix.'product';
        $this->tbl_product_category = $this->tbl_prefix.'product_category';
        $this->tbl_product_color = $this->tbl_prefix.'product_color';
        $this->tbl_product_editor_picks = $this->tbl_prefix.'product_editor_picks';
        $this->tbl_product_group = $this->tbl_prefix.'product_group';
        $this->tbl_product_image = $this->tbl_prefix.'product_image';
        $this->tbl_product_size = $this->tbl_prefix.'product_size';
        $this->tbl_product_stock = $this->tbl_prefix.'product_stock';
        $this->tbl_product_order = $this->tbl_prefix.'product_order';
        $this->tbl_master_data = $this->tbl_prefix . 'master_data';
        $this->tbl_menu = $this->tbl_prefix . 'menu';
        $this->tbl_news = $this->tbl_prefix . 'news';
        $this->tbl_shipping_address = $this->tbl_prefix. 'shipping_address';
        $this->tbl_shipping_city = $this->tbl_prefix. 'shipping_city';
        $this->tbl_shipping_province = $this->tbl_prefix. 'shipping_province';
        $this->tbl_shipping_region = $this->tbl_prefix. 'shipping_region';
        $this->tbl_size = $this->tbl_prefix.'size';
        $this->tbl_static_content = $this->tbl_prefix . 'static_content';
        $this->tbl_tracking_system = $this->tbl_prefix.'tracking_system';
        $this->tbl_tracking_status = $this->tbl_prefix.'tracking_status';
        $this->tbl_user = $this->tbl_prefix . 'user';
        $this->tbl_useraccess = $this->tbl_prefix . 'useraccess';
        $this->tbl_usergroup = $this->tbl_prefix . 'usergroup';
        $this->tbl_cart = $this->tbl_prefix. 'cart';
        $this->tbl_wishlist = $this->tbl_prefix. 'wishlist';
        $this->tbl_underconstruct_status = $this->tbl_prefix. 'underconstruct_status';
        $this->tbl_tracking_status = $this->tbl_prefix.'tracking_status';
        $this->tbl_flag = $this->tbl_prefix. 'flag';
        // MODELS
        $this->load->model('model_basic');
        $this->load->model('model_menu');
        $this->load->model('model_news');
        $this->load->model('model_stock');
        $this->load->model('model_user');
        $this->load->model('model_useraccess');
        $this->load->model('model_usergroup');
        $this->load->model('model_master');
        // sessions
        if ($this->session->userdata('admin') != FALSE)
            $this->session_admin = $this->session->userdata('admin');
        else {
            $this->session_admin = array(
                'admin_id' => 0,
                'username' => 'GUEST',
                'password' => ' ',
                'realname' => 'GUEST',
                'email' => 'GUEST@LOCAL.DEV',
                'id_usergroup' => 0,
                'name_usergroup' => 'GUEST',
                'photo' => 'THUMB.png'
            );
        }
    }

    function get_app_settings() {
        $d_row = $this->model_basic->select_all_limit($this->tbl_adm_config, 1)->row();
        $data['app_id'] = $d_row->id;
        $data['app_title'] = $d_row->title;
        $data['app_desc'] = $d_row->desc;
        $data['app_login_logo'] = $d_row->login_logo;
        $data['app_mini_logo'] = $d_row->mini_logo;
        $data['app_single_logo'] = $d_row->single_logo;
        $data['app_mini_logo'] = $d_row->mini_logo;
        $data['app_favicon_logo'] = $d_row->favicon_logo;
        $data['gallery_footer'] = $this->model_basic->get_paging($this->tbl_album_files, 10, 0, 'id', 'DESC');
        $data['footer_about_us'] = $this->model_basic->select_where($this->tbl_static_content, 'id', 2)->row();
        $data['footer_contact_us'] = $this->model_basic->select_where($this->tbl_static_content, 'id', 1)->row();

        return $data;
    }

    function get_content_url($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $contents = curl_exec($ch);
        if (curl_errno($ch)) {
            return FALSE;
        } else {
            curl_close($ch);
        }

        if (!is_string($contents) || !strlen($contents)) {
            return FALSE;
        }
        return $contents;
    }

    function makeThumbnails($updir, $img, $width, $height) {
        $thumbnail_width = $width;
        $thumbnail_height = $height;
        $thumb_beforeword = "thumb";
        $arr_image_details = getimagesize("$updir" . "$img"); // pass id to thumb name
        $original_width = $arr_image_details[0];
        $original_height = $arr_image_details[1];
        if ($original_width > $original_height) {
            $new_width = $thumbnail_width;
            $new_height = intval($original_height * $new_width / $original_width);
        } else {
            $new_height = $thumbnail_height;
            $new_width = intval($original_width * $new_height / $original_height);
        }
        $dest_x = intval(($thumbnail_width - $new_width) / 2);
        $dest_y = intval(($thumbnail_height - $new_height) / 2);
        if ($arr_image_details[2] == 1) {
            $imgt = "ImageGIF";
            $imgcreatefrom = "ImageCreateFromGIF";
        }
        if ($arr_image_details[2] == 2) {
            $imgt = "ImageJPEG";
            $imgcreatefrom = "ImageCreateFromJPEG";
        }
        if ($arr_image_details[2] == 3) {
            $imgt = "ImagePNG";
            $imgcreatefrom = "ImageCreateFromPNG";
        }
        if ($imgt) {
            $old_image = $imgcreatefrom("$updir" . "$img");
            $new_image = imagecreatetruecolor($thumbnail_width, $thumbnail_height);
            imagecopyresized($new_image, $old_image, $dest_x, $dest_y, 0, 0, $new_width, $new_height, $original_width, $original_height);
            $imgt($new_image, "$updir" . "$thumb_beforeword" . "$img");
        }
    }

    function get_function($name, $function) {
        $data['function_name'] = $name;
        $data['function'] = $function;
        $data['function_form'] = $function . '_form';
        $data['function_add'] = $function . '_add';
        $data['function_edit'] = $function . '_edit';
        $data['function_delete'] = $function . '_delete';
        $data['function_get'] = $function . '_get';
        $menu_id = $this->model_basic->select_where($this->tbl_menu, 'target', $function)->row();
        if ($menu_id)
            $data['function_id'] = $menu_id->id;
        else
            $data['function_id'] = 0;
        return $data;
    }

    function get_menu() {
        $menu = $this->model_menu->get_menu_bar($this->session_admin['id_usergroup']);
        $submenu = $this->model_menu->get_sub_menu($this->session_admin['id_usergroup']);
        $data = array();
        foreach ($menu as $m) {
            $data[$m->id_menu] = $m;
            $m->submenu = array();
        }
        foreach ($submenu as $sm) {
            $data[$sm->id_parent]->submenu[] = $sm;
        }
        $data['menu'] = $data;
        return $data;
    }

    function get_all_menu() {
        $menu = $this->model_basic->select_where_order($this->tbl_menu, 'id_parent', '0', 'orders', 'ASC')->result();
        $submenu = $this->model_basic->select_where_order($this->tbl_menu, 'id_parent >', '0', 'orders', 'ASC')->result();
        $data = array();
        foreach ($menu as $m) {
            $data[$m->id] = $m;
            $m->submenu = array();
        }
        foreach ($submenu as $sm) {
            $data[$sm->id_parent]->submenu[] = $sm;
        }
        return $data;
    }

    function check_login() {
        if ($this->session->userdata('admin') == FALSE) {
            redirect('admin');
        }
        else
            return true;
    }

    function check_userakses($menu_id, $function, $user = 'admin') {
        if ($user == 'admin')
            $group_id = $this->session_admin['id_usergroup'];
        if ($user == 'member')
            $group_id = $this->session->userdata['member']['group_id'];
        $access = $this->model_useraccess->get_useraccess($group_id, $menu_id);
        switch ($function) {
            case 1:
                if ($access->act_read == 1)
                    return TRUE;
                else
                    redirect('admin');
                break;
            case 2:
                if ($access->act_create == 1)
                    return TRUE;
                else
                    redirect('admin');
                break;
            case 3:
                if ($access->act_update == 1)
                    return TRUE;
                else
                    redirect('admin');
                break;
            case 4:
                if ($access->act_delete == 1)
                    return TRUE;
                else
                    redirect('admin');
                break;
        }
    }

    function delete_temp($folder) {
        if ($this->session->userdata($folder) != FALSE) {
            $temp_folder = $this->session->userdata($folder);
            $files = glob(FCPATH . "assets/uploads/temp/" . $temp_folder . "/{,.}*", GLOB_BRACE);
            foreach ($files as $file) {
                if (is_file($file))
                    @unlink($file);
            }
            @rmdir(FCPATH . "assets/uploads/temp/" . $temp_folder);
            $this->session->unset_userdata($folder);
        }
    }

    function delete_folder($folder) {
        $files = glob(FCPATH . "assets/uploads/" . $folder . "/{,.}*", GLOB_BRACE);
        foreach ($files as $file) {
            if (is_file($file))
                @unlink($file);
        }
        @rmdir(FCPATH . "assets/uploads/" . $folder);
    }

    function format_log() {
        $log['id_log_type'];
        $log['id_user'];
        $log['desc'];
        $log['date_created'];
    }

    function save_log($data) {
        if ($this->model_basic->insert_all($this->tbl_logs, $data))
            return true;
        else
            return false;
    }

    function returnJson($msg) {
        echo json_encode($msg);
        exit;
    }

    function indonesian_currency($number) {
        $result = 'Rp. ' . number_format($number, 0, '', '.');
        return $result;
    }

    function invoiceGenerator(){
        $prefix = "HDINV";
        $a = mt_rand(100000000,999999999);

        return $prefix. $a;
    }

    function do_underconstruct() {
        $data = $this->model_basic->select_where($this->tbl_underconstruct_status, 'id', 1)->row();
        if($data->underconstruct_status == 1)
        {
            if ($this->session->userdata('admin') == FALSE) {
                redirect('underconstruction');
            } else
                return TRUE;
        }
    }

}
