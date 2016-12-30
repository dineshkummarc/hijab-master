<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_user extends PX_Model {
	
	public function __construct() {
		parent::__construct();
	}
	function get_all(){
		$this->db->select($this->tbl_user.'.*,'.$this->tbl_usergroup.'.usergroup_name');
		$this->db->from($this->tbl_user);
		$this->db->join($this->tbl_usergroup,$this->tbl_usergroup.'.id = '.$this->tbl_user.'.id_usergroup','left');
		return $this->db->get()->result();
	}
}