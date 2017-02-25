<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_product extends PX_Model {
    var $column = array('id', 'name_product', 'show_flag'); //set column field database for order and search
    var $order = array('name_product' => 'asc'); // default order 

	public function __construct() {
		parent::__construct();
	}

    private function _get_datatables_query()
    {
    
      $this->db->from($this->tbl_product);

        $i = 0;
    
        foreach ($this->column as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND. 
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if(count($this->column) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $column[$i] = $item; // set column array variable to order processing
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

    function group_product_random($group){
        $this->db->select($this->tbl_product.'.*,'.
            $this->tbl_group.'.id as id_group,'.
            $this->tbl_group.'.name as name_group'
        );
        $this->db->from($this->tbl_product);
        $this->db->join($this->tbl_product_group,$this->tbl_product_group.'.product_id'.'='.$this->tbl_product.'.id');
        $this->db->join($this->tbl_group,$this->tbl_group.'.id'.'='.$this->tbl_product_group.'.group_id');
        $this->db->where($this->tbl_product.'.delete_flag',0);
        $this->db->where($this->tbl_group.'.id',$group);
        $this->db->order_by('id', 'RANDOM');
        return $this->db->get();
    }

    function search_product($category,$brand,$color,$price,$size,$name_product){
        $price = explode(",", $price);
        // die(print_r($price));
        $this->db->select($this->tbl_product.'.*');
        $this->db->from($this->tbl_product);
        $this->db->join($this->tbl_brand,$this->tbl_brand.'.id='.$this->tbl_product.'.brand_id');
        $this->db->join($this->tbl_category,$this->tbl_category.'.id='.$this->tbl_product.'.category_id');
        $this->db->join($this->tbl_product_stock,$this->tbl_product_stock.'.product_id='.$this->tbl_product.'.id');
        $this->db->join($this->tbl_color,$this->tbl_color.'.id='.$this->tbl_product_stock.'.color_id');
        $this->db->join($this->tbl_size,$this->tbl_size.'.id='.$this->tbl_product_stock.'.size_id');
        $this->db->where($this->tbl_product.'.price >=',$price[0]);
        $this->db->where($this->tbl_product.'.price <=',$price[1]);
        $this->db->like($this->tbl_product.'.name_product',$name_product);
        if($category!=''){
        $a=0;
        foreach ($category as $key) {
            $a++;
            if($a>1){
            $this->db->or_like($this->tbl_product.'.category_id',$key);
            }
        }
        }
        $a=0;
        if($size!=''){
         foreach ($size as $key) {
            $a++;
            if($a>1){
            $this->db->or_like($this->tbl_size.'.id',$key);
        }
        }
        }
        $a=0;
        if($brand!=''){
        foreach ($brand as $key) {
            $a++;
            if($a>1){
            $this->db->or_like($this->tbl_product.'.brand_id',$key);
        }
        }
        }
        $a=0;
        if($color!=''){
         foreach ($color as $key) {
             $a++;
            if($a>1){
            $this->db->or_like($this->tbl_color.'.id',$key);
            } 
        }
        }
        $this->db->where($this->tbl_product_stock.'.stock >','0');
        $this->db->group_by($this->tbl_product.'.id');
        return $this->db->get();
    }

   function uniq_code() { 
        $q = $this->db->query("SELECT MAX(RIGHT(invoice_number,6)) AS idmax FROM ".$this->tbl_order." WHERE invoice_number LIKE '%".date('Ymd')."%' order by id Desc" )->row();
        $kd = ""; 
        if($q->idmax==null){ 
          $kd = "000001";
        }else{
        	$num=$q->idmax+1;
            if($q->idmax<=9){
            	$kd="00000".$num;
            }elseif($q->idmax<=99){
            	$kd="0000".$num;
            }
            elseif($q->idmax<=999){
            	$kd="000".$num;
            }elseif($q->idmax<=9999){
            	$kd="00".$num;
            }elseif($q->idmax<=99999){
            	$kd="0".$num;
            }elseif($q->idmax<=999999){
            	$kd=$num;
            }
        }
        $kar = "HDINV".date('Ymd');
        return $kar.$kd;
   }

   //denimaru
    function get_product_where($category, $brand, $color, $size, $price, $max, $start)
    {
        $this->db->select('*');
        //category
        $a=0;
        if($category!=''){
            foreach ($category as $key) {
                $a++;
                if($a>1){
                $this->db->or_like($this->tbl_product.'.category_id',$key);
                }
            }
        }
        //size
        $a=0;
            if($size!=''){
                $a++;
                if($a>1){
            foreach ($size as $key) {
                $this->db->or_like($this->tbl_size.'.id',$key);
                }
            }
        }
        //brand
        $a=0;
        if($brand!=''){
            $a++;
            if($a>1){
                foreach ($brand as $key) {
                    $this->db->or_like($this->tbl_product.'.brand_id',$key);
                }
            }
        }
        //color
        $a=0;
            if($color!=''){
                $a++;
            if($a>1){
                foreach ($color as $key) {
                    $this->db->or_like($this->tbl_color.'.id',$key);
                } 
            }
        }

        if($price != NULL)
        {
            $price1 = $price[0];
            $price2 = $price[1];
            $this->db->where('price <=', $price2);
            $this->db->where('price >=', $price1);
        }
        $this->db->where('show_flag', 1);
        $this->db->order_by('id', 'asc');
        $query = $this->db->get($this->tbl_product, $max, $start);
        return $query;
    } 

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
    $this->db->from($this->tbl_product);
    return $this->db->count_all_results();
  }

  public function get_by_id($id)
  {
    $this->db->from($this->tbl_product);
    $this->db->where('id',$id);
    $query = $this->db->get();

    return $query->row();
  }

  public function save($data)
  {
    $this->db->insert($this->tbl_product, $data);
    return $this->db->insert_id();
  }

  public function update($where, $data)
  {
    $this->db->update($this->tbl_product, $data, $where);
    return $this->db->affected_rows();
  }

  public function delete_by_id($id)
  {
    $this->db->where('id', $id);
    $this->db->delete($this->tbl_product);
  }
}