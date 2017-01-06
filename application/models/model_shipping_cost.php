<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_shipping_cost extends PX_Model {

    public function __construct() {
        parent::__construct();
    }
    
    //datatable
    private function _get_datatables_query_shipping_cost() {
        $column = array(
            $this->tbl_shipping_region . '.id',
            $this->tbl_shipping_province . '.name',
            $this->tbl_shipping_city . '.name',
            $this->tbl_shipping_region . '.name',
            $this->tbl_shipping_region . '.price',
            $this->tbl_shipping_service.'.name');
        $this->db->select(array(
            $this->tbl_shipping_region . '.id',
            $this->tbl_shipping_province . '.name as province',
            $this->tbl_shipping_city . '.name as city',
            $this->tbl_shipping_region . '.name',
            $this->tbl_shipping_region . '.price',
            $this->tbl_shipping_service.'.name as services'));

        $this->db->from($this->tbl_shipping_region);
        $this->db->join($this->tbl_shipping_province, $this->tbl_shipping_region . '.id_province = ' . $this->tbl_shipping_province . '.id');
        $this->db->join($this->tbl_shipping_city, $this->tbl_shipping_region . '.id_city = ' . $this->tbl_shipping_city . '.id');
        $this->db->join($this->tbl_shipping_service, $this->tbl_shipping_region . '.service = ' . $this->tbl_shipping_service . '.id');
        $i = 0;
        $where = "";

        foreach ($column as $item) {
            if ($_POST['search']['value']) {
                if ($i == 0) {
                    $where .= "(" . $item . " LIKE '%" . $_POST['search']['value'] . "%' ";
                } else {
                    $where .= "OR " . $item . " LIKE '%" . $_POST['search']['value'] . "%' ";
                }

                if ($i == (count($column) - 1)) {
                    $where .= ")";
                    $this->db->where($where);
                }
            }

            $column[$i] = $item;
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('name', 'DESC');
        }
    }

    function get_datatables_shipping_cost() {
        $this->_get_datatables_query_shipping_cost();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);

        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered_shipping_cost() {
        $this->_get_datatables_query_shipping_cost();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_shipping_cost() {
        $this->db->from($this->tbl_shipping_region);
        return $this->db->count_all_results();
    }
}
