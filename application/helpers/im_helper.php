<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function get_client_ip_server() {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
	}

	function get_bln_news($date){
		$bln=substr($date, 5,2);
		$tgl=substr($date, 8,2);
		$thn=substr($date, 0,4);
		$monthNum = $bln;
 		$monthName = date("F", mktime(0, 0, 0, $monthNum, 10));
 		$date=$monthName." ".$thn;
 		return $date;
	}
	function get_name_admin($id){
		$CI =& get_instance();
   		$CI->load->database(); 
		$query=$CI->db->query("select * from si_user where id='7'")->row();
		$name=$query->username;
		return $name;
	}
	function idr($angka){
		$angka ="Rp. ".number_format($angka,2,',','.');
		$duitnya=str_replace(",00", "", $angka);
		return $duitnya;
	
	}
	function persen($data1,$data2){
		
		$data=$data2*100/$data1;
		if($data>100){
			$data=100;
		}
		return $data;
	}

	function get_days_left($day){
		$date1 = new DateTime(substr($day,0,10)); 
  		$date2 = new DateTime(date('Y-m-d')); 
  		$diff = $date2->diff($date1)->format("%a"); 
  		$days = intval($diff);  
  		return $days;
	}

	function url($val){
		return url_title($val);

	}