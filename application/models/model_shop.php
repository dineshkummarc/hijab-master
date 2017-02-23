<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_shop extends PX_Model {
	public function __construct() {
		parent::__construct();
	}

        function get_product_stock($product_id)
        {
                $this->db->select('SUM(stock) AS stock');
                $this->db->where('product_id', $product_id);
                $query = $this->db->get($this->tbl_product_stock);

                return $query;
        }

	function get_product_count()
	{
		$this->db->select('*');
		$this->db->where('delete_flag', 0);
        $this->db->where('show_flag', 1);
		$query = $this->db->get($this->tbl_product);
		
		return $query->num_rows();
	}

	function get_product_where($sortby, $per_page, $start)
	{
		$this->db->select('*');
		$this->db->where('delete_flag', 0);
        $this->db->where('show_flag', 1);
        if ($sortby) {
        	$this->db->order_by($sortby, 'asc');
        }
		$query = $this->db->get($this->tbl_product, $per_page, $start);
		
		return $query;
	}

	function get_product_where_search_count($search, $category, $brand, $editorspicks, $group, $price, $color, $size, $sortby)
	{
		$this->db->select('d.product_id AS id, a.category_id, a.brand_id, a.name_product, a.price, a.discount, a.description');
		$this->db->join($this->tbl_category.' b', 'b.id = a.category_id', 'left');
		$this->db->join($this->tbl_brand.' c', 'c.id = a.brand_id', 'left');
		$this->db->join($this->tbl_product_stock.' d', 'd.product_id = a.id', 'left');
		$this->db->join($this->tbl_color.' e', 'e.id = d.color_id', 'left');
                $this->db->join($this->tbl_product_editor_picks.' f', 'f.product_id = a.id', 'left');
                $this->db->join($this->tbl_product_group.' g', 'g.product_id = a.id', 'left');
		$this->db->where('a.delete_flag', 0);
                $where = "a.price BETWEEN ".$price[0]." AND ".$price[1];
                if ($price) {
                        $this->db->where($where);
                }
                $this->db->where('a.show_flag', 1);
                if ($category) {
                	foreach ($category as $key => $value) {
                		if ($key == 0) {
                			$this->db->where('a.category_id', $value);
                		}else{
                			$this->db->or_where('a.category_id', $value);
                		}
                		
                	}
                }
                if ($brand) {
                	foreach ($brand as $key => $value) {
                		if ($key == 0) {
                			$this->db->where('a.brand_id', $value);
                		}else{
                			$this->db->or_where('a.brand_id', $value);
                		}
                		
                	}
                }
                if ($editorspicks) {
                        foreach ($editorspicks as $key => $value) {
                                if ($key == 0) {
                                        $this->db->where('f.editor_picks_id', $value);
                                }else{
                                        $this->db->or_where('f.editor_picks_id', $value);
                                }
                                
                        }
                }
                if ($group) {
                        foreach ($group as $key => $value) {
                                if ($key == 0) {
                                        $this->db->where('g.group_id', $value);
                                }else{
                                        $this->db->or_where('g.group_id', $value);
                                }
                                
                        }
                }
                if ($color) {
                        foreach ($color as $key => $value) {
                                if ($key == 0) {
                                        $this->db->where('d.color_id', $value);
                                }else{
                                        $this->db->or_where('d.color_id', $value);
                                }
                                
                        }
                }
                if ($size) {
                        foreach ($size as $key => $value) {
                                if ($key == 0) {
                                        $this->db->where('d.size_id', $value);
                                }else{
                                        $this->db->or_where('d.size_id', $value);
                                }
                                
                        }
                }
                
                if ($search) {
                	$this->db->or_like('a.name_product', $search);
        	        $this->db->or_like('b.name', $search);
        	        $this->db->or_like('c.name', $search);
        	        $this->db->or_like('e.name', $search);
                }
                $this->db->where('d.stock >','0');
                $this->db->group_by('a.id');
                if ($sortby) {
                	$this->db->order_by($sortby, 'asc');
                }
        		$query = $this->db->get($this->tbl_product.' a');
        		
        		return $query->num_rows();
	}

	function get_product_where_search($search, $category, $brand, $editorspicks, $group, $price, $color, $size, $sortby, $per_page, $start)
	{
		$this->db->select('d.product_id AS id, a.category_id, a.brand_id, a.name_product, a.price, a.discount, a.description');
		$this->db->join($this->tbl_category.' b', 'b.id = a.category_id', 'left');
		$this->db->join($this->tbl_brand.' c', 'c.id = a.brand_id', 'left');
		$this->db->join($this->tbl_product_stock.' d', 'd.product_id = a.id', 'left');
		$this->db->join($this->tbl_color.' e', 'e.id = d.color_id', 'left');
                $this->db->join($this->tbl_product_editor_picks.' f', 'f.product_id = a.id', 'left');
                $this->db->join($this->tbl_product_group.' g', 'g.product_id = a.id', 'left');
		$this->db->where('a.delete_flag', 0);
                $where = "a.price BETWEEN ".$price[0]." AND ".$price[1];
                if ($price) {
                        $this->db->where($where);
                }
                
                $this->db->where('a.show_flag', 1);
                if ($category) {
                	foreach ($category as $key => $value) {
                		if ($key == 0) {
                			$this->db->where('a.category_id', $value);
                		}else{
                			$this->db->or_where('a.category_id', $value);
                		}
                		
                	}
                }
                if ($brand) {
                	foreach ($brand as $key => $value) {
                		if ($key == 0) {
                			$this->db->where('a.brand_id', $value);
                		}else{
                			$this->db->or_where('a.brand_id', $value);
                		}
                		
                	}
                }
                if ($editorspicks) {
                        foreach ($editorspicks as $key => $value) {
                                if ($key == 0) {
                                        $this->db->where('f.editor_picks_id', $value);
                                }else{
                                        $this->db->or_where('f.editor_picks_id', $value);
                                }
                                
                        }
                }
                if ($group) {
                        foreach ($group as $key => $value) {
                                if ($key == 0) {
                                        $this->db->where('g.group_id', $value);
                                }else{
                                        $this->db->or_where('g.group_id', $value);
                                }
                                
                        }
                }
                if ($color) {
                        foreach ($color as $key => $value) {
                                if ($key == 0) {
                                        $this->db->where('d.color_id', $value);
                                }else{
                                        $this->db->or_where('d.color_id', $value);
                                }
                                
                        }
                }
                if ($size) {
                        foreach ($size as $key => $value) {
                                if ($key == 0) {
                                        $this->db->where('d.size_id', $value);
                                }else{
                                        $this->db->or_where('d.size_id', $value);
                                }
                                
                        }
                }
                //$this->db->where('d.stock >','0');
                if ($search) {
                	$this->db->or_like('a.name_product', $search);
        	        $this->db->or_like('b.name', $search);
        	        $this->db->or_like('c.name', $search);
        	        $this->db->or_like('e.name', $search);
                }
                $this->db->where('d.stock >','0');
                $this->db->group_by('a.id');
                if ($sortby) {
                	$this->db->order_by($sortby, 'asc');
                }
        		$query = $this->db->get($this->tbl_product.' a', $per_page, $start);
        		
        		return $query;
	}

        function select_customer_order($customer_id, $per_page, $start)
        {
                $this->db->select('*');
                $this->db->where('customer_id', $customer_id);
                $this->db->order_by('date_created', 'desc');
                $query = $this->db->get($this->tbl_order, $per_page, $start);

                return $query;
        }

        function select_customer_order_count($customer_id)
        {
                $this->db->select('*');
                $this->db->from($this->tbl_order);
                $this->db->where('customer_id', $customer_id);
                $this->db->order_by('date_created', 'desc');
                $query = $this->db->get();

                return $query;
        }

}

/* End of file model_shop.php */
/* Location: ./application/models/model_shop.php */