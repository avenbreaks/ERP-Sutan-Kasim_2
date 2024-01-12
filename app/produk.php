<?php
if ($_GET['kat'] == 'all'){
$Sort = "";
}else{
$Sort = "WHERE id_kategori = '".$_GET['kat']."'";
}


?>	
    <div class="span9">
    <ul class="breadcrumb">
		<li><a href="?page=home">Home</a> <span class="divider">/</span></li>
		<li class="active">Produk</li>
    </ul>
	<form class="form-horizontal span6">
		<div class="control-group">&nbsp;</div>
	  </form>
	  
<div id="myTab" class="pull-right">
 <a href="#listView" data-toggle="tab"><span class="btn btn-large"><i class="icon-list"></i></span></a>
 <a href="#blockView" data-toggle="tab"><span class="btn btn-large btn-primary"><i class="icon-th-large"></i></span></a>
</div>
<br class="clr"/>
<div class="tab-content">
	<div class="tab-pane" id="listView">
		<?php 
		    $sql2   = "SELECT * FROM produk $Sort ORDER BY id_produk DESC";
			$query2 = mysql_query($sql2);
            while ($data2  = mysql_fetch_array($query2)){
                $foto2 = $data2['foto_produk'];
                if ($foto2 == ""){
                    $foto2 = "no_foto.jpg";
                }
        ?>
		<div class="row">	  
			<div class="span2">
				<img src="../images/produk/<?php echo $foto2?>" alt=""/>
			</div>
			<div class="span4">
				<h3><?php echo $data2['nama_produk'];?></h3>
				<hr class="soft"/>
				<p><?php echo $data2['deskripsi'];?></p>
				
				<br class="clr"/>
			</div>
			<div class="span3 alignR">
			<form class="form-horizontal qtyFrm">
			<h3>Rp. <?php echo format_rupiah($data2['harga'])?></h3>
			  <a href="?page=produk-detail&id=<?php echo $data2['id_produk']?>" class="btn btn-large btn-primary"> Add to <i class=" icon-shopping-cart"></i></a>
			  <a href="?page=produk-detail&id=<?php echo $data2['id_produk']?>" class="btn btn-large"><i class="icon-zoom-in"></i></a>
				</form>
			</div>
		</div>
		<hr class="soft"/>
		<?php }?>
	</div>

	<div class="tab-pane  active" id="blockView">
		<ul class="thumbnails">
			<?php
				$sql   = "SELECT * FROM produk $Sort ORDER BY id_produk DESC";
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
				   <h4 style="text-align:center">
                   	  <a class="btn" href="?page=produk-detail&id=<?php echo $data['id_produk']?>"> <i class="icon-zoom-in"></i></a> 
                      <a class="btn" href="?page=produk-detail&id=<?php echo $data['id_produk']?>">Add to <i class="icon-shopping-cart"></i></a></h4>
				</div>
			  </div>
			</li>
			<?php } ?>
		  </ul>
	<hr class="soft"/>
	</div>
  </div>
</div>