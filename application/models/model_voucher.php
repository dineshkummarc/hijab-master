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
        $this->db->select('a.id order_id, a.invoice_number, b.voucher, c.title AS status')
                 ->from($this->tbl_order.' a')
                 ->join($this->tbl_voucher.' b', 'a.voucher_id = b.id', 'left')
                 ->join($this->tbl_tracking_status.' c', 'a.status = c.id', 'left')
                 ->where('a.status', 3)
                 // ->or_where('a.status', 1)
                 // ->or_where('a.status', 2)
                 // ->or_where('a.status', 4)
                 // ->or_where('a.status', 5)
                 ->get();
    }
}
