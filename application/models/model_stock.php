<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_stock extends PX_Model {
	
	public function __construct() {
		parent::__construct();
	}

	function select_color($table,$column,$where){
		$this->db->select('distinct(color_id)');
		$this->db->from($table);
		$this->db->where($column,$where);
		$data = $this->db->get();
		return $data;
	}

	function select_size($table,$column,$where){
		$this->db->select('distinct(size_id)');
		$this->db->from($table);
		$this->db->where($column,$where);
		$data = $this->db->get();
		return $data;
	}

	function select_editor($table,$column,$where){
		$this->db->select('distinct(editor_picks_id)');
		$this->db->from($table);
		$this->db->where($column,$where);
		$data = $this->db->get();
		return $data;
	}

	function select_group($table,$column,$where){
		$this->db->select('distinct(group_id)');
		$this->db->from($table);
		$this->db->where($column,$where);
		$data = $this->db->get();
		return $data;
	}

	function get_data_stock_by_condition($product_id, $size, $color){
		$this->db->select('*');
		$this->db->where('size_id', $size);
		$this->db->where('color_id', $color);
		$this->db->where('product_id', $product_id);
		$data = $this->db->get($this->tbl_product_stock);
		return $data;
	}

	function get_data_not_in($product_id, $stock_id)
	{
		$this->db->select('*');
		$this->db->where('product_id', $product_id);
		$this->db->where_not_in('id', $stock_id);
		$data = $this->db->get($this->tbl_product_stock);
		return $data;
	}

	function sum_stock($product_id){
        $this->db->select_sum('stock');
        $this->db->where('product_id',$product_id);
        $data = $this->db->get($this->tbl_product_stock);
        return $data;
    }

    function check_stock($product_id, $color_id, $size_id)
    {
    	$this->db->select('stock');
    	$this->db->where('product_id', $product_id);
    	$this->db->where('color_id', $color_id);
    	$this->db->where('size_id', $size_id);

    	$data = $this->db->get($this->tbl_product_stock);
    	return $data;
    }

    	function select_size_color($product, $color){
		$this->db->select('distinct(a.size_id), b.name, a.stock');
		$this->db->from($this->tbl_product_stock.' a');
		$this->db->join($this->tbl_size.' b', 'b.id = a.size_id', 'left');
		$this->db->where('a.product_id',$product);
		$this->db->where('a.color_id', $color);
		$data = $this->db->get();
		return $data;
	}
}