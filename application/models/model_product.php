<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_product extends PX_Model {
	public function __construct() {
		parent::__construct();
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

    function search_product($category,$brand,$color,$price,$size){
        $price = explode(",", $price);
         $this->db->select($this->tbl_product.'.*'
        );
        $this->db->from($this->tbl_product);
        $this->db->join($this->tbl_brand,$this->tbl_brand.'.id='.$this->tbl_product.'.brand_id');
        $this->db->join($this->tbl_category,$this->tbl_category.'.id='.$this->tbl_product.'.category_id');
        $this->db->join($this->tbl_product_stock,$this->tbl_product_stock.'.product_id='.$this->tbl_product.'.id');
        $this->db->join($this->tbl_color,$this->tbl_color.'.id='.$this->tbl_product_stock.'.color_id');
        $this->db->join($this->tbl_size,$this->tbl_size.'.id='.$this->tbl_product_stock.'.size_id');
        $this->db->where($this->tbl_product.'.price >=',$price[0]);
        $this->db->where($this->tbl_product.'.price <=',$price[1]);
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
             $a++;
            if($a>1){
         foreach ($size as $key) {
            $this->db->or_like($this->tbl_size.'.id',$key);
            }
        }
        }
        $a=0;
        if($brand!=''){
             $a++;
            if($a>1){
        foreach ($brand as $key) {
            $this->db->or_like($this->tbl_product.'.brand_id',$key);
        }
        }
        }
        $a=0;
        if($color!=''){
             $a++;
            if($a>1){
         foreach ($color as $key) {
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
}