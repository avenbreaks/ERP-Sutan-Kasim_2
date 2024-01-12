<?php
function tgl_to_format_mdy($tgl){
	$tanggal = substr($tgl,8,2);
	$bulan = substr($tgl,5,2);
	$tahun = substr($tgl,0,4);
	return $bulan.'-'.$tanggal.'-'.$tahun;
}
function NewKode($tabel, $inisial){
	$struktur	= mysql_query("SELECT * FROM $tabel");
	$field		= mysql_field_name($struktur,0);
	$panjang	= mysql_field_len($struktur,0);
	// membaca panjang kolom
	$hasil 		= mysql_fetch_field($struktur,0);
	//$panjang	= $hasil->max_length; 
	

 	$qry	= mysql_query("SELECT MAX(".$field.") FROM ".$tabel);
 	$row	= mysql_fetch_array($qry); 
 	if ($row[0]=="") {
 		$angka=0;
	}
 	else {
 		$angka		= substr($row[0], strlen($inisial));
 	}
	
 	$angka++;
 	$angka	=strval($angka); 
 	$tmp	="";
 	for($i=1; $i<=($panjang-strlen($inisial)-strlen($angka)); $i++) {
		$tmp=$tmp."0";	
	}
 	return $inisial.$tmp.$angka;
}

function waktu($waktu){
	$jam = substr($waktu,0,2);
	$menit = substr($waktu,3,2);
	return $jam.':'.$menit;
}

function bln_indonesia($bulan) {
$array_bulan=array("01"=>"Januari",
"02"=>"Feb",
"03"=>"Mar",
"04"=>"April",
"05"=>"Mei",
"06"=>"Juni",
"07"=>"Juli",
"08"=>"Agustus",
"09"=>"September",
"10"=>"Oktober",
"11"=>"Nopember",
"12"=>"Desember");
$bln_temp=explode("-",$bulan);
$bln=$bln_temp[1];
$thn=$bln_temp[0];
$nama_bulan=$array_bulan[$bln];
return $nama_bulan." ".$thn;
}

function tgl_indo2($bulan) {
$array_bulan=array(
"01"=>"Jan",
"02"=>"Feb",
"03"=>"Mar",
"04"=>"Apr",
"05"=>"Mei",
"06"=>"Jun",
"07"=>"Jul",
"08"=>"Agust",
"09"=>"Sept",
"10"=>"Okt",
"11"=>"Nov",
"12"=>"Des");
$bln_temp=explode("-",$bulan);
$tgl=$bln_temp[2];
$bln=$bln_temp[1];
$thn=$bln_temp[0];
$nama_bulan=$array_bulan[$bln];
return $tgl." ".$nama_bulan." ".$thn;
}
//31:01:2013
//fungsi menyimpan tanggal ke database
function save_tgl_english($date){
	$tanggal = substr($date,0,2);
	$bulan = substr($date,3,2);
	$tahun = substr($date,6,4);
	return $tahun.'-'.$bulan.'-'.$tanggal;		 
}

//fungsi untuk format tanggal indonesia
function tgl_indo($tgl){
	$tanggal = substr($tgl,8,2);
	$bulan = getBulan(substr($tgl,5,2));
	$tahun = substr($tgl,0,4);
	return $tanggal.' '.$bulan.' '.$tahun;		 
}
function save_tgl_indo($tgl){
	$tanggal = substr($tgl,8,2);
	$bulan   = substr($tgl,5,2);
	$tahun   = substr($tgl,0,4);
	return $tanggal.'-'.$bulan.'-'.$tahun;		 
}
function tgl_indo_format($tgl){
	$tanggal = substr($tgl,8,2);
	$bulan = substr($tgl,5,2);
	$tahun = substr($tgl,0,4);
	return $tanggal.'-'.$bulan.'-'.$tahun;		 
}
function jam_menit($tgl){
	$detik = substr($tgl,6,2);
	$menit = substr($tgl,3,2);
	$jam = substr($tgl,0,2);
	return $jam.':'.$menit;		 
}

function waktu_indo($tgl){
	$tanggal = substr($tgl,8,2);
	$bulan = getBulan(substr($tgl,5,2));
	$tahun = substr($tgl,0,4);
	$waktu = substr($tgl,11,8);
	return $tanggal.' '.$bulan.' '.$tahun.' '.$waktu;		 
}
function waktu_indo_angka($tgl){
	$tanggal = substr($tgl,8,2);
	$bulan = substr($tgl,5,2);
	$tahun = substr($tgl,0,4);
	$waktu = substr($tgl,11,8);
	return $tanggal.'-'.$bulan.'-'.$tahun.' '.$waktu;		 
}	
function getBulan($bln){
	switch ($bln){
		case 1: return "Januari"; break;
		case 2: return "Februari"; break;
		case 3: return "Maret"; break;
		case 4: return "April"; break;
		case 5: return "Mei"; break;
		case 6: return "Juni"; break;
		case 7: return "Juli"; break;
		case 8: return "Agustus"; break;
		case 9: return "September"; break;
		case 10: return "Oktober"; break;
		case 11: return "November"; break;
		case 12: return "Desember"; break;
	}
}

//fungsi format rupiah
function format_rupiah($angka){
  $rupiah=number_format($angka,0,',','.');
  return $rupiah;
}

function autokode($length)
{
$random= "";
srand((double)microtime()*1000000);
 
$data = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
$data .= "1234567890";
//$data = "AbcDE123IJKLMN67QRSTUVWXYZ";
//$data .= "aBCdefghijklmn123opq45rs67tuv89wxyz";
//$data .= "0FGH45OP89";
 
for($i = 0; $i < $length; $i++)
{
$random .= substr($data, (rand()%(strlen($data))), 1);
}
 
return $random;
}
?>
