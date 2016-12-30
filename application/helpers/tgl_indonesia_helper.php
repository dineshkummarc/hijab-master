<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('tgl_indo'))
{
	function tgl_indo($tgl)
	{
		$ubah = gmdate($tgl, time()+60*60*8);
		$pecah = explode("-",$ubah);
		$tanggal = $pecah[2];
		$bulan = bulan($pecah[1]);
		$tahun = $pecah[0];
		return $tanggal.' '.$bulan.' '.$tahun;
	}
}

if ( ! function_exists('bulan'))
{
	function bulan($bln)
	{
		switch ($bln)
		{
			case 1:
				return "Januari";
				break;
			case 2:
				return "Februari";
				break;
			case 3:
				return "Maret";
				break;
			case 4:
				return "April";
				break;
			case 5:
				return "Mei";
				break;
			case 6:
				return "Juni";
				break;
			case 7:
				return "Juli";
				break;
			case 8:
				return "Agustus";
				break;
			case 9:
				return "September";
				break;
			case 10:
				return "Oktober";
				break;
			case 11:
				return "November";
				break;
			case 12:
				return "Desember";
				break;
		}
	}
}

if ( ! function_exists('nama_hari'))
{
	function nama_hari($tanggal)
	{
		$ubah = gmdate($tanggal, time()+60*60*8);
		$pecah = explode("-",$ubah);
		$tgl = $pecah[2];
		$bln = $pecah[1];
		$thn = $pecah[0];

		$nama = date("l", mktime(0,0,0,$bln,$tgl,$thn));
		$nama_hari = "";
		if($nama=="Sunday") {$nama_hari="Minggu";}
		else if($nama=="Monday") {$nama_hari="Senin";}
		else if($nama=="Tuesday") {$nama_hari="Selasa";}
		else if($nama=="Wednesday") {$nama_hari="Rabu";}
		else if($nama=="Thursday") {$nama_hari="Kamis";}
		else if($nama=="Friday") {$nama_hari="Jumat";}
		else if($nama=="Saturday") {$nama_hari="Sabtu";}
		return $nama_hari;
	}
}

if ( ! function_exists('hitung_mundur'))
{
	function hitung_mundur($wkt)
	{
		$waktu=array(	365*24*60*60	=> "tahun",
						30*24*60*60		=> "bulan",
						7*24*60*60		=> "minggu",
						24*60*60		=> "hari",
						60*60			=> "jam",
						60				=> "menit",
						1				=> "detik");

		$hitung = strtotime(gmdate ("Y-m-d H:i:s", time () +60 * 60 * 8))-$wkt;
		$hasil = array();
		if($hitung<5)
		{
			$hasil = 'kurang dari 5 detik yang lalu';
		}
		else
		{
			$stop = 0;
			foreach($waktu as $periode => $satuan)
			{
				if($stop>=6 || ($stop>0 && $periode<60)) break;
				$bagi = floor($hitung/$periode);
				if($bagi > 0)
				{
					$hasil[] = $bagi.' '.$satuan;
					$hitung -= $bagi*$periode;
					$stop++;
				}
				else if($stop>0) $stop++;
			}
			$hasil=implode(' ',$hasil).' yang lalu';
		}
		return $hasil;
	}


if( ! function_exists('relative_time'))
{
    function relative_time($datetime)
    {
        if(!$datetime)
        {
            return "no data";
        }

        if(!is_numeric($datetime))
        {
            $val = explode(" ",$datetime);
            $date = explode("-",$val[0]);
            $time = explode(":",$val[1]);
            $datetime = mktime($time[0],$time[1],$time[2],$date[1],$date[2],$date[0]);
        }

        $difference = time() - $datetime;
        $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
        $lengths = array("60","60","24","7","4.35","12","10");

        if ($difference > 0)
        {
            $ending = 'ago';
        }
        else
        {
            $difference = -$difference;
            $ending = 'to go';
        }
        for($j = 0; $difference >= $lengths[$j]; $j++)
        {
            $difference /= $lengths[$j];
        }
        $difference = round($difference);

        if($difference != 1)
        {
            $period = strtolower($periods[$j].'s');
        } else {
            $period = strtolower($periods[$j]);
        }

        return "$difference $period $ending";
    }


}
}

if ( ! function_exists('satuan')){
	function satuan($inp)
	{
		if ($inp == 1)
		{
			return "satu ";
		}
		else if ($inp == 2)
		{
			return "dua ";
		}
		else if ($inp == 3)
		{
			return "tiga ";
		}
		else if ($inp == 4)
		{
			return "empat ";
		}
		else if ($inp == 5)
		{
			return "lima ";
		}
		else if ($inp == 6)
		{
			return "enam ";
		}
		else if ($inp == 7)
		{
			return "tujuh ";
		}
		else if ($inp == 8)
		{
			return "delapan ";
		}
		else if ($inp == 9)
		{
			return "sembilan ";
		}
		else
		{
			return "";
		}
	}
}

if ( ! function_exists('belasan')){
	function belasan($inp)
	{
		$proses = $inp; //substr($inp, -1);
		if ($proses == '11')
		{
			return "sebelas ";
		}
		else
		{
			$proses = substr($proses,1,1);
			return satuan($proses)."belas ";
		}
	}
}

if ( ! function_exists('puluhan')){
	function puluhan($inp)
	{
		$proses = $inp; //substr($inp, 0, -1);
		if ($proses == 1)
		{
			return "sepuluh ";
		}
		else if ($proses == 0)
		{
			return '';
		}
		else
		{
			return satuan($proses)."puluh ";
		}
	}
}

