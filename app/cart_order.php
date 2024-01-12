	<div class="span9">
    <ul class="breadcrumb">
		<li><a href="?page=produk&kat=all">Home</a> <span class="divider">/</span></li>
		<li><a href="?page=profil">Profil</a> <span class="divider">/</span></li>
        <li class="active"> Detail Transaksi</li>
    </ul>
	<h3> Transaksi-<?php echo $_GET['order']?></h3>	
    <h3 class="pull-right"><small>[<?php echo $J_item?> Item]</small></h3>
	<hr class="soft"/>
		<table class="table table-bordered">
          <thead>
          	<tr>
              <th>Produk</th>
              <th>Nama Produk</th>
              <th>Jumlah Order</th>
              <th>Harga (Rp.)</th>
              <th>Total (Rp.)</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sql	= "SELECT * FROM orders JOIN orders_items ON 
								orders.id_order = orders_items.id_order JOIN produk ON
								produk.id_produk = orders_items.id_produk 
								WHERE orders.id_member= '".$_SESSION['dunlop_id']."' AND orders.id_order='".$_GET['order']."'";
			$query	= mysql_query($sql);
			while($d = mysql_fetch_array($query)){
				$id = $d['id_order'];
				$nama = $d['nama_produk'];
				$produk_id = $d['id_produk'];
				$j_order   =$d['jumlah_order'];
				if($image  = $d['foto_produk'] == ""){
					$image = "../images/produk/no_foto.jpg";
				}else{
					$image = "../images/produk/".$d['foto_produk'];
				}
				$harga 	= format_rupiah($d['harga']);
				$jumlah = $d['jumlah_order'];
				$total  = format_rupiah($d['jumlah_order'] * $d['harga']);
			?>
          
            <tr>
              <td> <img width="60" src="<?php echo $image?>" alt="<?php echo $nama?>"/></td>
              <td><?php echo $nama?></td>
              <td><?php echo $j_order?></td>
              <td><?php echo $harga?></td>
              <td><?php echo $total?></td>
            </tr>
            <?php }
				$sqlcekorder 	= "SELECT * FROM orders JOIN orders_items ON orders.id_order = orders_items.id_order WHERE orders.id_member='".$_SESSION['dunlop_id']."' AND orders.id_order='".$_GET['order']."'";
				$querycekorder	= mysql_query($sqlcekorder);
				$totaldidatabase = mysql_fetch_array($querycekorder);
				$gtot =  format_rupiah($totaldidatabase['total']);
				$sqlvoucer 	= mysql_query("SELECT diskon FROM orders WHERE id_member= '".$_SESSION['dunlop_id']."' AND status='1'");
				$jvou		= mysql_fetch_array($sqlvoucer);
				$diskon		= $jvou['diskon'] / 100 ;
				$potongan	= $totaldidatabase['total'] * $diskon;
				$djvou 		= format_rupiah($potongan);
				$tbayar 	= format_rupiah($totaldidatabase['total'] - $potongan);
				$pembayaran = strtoupper($totaldidatabase['tipe_pembayaran']);
				$status		= $totaldidatabase['status'];
				if ($status == '1'){
					$status = "Order";
					$label1  = "label label-info";
					$label2  = "label label-warning";
				}else
				if ($status == '2'){
					$status = "Pending";
					$label1  = "label label-info";
					$label2  = "label label-warning";
				}else
				if ($status == '3'){
					$status = "Lunas";
					$label1  = "label label-info";
					$label2  = "label label-success";
				}
			?>
            <tr>
              <td colspan="4" style="text-align:right">Total Belanja:</td>
              <td>Rp. <?php echo $gtot?></td>
            </tr>
             <tr>
              <td colspan="4" style="text-align:right">Diskon:	</td>
              <td>Rp. <?php echo $djvou?></td>
            </tr>
             <tr>
              <td colspan="4" style="text-align:right"><strong>TOTAL PEMBAYARAN</strong></td>
              <td class="label label-important" style="display:block"> <strong>Rp. <?php echo $tbayar?></strong></td>
            </tr>
             <tr>
               <td colspan="4" style="text-align:right">Pembayaran</td>
               <td class="<?php echo $label1?>" style="display:block"><?php echo $pembayaran?></td>
             </tr>
             <tr>
               <td colspan="4" style="text-align:right">Status Pembayaran</td>
               <td class="<?php echo $label2?>" style="display:block"><?php echo $status?></td>
             </tr>
            </tbody>
        </table>
	<?php
    if ($totaldidatabase['tipe_pembayaran'] == '0'){
	?>
    <a href="?page=pembayaran&order=<?php echo $totaldidatabase['id_order']?>" class="btn btn-large btn-warning pull-right">Next <i class="icon-arrow-right"></i></a>
	<?php
	}
	?>
</div>
