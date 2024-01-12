<?php
if(empty($_SESSION['dunlop_username'])){

?>
<!-- Menu untuk non-member -->
<div id="welcomeLine" class="row"><a href="../login.php" class="pull-right">Login Admin ?</a></div>
<div id="logoArea" class="navbar">
<a id="smallScreen" data-target="#topMenu" data-toggle="collapse" class="btn btn-navbar">
	<span class="icon-bar"></span>
	<span class="icon-bar"></span>
	<span class="icon-bar"></span>
</a>
  <div class="navbar-inner">
    <a class="brand" href="?page=home"><img src="themes/images/logo.png" alt="..."/></a>
    <ul id="topMenu" class="nav pull-right">
	  <li class=""><a href="?page=produk&kat=all">Produk</a></li>
	  <li class=""><a href="?page=kontak">Kontak</a></li>
      <li class=""><a href="?page=daftar">Daftar</a></li>
      <li class=""><a href="?page=login">Login</a></li>
	</ul>
  </div>
</div>
<?php }else if(!empty($_SESSION['dunlop_username'])){ 

$SQL_order = mysql_query("SELECT id_order FROM orders WHERE id_member ='".$_SESSION['dunlop_id']."' && status = '1'");
$DAT_order = mysql_fetch_array($SQL_order);

$SQL_item  = mysql_query("SELECT * FROM orders_items WHERE id_order='".$DAT_order['id_order']."'");
$J_item	= mysql_num_rows($SQL_item);


?>
<!-- Menu untuk member -->
<div id="welcomeLine" class="row-fluid">
  <span class="pull-left">Selamat Datang! <b><a href="?page=profil"><?php echo $_SESSION['dunlop_username'] ?></a></b></span>
  <span class="pull-right">
    <a href="?page=keranjang-belanja" class="btn btn-small btn-primary"><i class="icon icon-shopping-cart"></i> [<?php echo $J_item?>] Item di keranjang belanja anda</a>
  </span>
</div>
<div id="logoArea" class="navbar">
<a id="smallScreen" data-target="#topMenu" data-toggle="collapse" class="btn btn-navbar">
	<span class="icon-bar"></span>
	<span class="icon-bar"></span>
	<span class="icon-bar"></span>
</a>
  <div class="navbar-inner">
    <a class="brand" href="?page=home"><img src="themes/images/logo.png" alt="..."/></a>
    <ul id="topMenu" class="nav pull-right">
	  <li class=""><a href="?page=profil">Profil</a></li>
	  <li class=""><a href="?page=produk&kat=all">Produk</a></li>
	  <li class=""><a href="?page=konfirmasi">Konfirmasi</a></li>
      <li class=""><a href="?page=kontak">Kontak</a></li>
      <li class=""><a href="?page=cek-pengiriman">Cek Pengiriman</a></li>
      <li class=""><a href="?page=logout">Logout</a></li>
	</ul>
  </div>
</div>
<?php } ?>