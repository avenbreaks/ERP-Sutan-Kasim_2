<?php
// $sales		= "1:0:0";
// $management	= "0:1:0";
// $gudang 		= "0:0:1";
	
	$level 		= $_SESSION['dunlop_level'];
	if ($level == '1'){
		$view_update = "";
	}else
	if ($level == '3'){
		$view_update = "AND view = '' OR view = 2 OR view = 3 OR view = 23";
	}else
	if ($level == '4'){
		$view_update = "AND view = '' OR view = 1 OR view = 3 OR view = 13";
	}else
	if ($level == '5'){
		$view_update = "AND view = '' OR view = 1 OR view = 2 OR view = 12";
	}

  $sql_alert = "SELECT * FROM orders WHERE status != '1' AND validasi !='yes' ".$view_update."";
  $qry_alert = mysql_query($sql_alert);
  $j_alert = mysql_num_rows($qry_alert);
  if ($j_alert > 0){
  	$icon 	 = "<span class='badge bg-red'>$j_alert</span>";
  }else{
  	$icon 	 = "";
  }
  
if ($level == '1'){}else{

?>

<li role="presentation" class="dropdown">
  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
    <i class="fa fa-bell-o"></i>
    <?php echo $icon?>
  </a>
  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
    <?php
      while($dta_alert = mysql_fetch_array($qry_alert)){
		  $j_alert2   = mysql_num_rows(mysql_query("SELECT * FROM orders_items WHERE id_order='".$dta_alert['id_order']."'"));
		  $dta_alert2 = mysql_fetch_array(mysql_query("SELECT * FROM member WHERE id_member='".$dta_alert['id_member']."'"));
		  
		if ($dta_alert2['foto_member'] == ""){
		$avatar = "../app/foto_member/unavailable.jpg";
		}else{
		$avatar = "../app/foto_member/".$dta_alert2['foto_member'];
		}
		
	?>
    <li>
      <a href="?page=detail-transaksi&order=<?php echo $dta_alert['id_order']?>">
        <span class="image"><img src="<?php echo $avatar?>" alt="Profile Image" /></span>
        <span>
          <span class="time"><?php echo waktu_indo($dta_alert['tgl_order'])?></span><br>
          <span><?php echo ucwords(strtolower($dta_alert2['nama_toko']))?></span>
        </span>
        <span class="message">
          Pesan <?php echo $j_alert2?> Item
        </span>
      </a>
    </li>
    <?php }
    
	if ($j_alert == 0){?>
    <li>
      <div class="text-center">
        <a><strong>Tidak Ada Pemberitahuan</strong></a>
      </div>
    </li>
    <?php }else{ ?>
	<li>
      <div class="text-center">
        <a href="?page=order">
          <strong>Lihat Semua Pesanan</strong>
          <i class="fa fa-angle-right"></i>
        </a>
      </div>
    </li>
	<?php }?>
  </ul>
</li>
<?php }?>