<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class PX_Model extends CI_Model {

    function __construct() {
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
        $this->tbl_category = $this->tbl_prefix.'category';
        $this->tbl_product_editor_picks = $this->tbl_prefix.'product_editor_picks';
        $this->tbl_product_group = $this->tbl_prefix.'product_group';
        $this->tbl_product_image = $this->tbl_prefix.'product_image';
        $this->tbl_product_stock = $this->tbl_prefix.'product_stock';
        $this->tbl_product_order = $this->tbl_prefix.'product_order';
        $this->tbl_master_data = $this->tbl_prefix . 'master_data';
        $this->tbl_menu = $this->tbl_prefix . 'menu';
        $this->tbl_news = $this->tbl_prefix . 'news';
        $this->tbl_shipping_address = $this->tbl_prefix. 'customer_shipping_address';
        $this->tbl_shipping_city = $this->tbl_prefix. 'shipping_city';
        $this->tbl_shipping_province = $this->tbl_prefix. 'shipping_province';
        $this->tbl_shipping_region = $this->tbl_prefix. 'shipping_region';
        $this->tbl_shipping_service = $this->tbl_prefix. 'shipping_service';
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
    }
}
