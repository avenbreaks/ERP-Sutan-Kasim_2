	<div class="span9">
        <ul class="breadcrumb">
        	<li><a href="?page=produk&kat=all">Home</a> <span class="divider">/</span></li>
        	<li class="active"> Keranjang Belanja</li>
        </ul>
        <div class='alert alert-info alert-dismissible' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
         Pesanan akan dikirim ke alamat toko anda.
        </div>
    <!-- adsasdasd -------------------------------------------------------------------------------------->
    <div class="span6">
       <h3>Metode Pembayaran</h3>
       <?php
	   $print  = "";
	   $print2 = "<button name='btnconfirm' type='submit' class='btn btn-large btn-info pull-right'><i class='icon-ok'></i> Konfirmasi </button>";
	   $print3 = "<a href='?page=keranjang-belanja' class='btn btn-large btn-warning pull-right'><i class='icon-arrow-left'></i> Kembali</a>";
	    if(isset($_POST['btnconfirm'])){
			$metode 	= $_POST['inputbayar'];
			$id_order 	= $_GET['order'];
			
			$sql	= "SELECT * FROM orders 
						JOIN orders_items ON orders.id_order = orders_items.id_order 
						JOIN produk ON produk.id_produk = orders_items.id_produk 
						WHERE orders.id_member= '".$_SESSION['dunlop_id']."' AND orders.id_order='".$_GET['order']."'";
	  		$query	= mysql_query($sql);
			 while($d = mysql_fetch_array($query)){
                    $produkidi = $d['id_produk'];
                    $idorder= $d['id_order'];
                    $jumlah = $d['jumlah_order'];
					$stok   = $d['stok'];
					$stokupdate = $stok - $jumlah;
                    $update = mysql_query("UPDATE produk SET stok = '".$stokupdate."' WHERE id_produk = '".$produkidi."'");
					
			 }
	  
			if($metode =='cod'){
			$setaddsql = "UPDATE orders SET tipe_pembayaran = '".$metode."',tgl_bayar=NOW() ,status ='2' WHERE id_member='".$_SESSION['dunlop_id']."' AND id_order='".$_GET['order']."'";
			$sukses2 = mysql_query($setaddsql);
			
			echo "<div class='alert alert-success alert-dismissible' role='alert'>
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
					<span aria-hidden='true'>&times;</span></button>
				Terima Kasih telah melakukan pemesanan, pemesanan anda akan segera di proses.
				</div>";
			$print = "<a href='print-pesanan.php?order=$_GET[order]' target='_blank' class='btn btn-large btn-success pull-right'><i class='icon-print'></i> Print</a>";
			$print2= "";
			$print3 = "<a href='?page=produk&kat=all' class='btn btn-large btn-info pull-right'><i class='icon-ok-circle'></i> Selesai</a>";
		}else{
			$setaddsql = "UPDATE orders SET tipe_pembayaran = '".$metode."',tgl_bayar=NOW() ,status ='2' WHERE id_member='".$_SESSION['dunlop_id']."' AND id_order='".$_GET['order']."'";
	$sukses2 = mysql_query($setaddsql);
			echo "<meta http-equiv=Refresh content=0;url=?page=konfirmasi>";
			//echo "<meta http-equiv=Refresh content=1;url=?page=komfirmasi&order=$_GET['order']";
		}
			
			
	    }
       ?>
        <br>
        <form class="form-horizontal" name="formdd" method="post" enctype="multipart/form-data"> 
         <div class="control-group">
            <label class="control-label">Metode Pembayaran<sup>*</sup></label>
            <div class="controls">
              <select autofocus required name="inputbayar" class="controls-row">
               <option value="">Pilih </option>
               <option value="cod">Cash On Delivery </option>
               <option value="bca">BCA </option>
               <option value="bni">BNI </option>
               <option value="bri">BRI </option>
             </select>
            </div>
        </div>
        <br>
        <br>
        <div class="control-group">
         <?php echo $print2;?>
         <span class="pull-right">&nbsp;</span>
         <?php echo $print?>
         <span class="pull-right">&nbsp;</span>
         <?php echo $print3?>
         
         </div>
         </form>
        
                   
      </div>
      <!-- adsasdasd -------------------------------------------------------------------------------------->
      <div class="span2">
         <h3>Pembayaran</h3><br>
         <div class="control-group">
         <p>
           <label class="radio">
             <img width="150" src="assets/img/cod.png" alt=""/>
           </label>
           <hr class="soften">
           <br>
           <label class="radio">
           <img width="150" src="assets/img/bca.png" alt=""/>
             <p><br>1563016616<br> 
             Cab. Padang a/n Asep</p>
           </label>
           <hr class="soften">
           <br>
           <label class="radio">
           <img width="170" src="assets/img/bri.png" alt=""/>
             <p><br>
               000501001641300<br> 
           Cab. Padang a/n Asep</p>
           </label>
           <hr class="soften">
           <br>
           <label class="radio">
            <img width="150" src="assets/img/bni.png" alt=""/>
           <p><br>0287171911<br> 
           Cab. Padang a/n Asep</p>
           </label>
           <br>
         </p>
       </div>
    </div>
	
</div>