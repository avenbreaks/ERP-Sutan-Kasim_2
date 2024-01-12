    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
      <?php 
		include_once "sidebar.php";
		include_once "topbar.php";
		
		$sql 	= "SELECT * FROM produk JOIN kategori ON 
								 produk.id_kategori = kategori.id_kategori WHERE
								 id_produk = '".$_GET['id']."'";
		$query 	= mysql_query($sql,$server);
		$data	= mysql_fetch_array($query);
		$nama	= $data['nama_produk'];
		$des	= $data['deskripsi'];
		$pelek	= $data['ukuran_pelek'];
		$lebar	= $data['lebar_ban'];
		$speed	= $data['speed_rating'];
		$stok	= $data['stok'];
		$harga	= format_rupiah($data['harga']);
		$kategori	= $data['kategori'];
		if ($data['foto_produk'] == ""){
		$avatar = "../images/produk/avatar.png";
		}else{
		$avatar = "../images/produk/".$data['foto_produk'];
		}
		
	  ?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            
            <div class="page-title">
              <div class="title_left">
                <h3>Produk</h3>
              </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Produk Detail</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                      <div class="profile_img">
                        <div id="crop-avatar">
                          <!-- Current avatar -->
                          <img class="img-responsive avatar-view" src="<?php echo $avatar;?>" alt="Avatar" 
                          	style="max-width:220px;min-width:220px;">
                        </div>
                      </div>
                      <h3><?php echo ucwords(strtolower($nama));?></h3>

                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                    <a href='?page=produk' class='btn btn-warning'><i class='fa fa-arrow-left m-right-xs'></i> Kembali</a>

                      <div class="profile_title">
                        <div class="col-md-6">
                          <h2>Data Personal</h2>
                        </div>
                      </div>
                      <!-- start of Data Personal -->
                      <p>
                      <table width="100%" class="table table-responsive">
                      	<tr>
                          <td width="25%">ID</td>
                          <td width="75%"><?php echo $_GET['id']?></td>
                        </tr>
                      	<tr>
                      	  <td>Nama Produk</td>
                      	  <td><?php echo $nama?></td>
                   	    </tr>
                      	<tr>
                      	  <td>Deskripsi</td>
                      	  <td><?php echo $des?></td>
                   	    </tr>
                      	<tr>
                      	  <td>Ukuran Pelek</td>
                      	  <td><?php echo $pelek?> Inc.</td>
                   	    </tr>
                      	<tr>
                      	  <td>Lebar Ban</td>
                      	  <td><?php echo $lebar?> Inc.</td>
                   	    </tr>
                      	<tr>
                      	  <td>Speed Rating</td>
                      	  <td><?php echo $speed?></td>
                   	    </tr>
                      	<tr>
                      	  <td>Stok</td>
                      	  <td><?php echo $stok?></td>
                   	    </tr>
                        <tr>
                      	  <td>Harga</td>
                      	  <td>Rp. <?php echo $harga?></td>
                   	    </tr>
                        <tr>
                      	  <td>Kategori</td>
                      	  <td><?php echo $kategori?></td>
                   	    </tr>
                      </table>
                      </p>
                      <!-- end of Data Personal -->
                      
                      </div>
                    </div>
                  </div>
                </div>
              </div>
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
    <!-- morris.js -->
    <script src="../vendors/raphael/raphael.min.js"></script>
    <script src="../vendors/morris.js/morris.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="../vendors/moment/min/moment.min.js"></script>
    <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>

  </body>
</html>