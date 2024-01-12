<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>DUNLOP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Bootstrap styles -->
    <link href="assets/css/bootstrap.css" rel="stylesheet"/>
    <link href="style.css" rel="stylesheet"/>
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet">
	<link rel="shortcut icon" href="themes/images/ico/favicon.ico">
  </head>

<!-- 
	Upper Header Section 
-->
	<?php 
	 include_once "../lib/koneksi.php";
	 include_once "../lib/fungsi.php";
	  $sql	= "SELECT * FROM orders 
	  			JOIN orders_items ON orders.id_order = orders_items.id_order 
				JOIN produk ON produk.id_produk = orders_items.id_produk 
				WHERE orders.id_member= '".$_SESSION['dunlop_id']."' AND orders.id_order='".$_GET['order']."'";
	  $query	= mysql_query($sql);
	  $query6	= mysql_query($sql);
	  $d6 = mysql_fetch_array($query6);
	  $again = mysql_query("SELECT * FROM member WHERE id_member = '".$_SESSION['dunlop_id']."'");
	  $dagain= mysql_fetch_array($again);
	  
	  if ($d6['tipe_pembayaran'] == 'cod'){
		$msg = "<small class='text-success'>".strtoupper($d6['tipe_pembayaran'])."</small>";
		$msg2="[Pending]";
		$tgl = tgl_indo($d6['tgl_bayar']);
	  }else{
		  if ($d6['status'] == 3){
			$msg = "<small class='text-success'>".strtoupper($d6['tipe_pembayaran'])."</small>";
			$tgl = tgl_indo($d6['tgl_bayar']);
			$msg2="[Lunas]";
		  }else
		  if ($d6['status'] == 2){
			$msg = "<small class='text-success'>".strtoupper($d6['tipe_pembayaran'])."</small>";
			$tgl = tgl_indo($d6['tgl_bayar']);
			$msg2="[Pending]";
		  }else{
		    $msg ="";
			$tgl = "";
			$msg2="[Pending]";
		  }
		  
	  }
     ?>	
<!--
New produk
-->
  <body onload="window.print();">
    <div class="container">
      <!-- Main content -->
      <section class="invoice">
        <!-- title row -->
        <div class="row">
          <div class="span12">
            <h2 class="page-header text-center">
              PT Sutan Kasim Padang</h2>
          </div><!-- /.col -->
        </div>
        
        <!-- Table row -->
        <div class="row">
          <div class="span12">
          	<br>
          	<table width="80%" border="0" align="center">
            <thead>
                <tr>
                  <th width="30%" align="left">Nomor Transaksi</th>
                  <th align="left"><?php echo $_GET['order']?></th>
                </tr>
                <tr>
                  <th align="left">Member</th>
                  <th align="left"><?php echo $dagain['nama_toko']?></th>
                </tr>
                <tr>
                  <th align="left">Status Pembayaran</th>
                  <th align="left"><?php echo $msg?> <?php echo $msg2?></th>
                </tr>
                <?php
                if ($d6['status'] == 2){
				?>
                <tr>
                  <th align="left">Tanggal Pemesanan</th>
                  <th align="left"><?php echo $tgl?></th>
                </tr>
                <?php
				}
				?>
                <tr>
                  <th align="left"> Penerima</th>
                  <th align="left"><?php echo $dagain['nama_toko'];?></th>
                </tr>
                <tr>
                  <th align="left">Alamat</th>
                  <th align="left"><?php echo $dagain['alamat'].". ".$dagain['kota'].". ".$dagain['pos'];?></th>
                </tr>
                <tr>
                  <th align="left">No. telp.</th>
                  <th align="left"><?php echo $dagain['no_telp']?></th>
                </tr>
              </thead>
            </table>
            <br>
            <table width="80%" border="1" align="center">
              <thead>
                <tr>
                  <th>Nama</th>
                  <th>Harga (Rp.)</th>
                  <th>Qty </th>
                  <th>Total (Rp.)</th>
                </tr>
              </thead>
              <tbody>
              <?php
                while($d = mysql_fetch_array($query)){
                    $id = $d['id_member'];
                    $produk = $d['nama_produk'];
                    $produkidi = $d['id_produk'];
                    $idorder= $d['id_order'];
                    $harga 	= format_rupiah($d['harga']);
                    $jumlah = $d['jumlah_order'];
                    $total  = format_rupiah($d['jumlah_order'] * $d['harga']);
              ?>
                <tr>
                  <td><?php echo $produk?></td>
                  <td><?php echo $harga?></td>
                  <td><?php echo $jumlah?></td>
                  <td><?php echo $total?></td>
                </tr>
                <?php 
                }
                $sql3	= "SELECT * FROM orders WHERE id_member= '".$_SESSION['dunlop_id']."' AND id_order='".$_GET['order']."'";
                $query3	= mysql_query($sql3);
                $data3 = mysql_fetch_array($query3);
                $gtot =  format_rupiah($data3['total']);
                
                $diskon		= $data3['diskon'] / 100 ;
                $potongan	= $data3['total'] * $diskon;
                $djvou 		= format_rupiah($potongan);
                $tbayar 	= format_rupiah($data3['total'] - $potongan);
                ?>
                <tr>
                  <td colspan="4">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="3">Total Harga</td>
                  <td>Rp. <?php echo $gtot?></td>
                </tr>
                 <tr>
                  <td colspan="3">Diskon </td>
                  <td>Rp. <?php echo $djvou?></td>
                </tr>
                <tr>
                  <td colspan="3">TOTAL BAYAR:	</td>
                  <td><h3>Rp. <?php echo $tbayar?></h3></td>
                </tr>
              </tbody>
            </table>
            <p>&nbsp;</p>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </section><!-- /.content -->
    </div><!-- ./wrapper -->
    <!-- AdminLTE App -->
    
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/jquery.easing-1.3.min.js"></script>
    <script src="assets/js/jquery.scrollTo-1.4.3.1-min.js"></script>
    <script src="assets/js/shop.js"></script>
  </body>
</html>