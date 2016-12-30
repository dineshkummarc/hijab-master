<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_excel extends PX_Model {
    public function __construct() {
        parent::__construct();
    }

    function get_customer_all(){
        $this->db->select($this->tbl_customer . '.*,' .
            $this->tbl_customer_billing_address . '.*,' .
            $this->tbl_shipping_province . '.id,' .
            $this->tbl_shipping_city . '.id,' .
            $this->tbl_shipping_region . '.id, ' .
            $this->tbl_shipping_province . '.name as provinsi,' .
            $this->tbl_shipping_city . '.name as kota,' .
            $this->tbl_shipping_region . '.name as kecamatan');
        $this->db->from($this->tbl_customer_billing_address);
        $this->db->join($this->tbl_customer, $this->tbl_customer_billing_address.'.customer_id'.' = '.$this->tbl_customer.'.id');
        $this->db->join($this->tbl_shipping_province, $this->tbl_customer_billing_address.'.province'.' = '.$this->tbl_shipping_province.'.id');
        $this->db->join($this->tbl_shipping_city, $this->tbl_customer_billing_address.'.city'.' = '.$this->tbl_shipping_city.'.id');
        $this->db->join($this->tbl_shipping_region, $this->tbl_customer_billing_address.'.region'.' = '.$this->tbl_shipping_region.'.id');
        $data = $this->db->get();
        return $data;
    }

    function get_penjualan_item(){
        $this->db->select($this->tbl_product . '.*,' .
            $this->tbl_product_stock. '.*,' .
            $this->tbl_size. '.id,' .
            $this->tbl_size. '.name as ukuran,' .
            $this->tbl_color. '.id,' .
            $this->tbl_color. '.name as warna');
        $this->db->from($this->tbl_product_stock);
        $this->db->join($this->tbl_product, $this->tbl_product_stock.'.product_id'.' = '.$this->tbl_product.'.id');
        $this->db->join($this->tbl_size, $this->tbl_product_stock.'.size_id'.' = '.$this->tbl_size.'.id');
        $this->db->join($this->tbl_color, $this->tbl_product_stock.'.color_id'.' = '.$this->tbl_color.'.id');
        $data = $this->db->get();
        return $data->result();
    }

    function get_penjualan_order(){
        $this->db->select($this->tbl_product_order. '.*,' .
            $this->tbl_product. '.*,'.
            $this->tbl_order. '.*,'.
            $this->tbl_customer.'.*');
        $this->db->from($this->tbl_product_order);
        $this->db->join($this->tbl_product, $this->tbl_product_order.'.product_id'.' = '.$this->tbl_product. '.id');
        $this->db->join($this->tbl_order, $this->tbl_product_order.'.order_id'.' = '.$this->tbl_order. '.id');
        $this->db->join($this->tbl_customer, $this->tbl_order.'.customer_id'.' = '.$this->tbl_customer. '.id');
        $data = $this->db->get();
        return $data->result();
    }
}