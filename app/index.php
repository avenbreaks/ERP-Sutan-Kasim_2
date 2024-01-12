<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>DUNLOP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

	<!-- Bootstrap style --> 
    <link id="callCss" rel="stylesheet" href="themes/bootshop/bootstrap.min.css" media="screen"/>
    <link href="themes/css/base.css" rel="stylesheet" media="screen"/>
	<!-- Bootstrap style responsive -->	
	<link href="themes/css/bootstrap-responsive.min.css" rel="stylesheet"/>
	<link href="themes/css/font-awesome.css" rel="stylesheet" type="text/css">
	<!-- Google-code-prettify -->	
	<link href="themes/js/google-code-prettify/prettify.css" rel="stylesheet"/>
	<!-- fav and touch icons -->
    <link rel="shortcut icon" href="themes/images/ico/favicon.ico">
    
  </head>
<body>
<div id="header">
<div class="container">

<!-- Navbar ================================================== -->
<?php 
include_once "../lib/koneksi.php";
include_once "../lib/fungsi.php";
include "navbar.php";
?>
</div>
</div>
<!-- Header End====================================================================== -->
<?php
if ($_GET['page'] == 'home'){include "slider.php";}else{}
?>
<div id="mainBody">
  <div class="container">
	<div class="row">
	<?php
	// Sidebar ================================================== 
	 include "sidebar.php";
	// Sidebar end===============================================
	// Content ==================================================
    if ($_GET['page'] == 'kontak'){include "kontak.php";}else
	if ($_GET['page'] == 'home'){include "home.php";}else
	if ($_GET['page'] == 'login'){include "login.php";}else
	if ($_GET['page'] == 'daftar'){include "register.php";}else
	if ($_GET['page'] == 'produk'){include "produk.php";}else
	if ($_GET['page'] == 'produk-detail'){include "produk_detail.php";}else
	{}
    
	if(!empty($_SESSION['dunlop_username'])){
	 	if ($_GET['page'] == 'logout'){include "logout.php";}else
		if ($_GET['page'] == 'profil'){include "profil.php";}else
		if ($_GET['page'] == 'profil-update'){include "profil_update.php";}else
		if ($_GET['page'] == 'keranjang-belanja'){include "cart.php";}else
		if ($_GET['page'] == 'detail-transaksi'){include "cart_order.php";}else
		if ($_GET['page'] == 'pembayaran'){include "cart_pembayaran.php";}else
		if ($_GET['page'] == 'tools'){include "cart_tools.php";}else
		if ($_GET['page'] == 'konfirmasi'){include "cart_konfirmasi.php";}else
		if ($_GET['page'] == 'cek-pengiriman'){include "cek_pengiriman.php";}else
		{}
	}
	
    // Content end===============================================
	 ?>
	</div>
  </div>
</div>
<!-- Footer ================================================================== -->
	<?php include "footer.php";?>
<!-- Placed at the end of the document so the pages load faster ============================================= -->
	<script src="themes/js/jquery.js" type="text/javascript"></script>
	<script src="themes/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="themes/js/google-code-prettify/prettify.js"></script>
	<script src="themes/js/bootshop.js"></script>
    <script src="themes/js/jquery.lightbox-0.5.js"></script>
	
</body>
</html>