if ( ! function_exists('ratusan')){
	function ratusan($inp)
	{
		$proses = $inp; //substr($inp, 0, -2);
		if ($proses == 1)
		{
			return "seratus ";
		}
		else if ($proses == 0)
		{
			return '';
		}
		else
		{
			return satuan($proses)."ratus ";
		}
	}
}

if ( ! function_exists('ribuan')) {
	function ribuan($inp)
	{
		$proses = $inp; //substr($inp, 0, -3);
		if ($proses == 1)
		{
			return "seribu ";
		}
		else if ($proses == 0)
		{
			return '';
		}
		else
		{
			return satuan($proses)."ribu ";
		}
	}
}

if ( ! function_exists('jutaan')) {
	function jutaan($inp)
	{
		$proses = $inp; //substr($inp, 0, -6);
		if ($proses == 0)
		{
			return '';
		}
		else
		{
			return satuan($proses)."juta ";
		}
	}
}

if ( ! function_exists('milyaran')) {
	function milyaran($inp)
	{
		$proses = $inp; //substr($inp, 0, -9);
		if ($proses == 0)
		{
			return '';
		}
		else
		{
			return satuan($proses)."milyar ";
		}
	}
}

if ( ! function_exists('terbilang')){
	function terbilang($rp)
	{
		$kata = "";
		$rp = trim($rp);
		if (strlen($rp) >= 10)
		{
			$angka = substr($rp, strlen($rp)-10, -9);
			$kata = $kata.milyaran($angka);
		}
		$tambahan = "";
		if (strlen($rp) >= 9)
		{
			$angka = substr($rp, strlen($rp)-9, -8);
			$kata = $kata.ratusan($angka);
			if ($angka > 0) { $tambahan = "juta "; }
		}
		if (strlen($rp) >= 8)
		{
			$angka = substr($rp, strlen($rp)-8, -7);
			$angka1 = substr($rp, strlen($rp)-7, -6);
			if (($angka == 1) && ($angka1 > 0))
			{
				$angka = substr($rp, strlen($rp)-8, -6);
				//echo " belasan".($angka)." ";
				$kata = $kata.belasan($angka)."juta ";
			}
			else
			{
				$angka = substr($rp, strlen($rp)-8, -7);
				//echo " puluhan".($angka)." ";
				$kata = $kata.puluhan($angka);
				if ($angka > 0) { $tambahan = "juta "; }
				
				$angka = substr($rp, strlen($rp)-7, -6);
				//echo " ribuan".($angka)." ";
				$kata = $kata.ribuan($angka);
				if ($angka == 0) { $kata = $kata.$tambahan; }
			}	
		}
		if (strlen($rp) == 7)
		{
			$angka = substr($rp, strlen($rp)-7, -6);
			$kata = $kata.jutaan($angka);
			if ($angka == 0) { $kata = $kata.$tambahan; }
		}
		$tambahan = "";
		if (strlen($rp) >= 6)
		{
			$angka = substr($rp, strlen($rp)-6, -5);
			$kata = $kata.ratusan($angka);
			if ($angka > 0) { $tambahan = "ribu "; }
		}
		if (strlen($rp) >= 5)
		{
			$angka = substr($rp, strlen($rp)-5, -4);
			$angka1 = substr($rp, strlen($rp)-4, -3);
			if (($angka == 1) && ($angka1 > 0))
			{
				$angka = substr($rp, strlen($rp)-5, -3);
				//echo " belasan".($angka)." ";
				$kata = $kata.belasan($angka)."ribu ";
			}
			else
			{
				$angka = substr($rp, strlen($rp)-5, -4);
				//echo " puluhan".($angka)." ";
				$kata = $kata.puluhan($angka);
				if ($angka > 0) { $tambahan = "ribu "; }
				
				$angka = substr($rp, strlen($rp)-4, -3);
				//echo " ribuan".($angka)." ";
				$kata = $kata.ribuan($angka);
				if ($angka == 0) { $kata = $kata.$tambahan; }
			}
		}
		if (strlen($rp) == 4)
		{
			$angka = substr($rp, strlen($rp)-4, -3);
			//echo " ribuan".($angka)." ";
			$kata = $kata.ribuan($angka);
			if ($angka == 0) { $kata = $kata.$tambahan; }
		}
		if (strlen($rp) >= 3)
		{
			$angka = substr($rp, strlen($rp)-3, -2);
			//echo " ratusan".($angka)." ";
			$kata = $kata.ratusan($angka);
		}
		if (strlen($rp) >= 2)
		{
			$angka = substr($rp, strlen($rp)-2, -1);
			$angka1 = substr($rp, strlen($rp)-1);
			if (($angka == 1) && ($angka1 > 0))
			{
				$angka = substr($rp, strlen($rp)-2);
				//echo " belasan".($angka)." ";
				$kata = $kata.belasan($angka);
			}
			else
			{
				//echo " puluhan".($angka)." ";
				$kata = $kata.puluhan($angka);
				
				$angka = substr($rp, strlen($rp)-1);
				//echo " satuan".($angka)." ";
				$kata = $kata.satuan($angka);
			}
		}
		if (strlen($rp) == 1)
		{
			$angka = substr($rp, strlen($rp)-1);
			//echo " satuan".($angka)." ";
			$kata = $kata.satuan($angka);
		}
		return $kata;
	}
}