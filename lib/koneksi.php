<?php
date_default_timezone_set("Asia/Jakarta");
session_start();

$host	="localhost";
$user	="root";
$pass	="";
$db		="dunlop_erp";
$key	="DC";

$server = mysql_connect($host,$user,$pass) or die ("Gagal koneksi ke server!");
if($server){
	mysql_select_db($db, $server) or die ("Database tidak ditemukan!");
}
?>