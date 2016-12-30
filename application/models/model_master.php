<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_master extends PX_Model {
	
	public function __construct() {
		parent::__construct();
	}
	function get_all($id_parent){
		$this->db->select($this->tbl_master_data.'.*');
		$this->db->from($this->tbl_master_data);
		$this->db->where('id_parent',$id_parent);
		return $this->db->get()->result();
	}
}