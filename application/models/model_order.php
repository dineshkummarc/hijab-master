<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_order extends PX_Model {

    public function __construct() {
        parent::__construct();
    }
    
    function update_amount_stock($product_stock_id, $operator, $value)
    {
        if($operator == 1)
            $operand = '+';
        else
            $operand = '-';
        $this->db->set('stock', 'stock'.$operand.$value, FALSE);
        $this->db->where('id', $product_stock_id);
        if(!$this->db->update($this->tbl_product_stock))
            return FALSE;
        return TRUE;
    }
    
    function get_order_confirm($customer_id){
        $this->load->database('default',TRUE);
        $this->db->select('*');
        $this->db->from($this->tbl_order_confirmation);
        $this->db->join($this->tbl_order,$this->tbl_order.'.id = '.$this->tbl_order_confirmation.'.order_id');
        $this->db->where($this->tbl_order.'.customer_id', $customer_id);
        return $this->db->get()->result();
    }
}
