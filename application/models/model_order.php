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

    function order_by_city(){
        return
        $this->db->select('c.name city_name, count(c.name) city_total')
                 ->from($this->tbl_order.' a')
                 ->join($this->tbl_customer_shipping_address.' b', 'a.ship_address_id = b.id')
                 ->join($this->tbl_shipping_city.' c', 'b.city = c.id_city')
                 ->group_by('c.name')
                 ->order_by('city_total', 'desc')
                 ->get();
    }

    function get_monthly_income(){
        $query = "SELECT MONTHNAME(date_created) month,YEAR(date_created) year, SUM(total_payment) total
                  FROM px_order
                  GROUP BY YEAR(date_created), MONTH(date_created)
                  limit 12
                 ";
        return $this->db->query($query);
        // ->get();
    }
}
