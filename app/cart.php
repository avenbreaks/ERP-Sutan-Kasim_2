	<div class="span9">
    <ul class="breadcrumb">
		<li><a href="?page=produk&kat=all">Home</a> <span class="divider">/</span></li>
		<li class="active"> Keranjang Belanja</li>
    </ul>
	<h3>  Keranjang Belanja [<?php echo $J_item?> Item]
    <a href="?page=produk&kat=all" class="btn btn-large btn-warning pull-right"><i class="icon-arrow-left"></i> Lanjut Belanja </a>
    </h3>	
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
								WHERE orders.id_member= '".$_SESSION['dunlop_id']."' AND orders.status='1'";
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
              <td>
                <div class="input-append">
                  <input type="number" required class="span21" value="<?php echo $j_order?>" style="max-width:40px" max="100" min="1" title="Jumlah Pesan" size="16">
                  <a href="?page=tools&id=<?php echo $id?>&produk=<?php echo $produk_id?>" class="btn btn-danger"><i class="icon-trash icon-white"></i></a>
                </div>
              </td>
              <td><?php echo $harga?></td>
              <td><?php echo $total?></td>
            </tr>
            <?php }
				$sqlcekorder 	= "SELECT * FROM orders JOIN orders_items ON orders.id_order = orders_items.id_order WHERE orders.id_member='".$_SESSION['dunlop_id']."' AND orders.status='1'";
				$querycekorder	= mysql_query($sqlcekorder);
				$totaldidatabase = mysql_fetch_array($querycekorder);
				$gtot =  format_rupiah($totaldidatabase['total']);
				$sqlvoucer 	= mysql_query("SELECT diskon FROM orders WHERE id_member= '".$_SESSION['dunlop_id']."' AND status='1'");
				$jvou		= mysql_fetch_array($sqlvoucer);
				$diskon		= $jvou['diskon'] / 100 ;
				$potongan	= $totaldidatabase['total'] * $diskon;
				$djvou 		= format_rupiah($potongan);
				$tbayar 	= format_rupiah($totaldidatabase['total'] - $potongan);
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
            </tbody>
        </table>
		
			<table class="table table-bordered">
			<tbody>
				 <tr>
                  <td>
                  <?php
					if(isset($_POST['btncode'])){
						$adaprdk = mysql_num_rows($querycekorder);
						
						$cekcode = mysql_query("SELECT * FROM promo WHERE kode_promo='".$_POST['inpcode']."'");
						$qrycode = mysql_fetch_array($cekcode);
						$adacode = mysql_num_rows($cekcode);
						$id_promo= $qrycode['id_promo'];
						$dcode	 = $qrycode['besar_promo'];
						
						if(($adacode <= 0)){
							echo "<div class='alert alert-danger alert-dismissible' role='alert'>
									<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
										<span aria-hidden='true'>&times;</span></button>
									Code Voucher Ditolak
									</div>";	 
						}else 
						if($adacode > 0){
							$Tot = $totaldidatabase['total'];
							if(date('Y-m-d') < $qrycode['mulai_promo'] ){
								echo "<div class='alert alert-danger alert-dismissible' role='alert'>
										<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
											<span aria-hidden='true'>&times;</span></button>
										Promo akan mulai berlaku pada tanggal ".tgl_indo($qrycode['mulai_promo'])."
										</div>";
							}else
							if(date('Y-m-d') < $qrycode['mulai_promo'] ){
								echo "<div class='alert alert-danger alert-dismissible' role='alert'>
										<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
											<span aria-hidden='true'>&times;</span></button>
										Promo sudah berakhir
										</div>";
							}else
							if($qrycode['min_order'] > $Tot ){
								echo "<div class='alert alert-danger alert-dismissible' role='alert'>
										<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
											<span aria-hidden='true'>&times;</span></button>
										Minimal Belanja Rp. ".format_rupiah($qrycode['min_order'])." untuk menggunakan Kode ini
										</div>";
								
							}else
							if($qrycode['min_order'] < $Tot ){
							$sqlupdate = "UPDATE orders SET id_promo='$id_promo',
															diskon='$dcode' WHERE 
															id_member='".$_SESSION['dunlop_id']."' && status = '1'";
							$queupdate = mysql_query($sqlupdate);
								if($queupdate){
									echo "<div class='alert alert-success alert-dismissible' role='alert'>
											<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
												<span aria-hidden='true'>&times;</span></button>
											Code Voucher Diterima
											</div>";
									echo "<meta http-equiv=Refresh content=0;url=?page=keranjang-belanja>";
								}
							}
						}
					}
				?>
				<form class="form-horizontal" name="form" method="post" enctype="multipart/form-data">
				<div class="control-group">
				<label class="control-label"><strong> KODE VOCER: </strong> </label>
				<div class="controls">
				<input type="text" name="inpcode" required class="input-medium" placeholder="KODE VOCER" title="KODE VOCER">
				<button type="submit" class="btn" name="btncode"> ADD </button>
				</div>
				</div>
				</form>
				</td>
                </tr>
				
			</tbody>
			</table>
					
	<a href="?page=produk&kat=all" class="btn btn-large btn-warning"><i class="icon-arrow-left"></i> Lanjut Belanja </a>
	<?php
    if ($totaldidatabase['tipe_pembayaran'] == '0'){
	?>
    <a href="?page=pembayaran&order=<?php echo $totaldidatabase['id_order']?>" class="btn btn-large btn-warning pull-right">Next <i class="icon-arrow-right"></i></a>
	<?php
	}
	?>
</div>
