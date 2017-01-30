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

    function get_product_sold(){
      return $this->db->select('count(a.id) total')
                      ->from('px_product_order a')
                      ->join('px_order b', 'a.order_id = b.id')
                      ->where('b.status = 2')
                      ->get();
    }

    function get_monthly_income(){
        $query = "SELECT MONTHNAME(date_created) month,YEAR(date_created) year, SUM(total_payment) total
                  FROM px_order
                  where status in(2,3) 
                  GROUP BY YEAR(date_created), MONTH(date_created)
                  limit 12
                 ";
        return $this->db->query($query);
        // ->get();
    }

    function get_total_order(){
        $query = "SELECT b.title status, sum(status) total
                  FROM px_order a, px_tracking_status b
                                    where a.status = b.status_id
                  GROUP BY b.title";

        return $this->db->query($query);
    }

    function get_total_customer(){
        $query = "SELECT MONTHNAME(date_created) month,YEAR(date_created) year, count(id) total
                  FROM px_customer
                  GROUP BY YEAR(date_created), MONTH(date_created)
                  limit 12";

        return $this->db->query($query);
    }

     function get_customer($month, $year){
        $query = "select id
                  FROM px_customer
                  where MONTHNAME(date_created) = '$month'
                  and YEAR(date_created)  = '$year'";

        return $this->db->query($query);die($this->db->last_query());
    }

    function get_total_customer_active($month, $year, $cust_id = array()){
      $c = implode(',',$cust_id);
        $query = "SELECT distinct customer_id
                  FROM px_order
                  where MONTHNAME(date_created) = '$month'
                  and YEAR(date_created)  = '$year'
                  and customer_id in ($c)";

        return $this->db->query($query);
    }
}
