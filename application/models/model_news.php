<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_news extends PX_Model {
	
	public function __construct() {
		parent::__construct();
	}
	function get_paging_news($limit,$from) {
		$this->db->select('*');
		$this->db->from($this->tbl_news);
		$this->db->limit($limit,$from);
		$this->db->order_by('id', 'DESC');
		return $this->db->get()->result();
	}
        function get_paging_notices($limit,$from) {
		$this->db->select('*');
		$this->db->from($this->tbl_news);
		$this->db->limit($limit,$from);
                $this->db->where('type_id', 1);
		$this->db->order_by('id', 'DESC');
		return $this->db->get()->result();
	}
        function get_paging_events($limit,$from) {
		$this->db->select('*');
		$this->db->from($this->tbl_news);
		$this->db->limit($limit,$from);
                $this->db->where('type_id', 2);
		$this->db->order_by('id', 'DESC');
		return $this->db->get()->result();
	}
}