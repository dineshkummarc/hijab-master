<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_product extends PX_Model {
	public function __construct() {
		parent::__construct();
	}

	function get_join_customers($id){
            $this->db->select($this->tbl_customer.'.id,'.
            $this->tbl_customer.'.photo,'.
            $this->tbl_customer.'.nama_depan,'.
            $this->tbl_customer.'.nama_belakang,'.
            $this->tbl_customer_billing_address.'.address,'.
            $this->tbl_customer_billing_address.'.province,'.
            $this->tbl_customer_billing_address.'.city,'.
            $this->tbl_customer_billing_address.'.region,'.
            $this->tbl_customer_billing_address.'.postal_code,'.
            $this->tbl_customer_billing_address.'.phone'
        );
        $this->db->from($this->tbl_customer);
        $this->db->join($this->tbl_customer_billing_address, $this->tbl_customer.'.id'.' = '.$this->tbl_customer_billing_address.'.customer_id');
        $this->db->where($this->tbl_customer.'.id',$id);
        $data = $this->db->get();
        return $data->row();
    }
    function group_product($group){
        $this->db->select($this->tbl_product.'.*,'.
            $this->tbl_group.'.id as id_group,'.
            $this->tbl_group.'.name as name_group'
        );
        $this->db->from($this->tbl_product);
        $this->db->join($this->tbl_product_group,$this->tbl_product_group.'.product_id'.'='.$this->tbl_product.'.id');
        $this->db->join($this->tbl_group,$this->tbl_group.'.id'.'='.$this->tbl_product_group.'.group_id');
        $this->db->where($this->tbl_product.'.delete_flag',0);
        $this->db->where($this->tbl_group.'.id',$group);
        return $this->db->get();
    }
}