    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
	
    <!-- bootstrap-progressbar -->
    <link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <?php 
		include_once "sidebar.php";
		include_once "topbar.php";
		$j_member = mysql_num_rows(mysql_query("SELECT id_member FROM member"));
		$j_produk = mysql_num_rows(mysql_query("SELECT id_produk FROM produk"));
		$j_kategori = mysql_num_rows(mysql_query("SELECT id_kategori FROM kategori"));
		$j_order = mysql_num_rows(mysql_query("SELECT id_order FROM orders WHERE validasi = 'yes'"));
		?>
        
        <!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="row tile_count">
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Member</span>
              <div class="count"><?php echo $j_member?></div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-clock-o"></i> Kategori Produk</span>
              <div class="count"><?php echo $j_kategori?></div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-clock-o"></i> Produk</span>
              <div class="count green"><?php echo $j_produk?></div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i></i>Items</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Order Sukses</span>
              <div class="count blue"><?php echo $j_order?></div>
              <span class="count_bottom"><i class="blue"><i class="fa fa-sort-asc"></i></i>Transaksi</span>
            </div>
          </div>
          <!-- /top tiles -->
		  
       	  	  <div class="col-md-10 col-sm-10 col-xs-12">
                <div class="x_title">
                  <h2>Kategori Produk</h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <?php
					  $Qry_kat = mysql_query("SELECT * FROM kategori");
					  $no=1;
					  while($dkat	   = mysql_fetch_array($Qry_kat)){
						  $j_prd_kat = mysql_num_rows(mysql_query("SELECT id_kategori FROM produk WHERE id_kategori = '$dkat[id_kategori]'"));
						  $pnj = ($j_prd_kat / $j_produk)*100;
						  
					  if ($no = 1) {$w = "bg-blue";}else
					  if ($no = 2) {$w = "bg-green";}else
					  if ($no = 3) {$w = "bg-purple";}else
					  if ($no = 4) {$w = "bg-aero";}else
					  if ($no = 5) {$w = "bg-red";}else
					  			   {$w = "bg-blue";}
					  
                      ?>
                  <div class="widget_summary">
                    <div class="w_left w_25">
                      <span><?php echo $dkat['kategori']?></span>
                    </div>
                    <div class="w_center w_55">
                      <div class="progress">
                        <div class="progress-bar <?php echo $w?>" role="progressbar" aria-valuenow="<?php echo $pnj?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $pnj?>%;">
                          <span class="sr-only"><?php echo $pnj?>%</span>
                        </div>
                      </div>
                    </div>
                    <div class="w_right w_20">
                      <span><?php echo $j_prd_kat?> Items</span>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                 <?php $no++;}?>
                </div>
              </div>
        	</div>

         
        <!-- /page content -->

        <!-- footer content -->
        <?php include "../lib/footer.php";?>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="../vendors/skycons/skycons.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
	
  </body>
</html>
