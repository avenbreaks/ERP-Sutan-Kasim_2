<?php
	$sql_kendaraan 	= mysql_query("SELECT id_kendaraan,nama_kendaraan FROM kendaraan ORDER BY nama_kendaraan ASC");
	$j_kendaraan	= mysql_num_rows($sql_kendaraan);
	
	$sql_kategori 	= mysql_query("SELECT * FROM kategori ORDER BY kategori ASC");
	$j_kategori		= mysql_num_rows($sql_kategori);
	
?>
<div id="sidebar" class="span3">
    <ul id="sideManu" class="nav nav-tabs nav-stacked">
        <li class="subMenu open"><a> KATEGORI [<?php echo $j_kategori?>] </a>
            <ul>
            <li><a class="active" href="?page=produk&kat=all"><i class="icon-chevron-right"></i>ALL </a></li>
            <?php
				while ($d_kategori = mysql_fetch_array($sql_kategori)){
					$nama_kategori = $d_kategori['kategori'];
					$nama_kategori_tampil = $d_kategori['id_kategori'];;
            ?>
            <li><a class="active" href="?page=produk&kat=<?php echo $nama_kategori_tampil?>"><i class="icon-chevron-right"></i><?php echo $nama_kategori?></a></li>
            <?php }?>
            </ul>
        </li>
        <!--
        <li class="subMenu"><a> JENIS KENDARAAN [<?php echo $j_kendaraan?>] </a>
        <ul style="display:none">
            <?php
				while ($d_kendaraan = mysql_fetch_array($sql_kendaraan)){
					$nama_kendaraan = $d_kendaraan['nama_kendaraan'];
					$nama_kendaraan_tampil = (str_replace(" ","-",strtolower($nama_kendaraan)));
            ?>
            <li><a class="active" href="?page=produk&kat=null&car=<?php echo $nama_kendaraan_tampil?>"><i class="icon-chevron-right"></i><?php echo $nama_kendaraan?></a></li>
            <?php }?>												
        </ul>
        </li>
        -->
    </ul>
    <br/>
        <div class="thumbnail">
            <img src="themes/images/payment_methods.png" title="Bootshop Payment Methods" alt="Payments Methods">
            <div class="caption">
              <h5>Payment Methods</h5>
            </div>
          </div>
	</div>