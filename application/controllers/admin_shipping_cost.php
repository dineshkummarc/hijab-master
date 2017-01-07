<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_shipping_cost extends PX_Controller {

    function __construct() {
        parent:: __construct();
        $this->controller_attr = array('controller' => 'admin_shipping_cost', 'controller_name' => 'Admin Shipping Cost', 'controller_id' => 0);
    }

    public function index() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Shipping Cost List','shipping_cost_list');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_READ);
        $data['submenu'] = $this->get_submenu($data['controller']);
        $data['content'] = $this->load->view('backend/shipping_cost/index',$data,true);
        $this->load->view('backend/index',$data);
    }

    function get_all_data_price() {
        set_time_limit(0);
        $i = 1;
        $j = 0;
        //render data
        $subdistrict = $this->model_basic->select_all($this->tbl_shipping_region);
        foreach ($subdistrict as $sd) {
            $shipping_price = $this->get_price_jne($sd);
            if ($shipping_price->cost == 0)
                $shipping_price = $this->get_price_pos($sd);
            if ($shipping_price->cost == 0)
                $j++;
            $string = $i . ";" . $sd->name . ";" . $sd->id_province . ";" . $sd->id_city . ";" . $sd->id_region . ";" . $shipping_price->cost . ';' . $shipping_price->service;
            $array[$i] = $string;
            print_r($string . "<br>");
            $i++;
        }
        echo 'Null Price : ' . $j . ' row';
        $array_result = join("|", $array);
        file_put_contents("D:\\result2.txt", $array_result);
    }

    function get_price_jne($data) {
        $shipping_price = new stdClass();
        $shipping_price->cost = 0;
        $cost = $this->get_price_cost_jne($data->id_region, 'subdistrict');
        foreach ($cost[0]->costs as $c) {
            if ($c['service'] == "REG") {
                $shipping_price->cost = $c['cost'][0]['value'];
                $shipping_price->service = 1;
            }
            if ($shipping_price->cost != 0)
                break;
        }
        if ($shipping_price->cost == 0) {
            $cost = $this->get_price_cost_jne($data->id_city, 'city');
            foreach ($cost[0]->costs as $c) {
                if ($c['service'] == "REG") {
                    $shipping_price->cost = $c['cost'][0]['value'];
                    $shipping_price->service = 1;
                }
                if ($shipping_price->cost != 0)
                    break;
            }
        }
        if ($shipping_price->cost == 0) {
            $cost = $this->get_price_cost_jne($data->id_region, 'subdistrict');
            foreach ($cost[0]->costs as $c) {
                if ($c['service'] == "OKE") {
                    $shipping_price->cost = $c['cost'][0]['value'];
                    $shipping_price->service = 2;
                }
                if ($shipping_price->cost != 0)
                    break;
            }
        }
        if ($shipping_price->cost == 0) {
            $cost = $this->get_price_cost_jne($data->id_city, 'city');
            foreach ($cost[0]->costs as $c) {
                if ($c['service'] == "OKE") {
                    $shipping_price->cost = $c['cost'][0]['value'];
                    $shipping_price->service = 2;
                }
                if ($shipping_price->cost != 0)
                    break;
            }
        }
        return $shipping_price;
    }

    function get_price_pos($data) {
        $shipping_price = new stdClass();
        $shipping_price->cost = 0;
        $cost = $this->get_price_cost_pos($data->id_region, 'subdistrict');
        foreach ($cost[0]->costs as $c) {
            if ($c['service'] == "Surat Kilat Khusus") {
                $shipping_price->cost = $c['cost'][0]['value'];
                $shipping_price->service = 3;
            }
            if ($shipping_price->cost != 0)
                break;
        }
        if ($shipping_price->cost == 0) {
            $cost = $this->get_price_cost_pos($data->id_city, 'city');
            foreach ($cost[0]->costs as $c) {
                if ($c['service'] == "Surat Kilat Khusus") {
                    $shipping_price->cost = $c['cost'][0]['value'];
                    $shipping_price->service = 3;
                }
                if ($shipping_price->cost != 0)
                    break;
            }
        }
        return $shipping_price;
    }

    function get_price_cost_jne($destination, $destination_type) {
        $courier = "jne";
        $weight = 999;
        $origin = 2117; // Jakarta Timur / Jatinegara
        $origin_type = 'subdistrict';
        //$destination_type = "subdistrict";
        $result = $this->model_rajaongkir->get_cost_subdistrict_x($origin, $origin_type, $destination, $destination_type, $weight, $courier);
        //$result = $this->model_rajaongkir->get_cost_x($origin, $destination, $weight, $courier);
        return $result;
    }

    function get_price_cost_pos($destination, $destination_type) {
        $courier = "pos";
        $weight = 999;
        $origin = 2117; // Jakarta Timur / Jatinegara
        $origin_type = 'subdistrict';
        $result = $this->model_rajaongkir->get_cost_subdistrict_x($origin, $origin_type, $destination, $destination_type, $weight, $courier);
        //$result = $this->model_rajaongkir->get_cost_x($origin, $destination, $weight, $courier);
        return $result;
    }

    function check_price() {
        $i = 1;
        //render data
        $subdistrict = $this->model_basic->select_where($this->tbl_shipping_region, 'id', 1)->result();
        $j = 0;
        foreach ($subdistrict as $sd) {
            //$shipping_price = 0;
            $shipping_price = $this->get_price_jne($sd);
            if ($shipping_price->cost == 0)
                $shipping_price = $this->get_price_pos($sd);
            if ($shipping_price->cost == 0)
                $j++;
            $string = $i . ";" . $sd->name . ";" . $sd->id_province . ";" . $sd->id_city . ";" . $sd->id_region . ";" . $shipping_price->cost . ';' . $shipping_price->service;
            $array[$i] = $string;
            print_r($string . "<br>");
            $i++;
        }
        echo 'Null Price : ' . $j . ' row';
    }

    function shipping_cost_list() {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Shipping Cost List', 'shipping_cost_list');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_READ);

        $data['content'] = $this->load->view('backend/shipping_cost/shipping_cost_list', $data, true);
        $this->load->view('backend/index', $data);
    }

    function shipping_cost_ajax() {
        $list = $this->model_shipping_cost->get_datatables_shipping_cost();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $data_row) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $data_row->province;
            $row[] = $data_row->city;
            $row[] = $data_row->name;
            $row[] = $this->indonesian_currency($data_row->price);
            $row[] = $data_row->services;
            $row[] = '<form action="admin_shipping_cost/shipping_cost_form" method="post">
                        <input type="hidden" name="id" value="' . $data_row->id . '">
                        <button class="btn btn-info btn-xs btn-edit" type="submit" data-original-title="Ubah" data-placement="top" data-toggle="tooltip"><i class="fa fa-edit"></i></button>
                        </form>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->model_shipping_cost->count_all_shipping_cost(),
            "recordsFiltered" => $this->model_shipping_cost->count_filtered_shipping_cost(),
            "data" => $data,
        );

        //output to json format
        echo json_encode($output);
    }
    
    function shipping_cost_form()
    {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Shipping Cost List', 'shipping_cost_list');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_UPDATE);
        $id = $this->input->post('id');
        if ($id) {
            $data['data'] = $this->model_basic->select_where($this->tbl_shipping_region, 'id', $id)->row();
            $data['data']->province = $this->model_basic->select_where($this->tbl_shipping_province, 'id', $data['data']->id_province)->row()->name;
            $data['data']->city = $this->model_basic->select_where($this->tbl_shipping_city, 'id', $data['data']->id_city)->row()->name;
        } else
            $data['data'] = null;
        $data['content'] = $this->load->view('backend/shipping_cost/shipping_cost_form', $data, true);
        $this->load->view('backend/index', $data);
    }
    
    function shipping_cost_list_edit()
    {
        $data = $this->get_app_settings();
        $data += $this->controller_attr;
        $data += $this->get_function('Shipping Cost List', 'shipping_cost_list');
        $data += $this->get_menu();
        $this->check_userakses($data['function_id'], ACT_UPDATE);
        
        $id = $this->input->post('id');
        $price = $this->input->post('price');
        if($this->input->post('price'))
        {
            $data_update = array('price' => $price);
            if(!$this->model_basic->update($this->tbl_shipping_region, $data_update, 'id', $id))
                $this->returnJson(array('status' => 'error', 'msg' => 'Please complete the form'));
            else
                $this->returnJson(array('status' => 'ok', 'msg' => 'Update success', 'redirect' => $data['controller'].'/'.$data['function']));
        }
    }

}
