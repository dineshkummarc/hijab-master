<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_order extends PX_Model {
    // var $table = $this->tbl_order;
    var $column = array('o.id', 'invoice_number', 'nama_depan', 'total_payment', 'o.date_created', 'status'); //set column field database for order and search
    var $order = array('o.id' => 'desc'); // default order 

    public function __construct() {
        parent::__construct();
    }
    
    private function _get_datatables_query()
    {
    
      $this->db->select(
        'o.id as id,
         o.invoice_number,
         c.nama_depan as nama_depan,
         c.nama_belakang,
         o.total_payment,
         o.date_created,
         t.title as status,
         t.class_text,
        ');
      $this->db->from($this->tbl_order.' o');
      $this->db->join($this->tbl_customer.' c', 'o.customer_id = c.id');
      $this->db->join($this->tbl_tracking_status.' t', 'o.status = t.id');

      $i = 0;
    
      foreach ($this->column as $item) // loop column 
      {
        if($_POST['search']['value'])
        {
          if($item == 'invoice_number'){
            $item ='o.invoice_number';
          }elseif($item == 'total_payment'){
            $item = 'o.total_payment';
          }elseif($item == 'nama_depan'){
            $item = 'c.nama_depan';
          }elseif($item == 'date_created'){
            $item = 'o.nama_depan';
          }

          ($i===0) ? $this->db->like($item, $_POST['search']['value']) : $this->db->or_like($item, $_POST['search']['value']);
        }
          
        $column[$i] = $item;
        $i++;
      }
      
      if(isset($_POST['order'])) // here order processing
      {
        $this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
      } 
      else if(isset($this->order))
      {
        $order = $this->order;
        $this->db->order_by(key($order), $order[key($order)]);
      }
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

  // Datatable Serverside
  function get_datatables()
  {
    $this->_get_datatables_query();
    if($_POST['length'] != -1)
    $this->db->limit($_POST['length'], $_POST['start']);
    $query = $this->db->get();
    return $query->result();
  }

  function count_filtered()
  {
    $this->_get_datatables_query();
    $query = $this->db->get();
    return $query->num_rows();
  }

  public function count_all()
  {
    $this->db->from($this->tbl_order);
    return $this->db->count_all_results();
  }

  public function get_by_id($id)
  {
    $this->db->from($this->tbl_order);
    $this->db->where('id',$id);
    $query = $this->db->get();

    return $query->row();
  }

  public function save($data)
  {
    $this->db->insert($this->tbl_order, $data);
    return $this->db->insert_id();
  }

  public function update($where, $data)
  {
    $this->db->update($this->tbl_order, $data, $where);
    return $this->db->affected_rows();
  }

  public function delete_by_id($id)
  {
    $this->db->where('id', $id);
    $this->db->delete($this->tbl_order);
  }
}
