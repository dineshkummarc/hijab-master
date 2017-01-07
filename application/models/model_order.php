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
}
