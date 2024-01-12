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
<li class="active">Cek Pengiriman</li>
</ul>	
<div class="row">	  
    <div class="span9">
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <td width="5%">No.</td>
              <td>ID Pesan</td>
              <td>Qty.</td>
              <td>Pembayaran</td>
              <td>Bayar</td>
              <td width="25%">Status</td>
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
					if($validasi == 'yes'){
					$ket = "Telah dikirim";
					}
                    $potongan  = ($diskon * $total);
                    $bayar	= format_rupiah($total- $potongan);
                    $qty 	= mysql_num_rows(mysql_query("SELECT * FROM orders_items WHERE id_order='$idorder'"));
          ?>
            <tr>
              <td><?php echo $no ?>.</td>
              <td><?php echo $idorder ?></td>
              <td><?php echo $qty ?></td>
              <td><?php echo $pay ?></td>
              <td><?php echo $bayar ?></td>
              <td><i class="icon icon-check pull-left"></i>  <?php echo $ket ?></td>
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
