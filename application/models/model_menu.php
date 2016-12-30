<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_menu extends PX_Model {
	
	public function __construct() {
		parent::__construct();
	}
	function get_all(){
		$this->db->select($this->tbl_menu.'.*,parent_menu.name as parent');
		$this->db->from($this->tbl_menu);
		$this->db->join($this->tbl_menu.' as parent_menu','parent_menu.id = '.$this->tbl_menu.'.id_parent','left');
		return $this->db->get()->result();
	}
	function get_menu_bar($user_level){
        $this->db->select('menu.*,menu.id as id_menu');
        $this->db->from($this->tbl_useraccess);
        $this->db->join($this->tbl_menu.' as menu','menu.id = '.$this->tbl_useraccess.'.id_menu');
        $this->db->where('menu.id_parent',0);
        $this->db->where($this->tbl_useraccess.'.act_read',1);
        $this->db->where($this->tbl_useraccess.'.id_usergroup',$user_level);
        $this->db->order_by('orders','ASC');
        return $this->db->get()->result();
    }
    function get_sub_menu($user_level){
        $this->db->select('menu.*');
        $this->db->from($this->tbl_useraccess);
        $this->db->join($this->tbl_menu.' as menu','menu.id = '.$this->tbl_useraccess.'.id_menu');
        $this->db->where('menu.id_parent >','0');
        $this->db->where($this->tbl_useraccess.'.act_read',1);
        $this->db->where($this->tbl_useraccess.'.id_usergroup',$user_level);
        $this->db->order_by('orders','ASC');
        return $this->db->get()->result();
    }
}