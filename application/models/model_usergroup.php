<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_usergroup extends PX_Model {
	
	public function __construct() {
		parent::__construct();
	}
	function get_all(){
		$this->db->select($this->tbl_usergroup.'.*');
		$this->db->from($this->tbl_usergroup);
		return $this->db->get()->result();
	}
}