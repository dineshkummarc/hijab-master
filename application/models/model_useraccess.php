<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_useraccess extends PX_Model {
	function __construct() {
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
	}
	function get_all(){
		$this->db->select($this->tbl_useraccess.'.*,grup.usergroup_name as grup_name');
		$this->db->from($this->tbl_useraccess);
		$this->db->join($this->tbl_usergroup.' as grup','grup.id = '.$this->tbl_useraccess.'.id_usergroup','LEFT');
		$this->db->group_by($this->tbl_useraccess.'.id_usergroup');
		return $this->db->get()->result();
	}
	function get_available_user(){
		$this->db->select($this->tbl_usergroup.'.*');
		$this->db->from($this->tbl_usergroup);
		$this->db->join($this->tbl_useraccess.' as akses','akses.id_usergroup = '.$this->tbl_usergroup.'.id','LEFT');
		$this->db->where('akses.id_usergroup',NULL);
		return $this->db->get()->result();
	}
	
    function get_useraccess($group_id, $menu_id)
    {
        $this->db->select('*');
        $this->db->where('id_usergroup', $group_id);
        $this->db->where('id_menu', $menu_id);
        $query = $this->db->get($this->tbl_useraccess);
        return $query->num_rows() == 1 ? $query->row() : FALSE;
    }
}