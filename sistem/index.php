<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>DUNLOP</title>
	<?php
    //1 = Administrator
    //3 = Karyawan [Sales]
    //4 = Karyawan [Managemen]
    //5 = Karyawan [Gudang]
    include_once "../lib/koneksi.php";
	include_once "../lib/fungsi.php";
    if((empty($_SESSION['dunlop_username'])) or (empty($_SESSION['dunlop_password']))) {
        echo "<meta http-equiv='refresh' content='0; url=../login.php'>";
        exit;
    }else if(!empty($_SESSION['dunlop_level'])){
		
		// ADMINISTRATOR
        if($_SESSION['dunlop_level'] == '1'){
        	if ($_GET['page'] == 'karyawan'){ include "karyawan.php";}else
			if ($_GET['page'] == 'tambah-karyawan'){ include "karyawan_tambah.php";}else
			if ($_GET['page'] == 'hapus-karyawan'){ include "hapus.php";}else
			if ($_GET['page'] == 'profil-karyawan'){ include "profil_karyawan.php";}else
			if ($_GET['page'] == 'blokir'){ include "blokir.php";}else
			if ($_GET['page'] == 'unblokir'){ include "unblokir.php";}else
			if ($_GET['page'] == 'member'){ include "member.php";}else
			if ($_GET['page'] == 'profil-member'){ include "profil_member.php";}else
			if ($_GET['page'] == 'hapus-member'){ include "hapus.php";}else
			if ($_GET['page'] == 'kategori'){ include "kategori.php";}else
			if ($_GET['page'] == 'hapus-kategori'){ include "hapus.php";}else
			if ($_GET['page'] == 'kendaraan'){ include "kendaraan.php";}else
			if ($_GET['page'] == 'hapus-kendaraan'){ include "hapus.php";}else
			if ($_GET['page'] == 'update-kendaraan'){ include "kendaraan_update.php";}else
			if ($_GET['page'] == 'promo'){ include "promo.php";}else
			if ($_GET['page'] == 'tambah-promo'){ include "promo_tambah.php";}else
			if ($_GET['page'] == 'hapus-promo'){ include "hapus.php";}else
			if ($_GET['page'] == 'edit-promo'){ include "promo_edit.php";}else
			if ($_GET['page'] == 'produk'){ include "produk.php";}else
			if ($_GET['page'] == 'produk-detail'){ include "produk_detail.php";}else
			if ($_GET['page'] == 'tambah-produk'){ include "produk_tambah.php";}else
			if ($_GET['page'] == 'edit-produk'){ include "produk_edit.php";}else
			if ($_GET['page'] == 'hapus-produk'){ include "hapus.php";}else
			
			if ($_GET['page'] == 'order'){ include "order.php";}else
			if ($_GET['page'] == 'detail-transaksi'){ include "order_detail.php";}else
			
			
			{}   
		
        }else
		if($_SESSION['dunlop_level'] == '3'){
			if ($_GET['page'] == 'member'){ include "member.php";}else
			if ($_GET['page'] == 'profil-member'){ include "profil_member.php";}else
			if ($_GET['page'] == 'hapus-member'){ include "hapus.php";}else
			if ($_GET['page'] == 'produk'){ include "produk.php";}else
			if ($_GET['page'] == 'produk-detail'){ include "produk_detail.php";}else
			if ($_GET['page'] == 'history-order'){ include "order_history.php";}else
			if ($_GET['page'] == 'order'){ include "order.php";}else
			if ($_GET['page'] == 'detail-transaksi'){ include "order_detail.php";}else
			{}
            
        }else
		if($_SESSION['dunlop_level'] == '5'){
			if ($_GET['page'] == 'order'){ include "order.php";}else
			if ($_GET['page'] == 'detail-transaksi'){ include "order_detail.php";}else
			if ($_GET['page'] == 'produk'){ include "produk.php";}else
			if ($_GET['page'] == 'produk-detail'){ include "produk_detail.php";}else
			if ($_GET['page'] == 'edit-produk'){ include "produk_edit.php";}else
			{}
            
        }
		else
		if($_SESSION['dunlop_level'] == '4'){
			if ($_GET['page'] == 'karyawan'){ include "karyawan.php";}else
			if ($_GET['page'] == 'tambah-karyawan'){ include "karyawan_tambah.php";}else
			if ($_GET['page'] == 'hapus-karyawan'){ include "hapus.php";}else
			if ($_GET['page'] == 'profil-karyawan'){ include "profil_karyawan.php";}else
			if ($_GET['page'] == 'blokir'){ include "blokir.php";}else
			if ($_GET['page'] == 'unblokir'){ include "unblokir.php";}else
			if ($_GET['page'] == 'member'){ include "member.php";}else
			if ($_GET['page'] == 'profil-member'){ include "profil_member.php";}else
			if ($_GET['page'] == 'hapus-member'){ include "hapus.php";}else
			if ($_GET['page'] == 'history-order'){ include "order_history.php";}else
			if ($_GET['page'] == 'order'){ include "order.php";}else
			if ($_GET['page'] == 'detail-transaksi'){ include "order_detail.php";}else
			if ($_GET['page'] == 'produk'){ include "produk.php";}else
			if ($_GET['page'] == 'produk-detail'){ include "produk_detail.php";}else
			if ($_GET['page'] == 'tambah-produk'){ include "produk_tambah.php";}else
			if ($_GET['page'] == 'edit-produk'){ include "produk_edit.php";}else
			if ($_GET['page'] == 'hapus-produk'){ include "hapus.php";}else
			if ($_GET['page'] == 'pembayaran'){ include "pembayaran.php";}else
			if ($_GET['page'] == 'tools'){ include "order_tools.php";}else
			if ($_GET['page'] == 'surat-jalan'){ include "surat_jalan.php";}else
			if ($_GET['page'] == 'cetak-surat-jalan'){ include "print_surat_jalan.php";}else
			if ($_GET['page'] == 'laporan-transaksi'){ include "transaksi.php";}else
			if ($_GET['page'] == 'cetak-transaksi'){ include "print_transaksi.php";}else
			if ($_GET['page'] == 'rekap-faktur'){ include "rekap_faktur.php";}else
			if ($_GET['page'] == 'cetak-rekap-faktur'){ include "print_rekap_faktur.php";}else
			{}
            
        }
			
			if ($_GET['page'] == 'home'){ include "index2.php";}else
			if ($_GET['page'] == 'logout'){ include "../lib/logout.php";}else
            if ($_GET['page'] == 'profil'){ include "profil.php";}
			if ($_GET['page'] == 'profil-update'){ include "profil_update.php";}else
			if ($_GET['page'] == 'password'){ include "password.php";}else
			{}
    }
    
    ?>