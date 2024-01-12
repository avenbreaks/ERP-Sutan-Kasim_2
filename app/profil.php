<?php
$sql 	= "SELECT * FROM member WHERE id_member = '".$_SESSION['dunlop_id']."'";
$query 	= mysql_query($sql,$server);
$d 		= mysql_fetch_array($query);
$id_member = $d['id_member'];
$toko 	= $d['nama_toko'];
$telp	= $d['no_telp'];
$alamat = $d['alamat'];
$kota	= $d['kota'];
$pos 	= $d['pos'];
$pemilik= $d['pemilik'];
$email	= $d['email'];
$foto 	= $d['foto_member'];
$daftar	= tgl_indo($d['tgl_daftar']);
if ($foto == ""){
$foto 	= "foto_member/unavailable.jpg";
}else{
$foto 	= "foto_member/".$d['foto_member'];
}

?>
<div class="span9">
<ul class="breadcrumb">
<li><a href="?page=home">Home</a> <span class="divider">/</span></li>
<li class="active">Profil</li>
</ul>	
<div class="row">	  
    <div id="gallery" class="span3">
        <img src="<?php echo $foto?>" style="width:100%" alt="..."/>
    </div>
    <div class="span6">
        <h3><?php echo $toko ?></h3>
        <small><?php echo $alamat ?>, <?php echo $kota ?>, <?php echo $pos ?></small>
        <hr class="soft clr"/>
        <p> Owner : <?php echo $pemilik ?></p>
        <br class="clr"/>
        <p> Email : <?php echo $email ?></p>
        <br class="clr"/>
        <p> Telp  : <?php echo $telp ?></p>
        <a href="?page=profil-update" class="btn btn-warning"><span class="icon icon-edit"></span> Update</a>
    </div>
    
    <div class="span9">
    <ul id="productDetail" class="nav nav-tabs">
      <li class="active"><a href="#sukses" data-toggle="tab">Transaksi Sukses</a></li>
      <li><a href="#pending" data-toggle="tab">Transaksi Pending</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane fade active in" id="sukses">
      <h4>Riwayat Transaksi Berhasil</h4>
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <td width="5%">No.</td>
              <td colspan="2">ID Pesan</td>
              <td>Qty.</td>
              <td>Pembayaran</td>
              <td>Bayar</td>
              <td width="25%"></td>
            </tr>
          </thead>
          <tbody>
          <?php
                $sql2	= "SELECT * FROM orders WHERE id_member = '$id_member' AND status !='1' ORDER BY id_order DESC LIMIT 0,25";
                $query2	= mysql_query($sql2, $server);
				$no=1;
                while($d2 = mysql_fetch_array($query2)){
                    $idorder= $d2['id_order'];
                    $pay  	= strtoupper($d2['tipe_pembayaran']);
                    $diskon = $d2['diskon']/100;
                    $total  = $d2['total'];
					$status  = $d2['status'];
					$validasi  = $d2['validasi'];
                    $potongan  = ($diskon * $total);
                    $bayar	= format_rupiah($total- $potongan);
                    $qty 	= mysql_num_rows(mysql_query("SELECT * FROM orders_items WHERE id_order='$idorder'"));
          ?>
            <tr>
              <td><?php echo $no ?>.</td>
              <td width="3%"><a href="?page=detail-transaksi&order=<?php echo $d2['id_order']?>" title="Detail Transaksi"><i class="icon-large icon-eye-open"></i></a></td>
              <td><?php echo $idorder ?></td>
              <td><?php echo $qty ?></td>
              <td><?php echo $pay ?></td>
              <td><?php echo $bayar ?></td>
              <td>
              <?php 
			  if($pay != "COD"){ 
			  	if ($status == '2'){
				?>
              	<a class="btn btn-small btn-info" href="?page=konfirmasi"> Bukti Bayar <span class="icon-arrow-right"></span></a>
              <?php
				}
			   }
			   ?>
              
              <a class="btn btn-small btn-success pull-right" href="print-pesanan.php?order=<?php echo $d2['id_order']?>" target="_blank"> Print <span class="icon-print"></span></a>
              </td>
            </tr>
          <?php $no++;}?>
          </tbody>
        </table>
        <hr class="soft clr"/>
      </div>
      
  <div class="tab-pane fade" id="pending">
  <h4>Transaksi Pending</h4>
	<table class="table table-striped table-bordered">
      <thead>
        <tr>
          <td width="5%">No.</td>
          <td colspan="2">ID Pesan</td>
          <td>Qty.</td>
          <td>Pembayaran</td>
          <td>Bayar</td>
          <td width="15%"></td>
        </tr>
      </thead>
      <tbody>
      <?php
            $sql2	= "SELECT * FROM orders WHERE id_member = '$id_member' AND status ='1' ORDER BY id_order DESC LIMIT 0,25";
            $query2	= mysql_query($sql2, $server);
            $no=1;
            while($d2 = mysql_fetch_array($query2)){
                $idorder= $d2['id_order'];
                $pay  	= strtoupper($d2['tipe_pembayaran']);
                $diskon = $d2['diskon']/100;
                $total  = $d2['total'];
                $potongan  = ($diskon * $total);
                $bayar	= format_rupiah($total- $potongan);
                $qty 	= mysql_num_rows(mysql_query("SELECT * FROM orders_items WHERE id_order='$idorder'"));
      ?>
        <tr>
          <td><?php echo $no ?>.</td>
          <td width="3%"><a href="?page=keranjang-belanja" title="Detail Transaksi"><i class="icon-large icon-eye-open"></i></a></td>
          <td><?php echo $idorder ?></td>
          <td><?php echo $qty ?></td>
          <td><?php echo $pay ?></td>
          <td><?php echo $bayar ?></td>
          <td>
          <a class="btn btn-small btn-info" href="payment-transaction.php"> Bukti Bayar <span class="icon-arrow-right"></span></a>
          </td>
        </tr>
      <?php $no++;}?>
      </tbody>
    </table>
    <hr class="soft clr"/>
  </div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
