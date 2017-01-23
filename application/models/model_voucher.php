<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_voucher extends PX_Model {

    public function __construct() {
        parent::__construct();
    }
    
    function history_voucher_get()
    {
        return
        $this->db->select('a.id order_id, a.invoice_number, b.voucher')
                 ->from($this->tbl_order.' a')
                 ->join($this->tbl_voucher.' b', 'a.voucher_id = b.id')
                 ->where('a.status', 2)
                 ->get();
    }
}
