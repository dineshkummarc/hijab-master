<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class model_rajaongkir extends PX_Model {

    function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
    }

    function get_province() {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://api.rajaongkir.com/starter/province',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: 28719ec6180de983d1a96c6f625ccd34"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
            redirect('checkout');
        } else {
            $json = json_decode($response, true);
            $data = array();
            $i = 0;
            foreach ($json['rajaongkir']['results'] as $data_row) {
                $temp = (object) array('province_id' => $data_row['province_id'],
                            'province' => $data_row['province']);
                array_push($data, $temp);
                // $data[$i]->id = $data_row['province_id'];
                // $data[$i]->province = $data_row['province'];
            }

            return $data;
        }
    }

    function get_city($id) {
        $url = 'http://api.rajaongkir.com/starter/city?province=' . $id;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: 28719ec6180de983d1a96c6f625ccd34"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
            redirect('checkout');
        } else {
            return $response;
        }
    }

    function get_subdistrict($id) {
        $url = 'http://pro.rajaongkir.com/api/subdistrict?city=' . $id;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: 28719ec6180de983d1a96c6f625ccd34"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
            redirect('checkout');
        } else {
            return $response;
        }
    }

    function get_cost($origin, $destination, $weight, $courier) {
        $post_field = "origin=" . $origin . "&destination=" . $destination . "&weight=" . $weight . "&courier=" . $courier;
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://api.rajaongkir.com/starter/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $post_field,
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: 28719ec6180de983d1a96c6f625ccd34"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
            redirect('checkout');
        } else {
            return $response;
        }
    }

    function get_cost_subdistrict($origin, $origin_type, $destination, $destination_type, $weight, $courier) {
        $post_field = "origin=" . $origin . "&originType=" . $origin_type . "&destination=" . $destination . "&destinationType=" . $destination_type . "&weight=" . $weight . "&courier=" . $courier;
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://pro.rajaongkir.com/api/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $post_field,
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: 28719ec6180de983d1a96c6f625ccd34"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
            redirect('checkout');
        } else {
            return $response;
        }
    }

    function get_cost_x($origin, $destination, $weight, $courier) {
        $post_field = "origin=" . $origin . "&destination=" . $destination . "&weight=" . $weight . "&courier=" . $courier;
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://api.rajaongkir.com/starter/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $post_field,
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: 28719ec6180de983d1a96c6f625ccd34"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
            redirect('cart');
        } else {
            $json = json_decode($response, true);
            $data = array();
            $i = 0;
            if(count($json['rajaongkir']['results']) == 0)
            {
                $temp = (object) array('costs' => array(0));
                array_push($data, $temp);
            }
            else
            {
            foreach ($json['rajaongkir']['results'] as $data_row) {
                $temp = (object) array('costs' => $data_row['costs']);
                array_push($data, $temp);
                // $data[$i]->id = $data_row['province_id'];
                // $data[$i]->province = $data_row['province'];
            }
            }

            return $data;
        }
    }

    function get_cost_subdistrict_x($origin, $origin_type, $destination, $destination_type, $weight, $courier) {
        $post_field = "origin=" . $origin . "&originType=" . $origin_type . "&destination=" . $destination . "&destinationType=" . $destination_type . "&weight=" . $weight . "&courier=" . $courier;
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://pro.rajaongkir.com/api/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $post_field,
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: 28719ec6180de983d1a96c6f625ccd34"
            ),
        ));

        if ($curl == NULL) {
            return FALSE;
        }

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
            //redirect('cart');
        } else {
            $json = json_decode($response, true);
            $data = array();
            $i = 0;
            foreach ($json['rajaongkir']['results'] as $data_row) {
                $temp = (object) array('costs' => $data_row['costs']);
                array_push($data, $temp);
                // $data[$i]->id = $data_row['province_id'];
                // $data[$i]->province = $data_row['province'];
            }

            return $data;
        }
    }

    function get_city_x() {
        $url = 'http://api.rajaongkir.com/starter/city?province=';

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: 95b77d4e2e50312e66c81266578b7edc"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
            redirect('cart');
        } else {
            $json = json_decode($response, true);
            $data = array();
            $i = 0;
            foreach ($json['rajaongkir']['results'] as $data_row) {
                $temp = (object) array('province_id' => $data_row['province_id'],
                            'city_id' => $data_row['city_id'],
                            'city' => $data_row['city_name'],
                            'type' => $data_row['type']);
                array_push($data, $temp);
                // $data[$i]->id = $data_row['province_id'];
                // $data[$i]->province = $data_row['province'];
            }

            return $data;
        }
    }

    function update_city($id_city, $type) {
        $data = array('type' => $type);
        $this->db->where('id_city', $id_city);
        $this->db->update('asu_shipping_city', $data);
    }

}
