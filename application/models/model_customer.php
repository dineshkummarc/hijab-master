<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_customer extends PX_Model {
    var $column = array('id', 'email', 'nama_depan'); //set column field database for order and search
    var $order = array('id' => 'desc'); // default order 

	public function __construct() {
		parent::__construct();
	}

    private function _get_datatables_query()
    {
    
      $this->db->from($this->tbl_customer);

        $i = 0;
    
        foreach ($this->column as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND. 
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if(count($this->column) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $column[$i] = $item; // set column array variable to order processing
            $i++;
        }
        
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

	function get_customer_all(){
		$this->db->select('*');
		$this->db->from($this->tbl_customer);
		$this->db->join($this->tbl_customer_billing_address, $this->tbl_customer.'.id'.' = '.$this->tbl_customer_billing_address.'.customer_id');
		$data = $this->db->get();
		return $data;
	}

	function get_join_customers($id){
        $this->db->select($this->tbl_customer.'.id,'.
            $this->tbl_customer.'.photo,'.
            $this->tbl_customer.'.nama_depan,'.
            $this->tbl_customer.'.nama_belakang,'.
            $this->tbl_customer_billing_address.'.address,'.
            $this->tbl_customer_billing_address.'.province,'.
            $this->tbl_customer_billing_address.'.city,'.
            $this->tbl_customer_billing_address.'.region,'.
            $this->tbl_customer_billing_address.'.postal_code,'.
            $this->tbl_customer_billing_address.'.phone'
        );
        $this->db->from($this->tbl_customer);
        $this->db->join($this->tbl_customer_billing_address, $this->tbl_customer.'.id'.' = '.$this->tbl_customer_billing_address.'.customer_id');
        $this->db->where($this->tbl_customer.'.id',$id);
        $data = $this->db->get();
        return $data->row();
    }

    // Datatable Serverside
  function get_datatables()
  {
    $this->_get_datatables_query();
    if($_POST['length'] != -1)
    $this->db->limit($_POST['length'], $_POST['start']);
    $query = $this->db->get();
    return $query->result();
  }

  function count_filtered()
  {
    $this->_get_datatables_query();
    $query = $this->db->get();
    return $query->num_rows();
  }

  public function count_all()
  {
    $this->db->from($this->tbl_customer);
    return $this->db->count_all_results();
  }

  public function get_by_id($id)
  {
    $this->db->from($this->tbl_customer);
    $this->db->where('id',$id);
    $query = $this->db->get();

    return $query->row();
  }

  public function save($data)
  {
    $this->db->insert($this->tbl_customer, $data);
    return $this->db->insert_id();
  }

  public function update($where, $data)
  {
    $this->db->update($this->tbl_customer, $data, $where);
    return $this->db->affected_rows();
  }

  public function delete_by_id($id)
  {
    $this->db->where('id', $id);
    $this->db->delete($this->tbl_customer);
  }
}