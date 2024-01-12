<?php
	$sql   = "SELECT * FROM produk WHERE id_produk='".$_GET['id']."'";
	$query = mysql_query($sql);
	$data  = mysql_fetch_array($query);
	$jstok = $data['stok'];
	$foto = $data['foto_produk'];
	if ($foto == ""){
	$foto = "no_foto.jpg";
	}
?>
<div class="span9">
<ul class="breadcrumb">
<li><a href="?page=home">Home</a> <span class="divider">/</span></li>
<li><a href="?page=produk&kat=all">Produk</a> <span class="divider">/</span></li>
<li class="active">Produk Detail</li>
</ul>	
<?php
  $j_order= "";
  if(isset($_POST['btnInput'])){
	 if(empty($_SESSION['dunlop_username'])){
		 echo "<meta http-equiv=Refresh content=0;url=?page=login>";
	 }else{
		 $j_order = $_POST['InpQty']; //2
		 $j_stok  = $data['stok']; // 1
		 if ($j_stok == 0){
			echo "<div class='alert alert-warning alert-dismissible' role='alert'>
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
					<span aria-hidden='true'>&times;</span></button>
				Produk Sudah Habis
				</div>";
		 }else
		 if ($j_stok < $j_order){
			echo "<div class='alert alert-warning alert-dismissible' role='alert'>
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
					<span aria-hidden='true'>&times;</span></button>
				Stok Tidak Mencukupi
				</div>";
		 }else{
		 	//simpan order
			
			$pesan = "<div class='alert alert-success alert-dismissible' role='alert'>
					<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
						<span aria-hidden='true'>&times;</span></button>
					Berhasil menambahkan ke keranjang belanja!
					</div>";
			
			$idmember = $_SESSION['dunlop_id'];
			$jinput   = $j_order;
			$cekharga = mysql_fetch_array(mysql_query("SELECT harga FROM produk WHERE id_produk ='".$_GET['id']."'"));
			$hargadb  = $cekharga['harga'];
			$tot = $j_order * $hargadb;
			
			$sqlcekorder 	= "SELECT * FROM orders JOIN orders_items ON orders.id_order = orders_items.id_order WHERE orders.id_member='".$idmember."' AND orders.status='1'";
			$querycekorder	= mysql_query($sqlcekorder);
			$cekorder		= mysql_num_rows($querycekorder);
			$j				= $cekorder;
			
			if ($j == 0){
				$kode = NewKode("orders","REF");
				
				$proses  = mysql_query("INSERT INTO orders VALUES (
									'$kode', '".$_SESSION['dunlop_id']."', '0', '0', '0',
									NOW(), '0000:00:00 00:00:00', '1', '0', '0', '$tot',' ')");
									
				$sql2 = mysql_query("INSERT INTO orders_items SET id_order = '$kode',
									id_produk= '".$_GET['id']."', jumlah_order='".$jinput."'");
				
				if($proses && $sql2){
					echo "$pesan";
				}
				
			}else if ($j > 0){
				$sql3 	= "SELECT id_order FROM orders WHERE id_member ='".$idmember."' && status='1'";
				$query3	= mysql_query($sql3);
				$d3		= mysql_fetch_array($query3);
				$id_orderss =  $d3['id_order'];
				
				$sql4 	= "SELECT * FROM orders_items WHERE id_order='".$id_orderss."' && id_produk='".$_GET['id']."'";
				$query4	= mysql_query($sql4);
				$jd4	= mysql_num_rows($query4);
				$d4		= mysql_fetch_array($query4);
				$jpesan =  $d4['jumlah_order'];
				$database = mysql_fetch_array($querycekorder);
				
				$gtot =  $database['total'] + $tot;
				if($jd4 == 0){
					$sql7 = mysql_query("UPDATE orders SET 
										total='".$gtot."' WHERE id_order = '".$id_orderss."' && status ='1'");
					$sql5 = mysql_query("INSERT INTO orders_items SET 
										id_order 	= '".$id_orderss."',
										id_produk 	= '".$_GET['id']."',
										jumlah_order= '".$_POST['InpQty']."'");
					
					if($sql5 && $sql7){
						echo "$pesan";
					}
				}else if($jd4 > 0){
					$jt = $jpesan + $_POST['InpQty'];
					$sql8 = mysql_query("UPDATE orders SET total='".$gtot."' WHERE id_order = '".$id_orderss."' && status ='1'");
					$sql6 = mysql_query("UPDATE orders_items SET jumlah_order='".$jt."' WHERE id_order = '".$id_orderss."' && id_produk ='".$_GET['id']."'");
					if($sql6 && $sql8){
						echo "$pesan";
				
					}
				}
			}
			//
		 }
	 }
  }
?>
<div class="row">	  
        <div id="gallery" class="span3">
        <a href="../images/produk/<?php echo $foto?>" title="<?php echo $data['nama_produk']?>">
            <img src="../images/produk/<?php echo $foto?>" style="width:100%" alt="<?php echo $data['nama_produk']?>"/>
        </a>
        </div>
        <div class="span6">
            <h3><?php echo $data['nama_produk']?></h3>
            <hr class="soft"/>
            <form method="post" class="form-horizontal qtyFrm" enctype="multipart/form-data">
              <div class="control-group">
                <label class="control-label"><span>Rp. <?php echo format_rupiah($data['harga'])?></span></label>
                <div class="controls">
                <input name="InpQty" type="number" required="required" class="span1" id="InpQty" placeholder="Qty." max="100" min="1" title="Jumlah Order" value="<?php echo $j_order?>"/>
                  <button type="submit" name="btnInput" class="btn btn-large btn-primary pull-right"> Add to cart <i class=" icon-shopping-cart"></i></button>
                </div>
              </div>
            </form>
            
            <hr class="soft"/>
            <h4><?php echo $data['stok']?> items tersedia</h4>
            <hr class="soft clr"/>
            <p><?php echo $data['deskripsi']?></p>
            <br class="clr"/>
        	<a href="?page=keranjang-belanja" class="btn btn-large btn-warning pull-right"> Lanjut <i class=" icon-arrow-right"></i></a>
            <span class='pull-right'>&nbsp;</span>
            <a href="?page=produk&kat=all" class="btn btn-large btn-warning pull-right"><i class=" icon-shopping-cart"></i> Belanja Lagi</a>
            <br class="clr"/>
        <a href="#" name="detail"></a>
        <hr class="soft"/>
        </div>
        
        <div class="span9">
        <ul id="productDetail" class="nav nav-tabs">
          <li class="active"><a href="#home" data-toggle="tab">Produk Detail</a></li>
          <li><a href="#profile" data-toggle="tab">Produk Sejenis</a></li>
        </ul>
        <div id="myTabContent" class="tab-content">
          <div class="tab-pane fade active in" id="home">
          <h4>Informasi Produk</h4>
            <table class="table table-bordered">
            <tbody>
            <tr class="techSpecRow">
              <td class="techSpecTD1" width="20%">Lebar Pelek </td>
              <td class="techSpecTD2"><?php echo $data['ukuran_pelek']?> Inc.</td></tr>
            <tr class="techSpecRow">
              <td class="techSpecTD1">Lebar Ban:</td>
              <td class="techSpecTD2"><?php echo $data['lebar_ban']?> Inc.</td></tr>
            <tr class="techSpecRow">
              <td class="techSpecTD1">Speed Rating</td>
              <td class="techSpecTD2"><?php echo $data['speed_rating']?></td></tr>
            </tbody>
            </table>
            
            <h4>Speed Rating</h4>
            <ul>
              <li>Q - Kecepatan Maksimal adalah 99 MPH </li>
              <li>R - Kecepatan Maksimal adalah 106 MPH </li>
              <li>S - Kecepatan Maksimal adalah 112 MPH </li>
              <li>T - Kecepatan Maksimal adalah 118 MPH </li>
              <li>U - Kecepatan Maksimal adalah 124 MPH </li>
              <li>H - Kecepatan Maksimal adalah 130 MPH </li>
              <li>V - Kecepatan Maksimal adalah 149 MPH </li>
            </ul>
          </div>
    <div class="tab-pane fade" id="profile">
    <div class="tab-content">
    </div>
        <div class="tab-pane active" id="blockView">
            <ul class="thumbnails">
			<?php
				$sql   = "SELECT * FROM produk WHERE id_produk != '".$_GET['id']."' AND id_kategori = '".$data['id_kategori']."' ORDER BY id_produk DESC";
				$query = mysql_query($sql);
				while ($data  = mysql_fetch_array($query)){
					
					$foto = $data['foto_produk'];
					if ($foto == ""){
						$foto = "no_foto.jpg";
					}
			?>
            <li class="span3">
			  <div class="thumbnail">
				<a href="?page=produk-detail&id=<?php echo $data['id_produk']?>"><img src="../images/produk/<?php echo $foto?>" alt=""/></a>
				<div class="caption">
				  <h5><u><?php echo $data['nama_produk']?></u></h5>
				   <h4 style="text-align:center">Rp. <?php echo format_rupiah($data['harga'])?></h4>
				   <h4 style="text-align:center"><a class="btn" href="product_details.html"> <i class="icon-zoom-in"></i></a> <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a></h4>
				</div>
			  </div>
			</li>
			<?php } ?>
		  </ul>
        <hr class="soft"/>
        </div>
    </div>
            <br class="clr">
                 </div>
    </div>
      </div>

</div>
</div>
