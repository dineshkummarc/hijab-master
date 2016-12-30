<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_basic extends PX_Model {
	
	public function __construct() {
		parent::__construct();
	}
	function get_count($table){
		$this->load->database('default',TRUE);
		$this->db->select('*');
		$this->db->from($table);
		return $this->db->get()->num_rows();
	}
	function select_all($table){
		$this->load->database('default',TRUE);
		$this->db->select('*');
		$this->db->from($table);
		$data = $this->db->get();
		return $data->result();
	}
	function select_where($table,$column,$where){
		$this->load->database('default',TRUE);
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($column,$where);
		$data = $this->db->get();
		return $data;
	}
	function select_where_group($table,$column,$where,$group){
		$this->load->database('default',TRUE);
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($column,$where);
		$this->db->group_by($group);
		$data = $this->db->get();
		return $data;
	}
	function select_where_order($table,$column,$where,$order_by,$order_type){
		$this->load->database('default',TRUE);
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($column,$where);
                $this->db->order_by($order_by, $order_type);
		$data = $this->db->get();
		return $data;
	}
	function select_where_double($table,$column,$where,$column2,$where2){
		$this->load->database('default',TRUE);
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($column,$where);
        $this->db->where($column2, $where2);
		$data = $this->db->get();
		return $data;
	}
    function select_where_double_order($table,$column,$where,$column2,$where2,$order_by, $order_type){
        $this->load->database('default',TRUE);
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($column,$where);
        $this->db->where($column2, $where2);
        $this->db->order_by($order_by, $order_type);
        $data = $this->db->get();
        return $data;
    }
        function select_where_limit_order($table,$column,$where,$limit,$order_by,$order_type){
		$this->load->database('default',TRUE);
		$this->db->select('*');
		$this->db->where($column,$where);
                $this->db->order_by($order_by, $order_type);
		$data = $this->db->get($table,$limit);
		return $data;
	}
	function select_where_array($table,$where){
		$this->load->database('default',TRUE);
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($where);
		$data = $this->db->get();
		return $data;
	}
	function insert_all($table,$data) {
		$this->load->database('default',TRUE);
		if(!$this->db->insert($table,$data))
			return FALSE;
		$data["id"] = $this->db->insert_id();
		return (object)$data;
	}
	function insert_all_batch($table,$data) {
		$this->load->database('default',TRUE);
		if(!$this->db->insert_batch($table,$data))
			return FALSE;
		$data["id"] = $this->db->insert_id();
		return (object)$data;
	}
	function update($table,$data,$column,$where){
		$this->load->database('default',TRUE);
		$this->db->where($column,$where);
		return $this->db->update($table,$data); 
	}
	function update_one($table,$column,$where,$target,$action){
		$this->db->set($target, $target.$action, FALSE);
		$this->db->where($column, $where);
		return $this->db->update($table);
	}
	function delete($table,$column,$where){
		$this->load->database('default',TRUE);
		$this->db->where($column,$where);
		return $this->db->delete($table);
	}
	function delete_where_array($table,$where){
		$this->load->database('default',TRUE);
		$this->db->where($where);
		return $this->db->delete($table);
	}

    function select_all_limit($table, $limit){
		$this->load->database('default',TRUE);
		$this->db->select('*');
		$data = $this->db->get($table, $limit);
		return $data;
	}
        function select_all_limit_order($table, $limit, $order_by, $order){
		$this->load->database('default',TRUE);
		$this->db->select('*');
                $this->db->order_by($order_by, $order);
		$data = $this->db->get($table, $limit);
		return $data;
	}
	function count($table){
		$this->load->database('default',TRUE);
		$this->db->select('*');
		$this->db->from($table);
		return $this->db->count_all_results();
	} 
    function select_all_order($table, $order_by, $order){
		$this->load->database('default',TRUE);
		$this->db->select('*');
		$this->db->from($table);
        $this->db->order_by($order_by, $order);
		$data = $this->db->get();
		return $data->result();
	}
	function get_paging($table,$limit,$from,$order,$type) {
		$this->db->select('*');
		$this->db->from($table);
		$this->db->limit($limit,$from);
		$this->db->order_by($order,$type);
		return $this->db->get()->result();
	}
        
        function get_paging_where($table,$column,$where,$limit,$from,$order,$type) {
		$this->db->select('*');
		$this->db->from($table);
		$this->db->limit($limit,$from);
                $this->db->where($column,$where);
		$this->db->order_by($order,$type);
		return $this->db->get()->result();
	}
        
        function select_all_limit_random($table, $limit){
		$this->load->database('default',TRUE);
		$this->db->select('*');
                $this->db->order_by('id', 'RANDOM');
                $this->db->limit($limit);
		$this->db->from($table);
		$data = $this->db->get();
		return $data->result();
	}

}