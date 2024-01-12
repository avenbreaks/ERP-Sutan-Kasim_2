<div class="span9">		
<div class="well well-small">
<div class="row-fluid">
<div id="featured" class="carousel slide">
<h4>Produk Terbaru </h4>
<div class="carousel-inner">
  <div class="item active">
  <ul class="thumbnails">
    <?php
	$sql   = "SELECT * FROM produk ORDER BY id_produk DESC LIMIT 0,4";
	$query = mysql_query($sql);
	while ($data  = mysql_fetch_array($query)){
		$foto = $data['foto_produk'];
		if ($foto == ""){
			$foto = "no_foto.jpg";
		}
		$idproduk = $data['id_produk'];
		$kodeproduk[] = $data['id_produk'];
	?>
    <li class="span3">
      <div class="thumbnail">
      <i class="tag"></i>
        <a href="?page=produk-detail&id=<?php echo $idproduk ?>"><img src="../images/produk/<?php echo $foto?>" alt=""></a>
        <div class="caption">
          <h5><?php echo $data['nama_produk']?></h5>
          <h4 style="text-align:center"><span >Rp. <?php echo format_rupiah($data['harga'])?></span></h4>
          <h4 style="text-align:center"><a class="btn" href="?page=produk-detail&id=<?php echo $data['id_produk']?>">VIEW <i class="icon icon-search"></i></a></h4>
        </div>
      </div>
    </li>
    <?php }
	$kp1 = $kodeproduk[0];
	$kp2 = $kodeproduk[1];
	$kp3 = $kodeproduk[2];
	$kp4 = $kodeproduk[3];
	$kp	 = "WHERE id_produk !='".$kp1."' &&
				  id_produk !='".$kp2."' &&
				  id_produk !='".$kp3."' &&
				  id_produk !='".$kp4."'";
	?>
  </ul>
  </div>
  <div class="item">
  <ul class="thumbnails">
  <?php
	$sql2   = "SELECT * FROM produk $kp ORDER BY id_produk DESC LIMIT 0,4";
	$query2 = mysql_query($sql2);
	while ($data2  = mysql_fetch_array($query2)){
		$foto2 = $data2['foto_produk'];
		$kodeproduk3[] = $data2['id_produk'];
		if ($foto2 == ""){
			$foto2 = "no_foto.jpg";
		}
	?>
    <li class="span3">
      <div class="thumbnail">
        <a href="?page=produk-detail&id=<?php echo $data2['id_produk']?>"><img src="../images/produk/<?php echo $foto2?>" alt=""></a>
        <div class="caption">
          <h5><?php echo $data2['nama_produk']?></h5>
          <h4 style="text-align:center"><span >Rp. <?php echo format_rupiah($data2['harga'])?></span></h4>
          <h4 style="text-align:center"><a class="btn" href="?page=produk-detail&id=<?php echo $data['id_produk']?>">VIEW <i class="icon icon-search"></i></a></h4>
        </div>
      </div>
    </li>
    <?php
	 }
	 $kpp1 = $kodeproduk3[0];
	 $kpp2 = $kodeproduk3[1];
	 $kpp3 = $kodeproduk3[2];
	 $kpp4 = $kodeproduk3[3];
	 ?>
  </ul>
  </div>
  </div>
  <a class="left carousel-control" href="#featured" data-slide="prev">‹</a>
  <a class="right carousel-control" href="#featured" data-slide="next">›</a>
  </div>
  </div>
</div>

  <ul class="thumbnails">
  <?php
	$sql3   = "SELECT * FROM produk ORDER BY nama_produk ASC LIMIT 0,9";
	$query3 = mysql_query($sql3);
	while ($data3  = mysql_fetch_array($query3)){
		$foto3 = $data3['foto_produk'];
		if ($foto3 == ""){
			$foto3 = "no_foto.jpg";
		}
		if (($data3['id_produk'] == $kp1) or 
			($data3['id_produk'] == $kp2) or
			($data3['id_produk'] == $kp3) or
			($data3['id_produk'] == $kp4))
			{$add = "<i class='tag'></i>";}else
			{$add ="";}
	?>
    <li class="span3">
      <div class="thumbnail">
      	<?php echo $add?>
        <a href="?page=produk-detail&id=<?php echo $data3['id_produk']?>"><img src="../images/produk/<?php echo $foto3?>" alt=""></a>
        <div class="caption">
          <h5><?php echo $data3['nama_produk']?></h5>
          <p><?php echo $data3['deskripsi']?></p>
         
          <h4 style="text-align:center"><a class="btn btn-primary">Rp. <?php echo format_rupiah($data3['harga'])?></a></h4>
				   <h4 style="text-align:center">
                   	  <a class="btn" href="?page=produk-detail&id=<?php echo $data3['id_produk']?>"> <i class="icon-zoom-in"></i></a> 
                      <a class="btn" href="?page=produk-detail&id=<?php echo $data3['id_produk']?>">Add to <i class="icon-shopping-cart"></i></a></h4>
        </div>
      </div>
    </li>
    <?php }?>
  </ul>	

</div>
</div>
</div>
</div>