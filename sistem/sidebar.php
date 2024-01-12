<?php
$j_kry = mysql_num_rows(mysql_query("SELECT id_karyawan FROM karyawan"));
$j_mbr = mysql_num_rows(mysql_query("SELECT id_member FROM member"));
$j_prd = mysql_num_rows(mysql_query("SELECT id_produk FROM produk"));

$sql_order_admin2 = "SELECT * FROM orders JOIN
					 member ON orders.id_member = member.id_member
					 WHERE status != '1' AND orders.validasi != 'yes' ORDER BY orders.tgl_order DESC";
$qry_order_admin2 = mysql_query($sql_order_admin2);
$j_ordeeeer = mysql_num_rows($qry_order_admin2);

$sql_order_admin = "SELECT *, count(id_produk) AS Jitem FROM orders JOIN orders_items ON
					 orders.id_order = orders_items.id_order JOIN member ON
					 orders.id_member= member.id_member WHERE orders.validasi != 'yes' ORDER BY orders.tgl_order DESC";
$qry_order_admin = mysql_query($sql_order_admin);

?>
<div class="col-md-3 left_col">
  <div class="left_col scroll-view">
    <div class="navbar nav_title" style="border: 0;">
      <a href="?page=home" class="site_title"><i class="fa fa-home"></i> <span>DUNLOP</span></a>
    </div>
	<div class="clearfix"></div>
    <!-- sidebar menu -->
    <?php if($_SESSION['dunlop_level'] == '1'){ ?>
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
      <div class="menu_section">
        <ul class="nav side-menu">
          <li><a href="../app/?page=home" target="_blank"><i class="fa fa-laptop"></i> Lihat Web</a></li>
          <li><a href="?page=karyawan"><i class="fa fa-briefcase"></i> Karyawan<span class="pull-right badge bg-blue"><?php echo $j_kry?></span></a></li>
          <li><a href="?page=member"><i class="fa fa-sitemap"></i> Member<span class="pull-right badge bg-green"><?php echo $j_mbr?></span></a></li>
          <!-- <li><a href="?page=produk"><i class="fa fa-puzzle-piece"></i> Produk</a></li>-->
          
          <li><a><i class="fa fa-puzzle-piece"></i> Produk<span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="?page=produk">Produk</a></li>
              <li><a href="?page=kategori">Kategori</a></li>
            </ul>
          </li>
          
          <li><a href="?page=order"><i class="fa fa-tags"></i> Order<span class="pull-right badge bg-orange"><?php echo $j_ordeeeer?></span></a></li>
          <li><a href="?page=promo"><i class="fa fa-magic"></i> Promo</a></li>
        </ul>
      </div>
    </div>
    <?php 
	}else
	
	if($_SESSION['dunlop_level'] == '3'){ 
	?>
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
      <div class="menu_section">
        <ul class="nav side-menu">
          <li><a href="?page=member"><i class="fa fa-sitemap"></i> Member<span class="pull-right badge bg-green"><?php echo $j_mbr?></span></a></li>
          <li><a href="?page=produk"><i class="fa fa-cubes"></i> Produk<span class="pull-right badge bg-primary"><?php echo $j_prd?></span></a></li>
          <li><a><i class="fa fa-tags"></i> Order<span class="fa fa-chevron-down"></span></a>
          	<ul class="nav child_menu">
              <li><a href="?page=order">Order Masuk</a></li>
              <li><a href="?page=history-order">Riwayat Order</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
    <?php }else ?>
    
    <?php if($_SESSION['dunlop_level'] == '4'){ ?>
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
      <div class="menu_section">
        <ul class="nav side-menu">
          <li><a href="?page=karyawan"><i class="fa fa-briefcase"></i> Karyawan<span class="pull-right badge bg-blue"><?php echo $j_kry?></span></a></li>
          <li><a href="?page=member"><i class="fa fa-sitemap"></i> Member<span class="pull-right badge bg-green"><?php echo $j_mbr?></span></a></li>
          <li><a><i class="fa fa-tags"></i> Order<span class="fa fa-chevron-down"></span></a>
          	<ul class="nav child_menu">
              <li><a href="?page=order">Order Masuk</a></li>
              <li><a href="?page=history-order">Riwayat Order</a></li>
            </ul>
          </li>
          <li><a href="?page=produk"><i class="fa fa-cubes"></i> Produk<span class="pull-right badge bg-primary"><?php echo $j_prd?></span></a></li>
          <li><a href="?page=pembayaran"><i class="fa fa-money"></i> Pembayaran</span></a></li>
          <li><a><i class="fa fa-print"></i> Laporan<span class="fa fa-chevron-down"></span></a>
          	<ul class="nav child_menu">
              <li><a href="?page=surat-jalan">Surat Jalan</a></li>
              <li><a href="?page=laporan-transaksi">Laporan Transaksi</a></li>
              <li><a href="?page=rekap-faktur">Rekap Faktur</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
    <?php }else ?>
    
    <?php if($_SESSION['dunlop_level'] == '5'){ ?>
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
      <div class="menu_section">
        <ul class="nav side-menu">
          <li><a href="?page=produk"><i class="fa fa-cubes"></i> Produk<span class="pull-right badge bg-blue"><?php echo $j_prd?></span></a></li>
          <li><a href="?page=order"><i class="fa fa-tags"></i> Order<span class="pull-right badge bg-orange"><?php echo $j_ordeeeer?></span></a></li>
        </ul>
      </div>
    </div>
    <?php } ?>
    <!-- /sidebar menu -->
  </div>
</div>
    
    <!-- /menu footer buttons -->
    <div class="sidebar-footer hidden-small">
      <a data-toggle="tooltip" data-placement="top" title="Home" href="?page=home">
        <span class="glyphicon glyphicon-home" aria-hidden="true"></span>
      </a>
      <a data-toggle="tooltip">&nbsp;</a>
      <a data-toggle="tooltip">&nbsp;</a>
      <a data-toggle="tooltip" data-placement="top" title="Logout" href="?page=logout">
        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
      </a>
    </div>
    <!-- /menu footer buttons -->
    