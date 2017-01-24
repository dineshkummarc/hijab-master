<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_shop extends PX_Model {
	public function __construct() {
		parent::__construct();
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

}

/* End of file model_shop.php */
/* Location: ./application/models/model_shop.php */