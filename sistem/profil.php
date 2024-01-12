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
		
		if ($_SESSION['dunlop_level'] == 1){ $level = "Administrator"; }else
		if ($_SESSION['dunlop_level'] == 3){ $level = "Sales"; }else
		if ($_SESSION['dunlop_level'] == 4){ $level = "Managemen"; }else
		if ($_SESSION['dunlop_level'] == 5){ $level = "Gudang"; }
		
		if($_SESSION['dunlop_id'] == 'superadmin'){
			$avatar = "../images/avatar/avatar.png";
			$nama	= ucfirst($_SESSION['dunlop_username']);
			$jk		= "-";
			$tplahir= "-";
			$tglahir= "-";
			$alamat	= "-";
			$notelp	= "-";
			$email	= "-";
			$notelp	= "-";
			$updateprofil = "";
		}else{
			$sql 	= "SELECT * FROM karyawan WHERE id_karyawan = '".$_SESSION['dunlop_id']."'";
			$query 	= mysql_query($sql,$server);
			$data	= mysql_fetch_array($query);
			$nama	= $data['nama'];
			$jk		= $data['jk'];
			$tplahir= $data['tmp_lahir'];
			$tglahir= $data['tgl_lahir'];
			$alamat	= $data['alamat'];
			$notelp	= $data['no_telp'];
			$email	= $data['email'];
			$notelp	= $data['no_telp'];
			if ($data['foto'] == ""){
			$avatar = "../images/avatar/avatar.png";
			}else{
			$avatar = "../images/avatar/".$data['foto'];
			}
			$updateprofil = "<a href='?page=profil-update' class='btn btn-success'><i class='fa fa-edit m-right-xs'></i> Update Profil</a>";
		}
		
	  ?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            
            <div class="page-title">
              <div class="title_left">
                <h3>Profile</h3>
              </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><?php echo $nama;?></h2>
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

                      <ul class="list-unstyled user_data">
                        <li><i class="fa fa-briefcase user-profile-icon"></i> <?php echo $level?></li>
                      </ul>

                      <?php echo $updateprofil;?>
                      
                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-12">

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
                          <td width="75%"><?php echo $_SESSION['dunlop_id']?></td>
                        </tr>
                      	<tr>
                      	  <td>Nama</td>
                      	  <td><?php echo $nama?></td>
                   	    </tr>
                      	<tr>
                      	  <td>Jenis Kelamin</td>
                      	  <td><?php echo $jk?></td>
                   	    </tr>
                      	<tr>
                      	  <td>Tempat / Tanggal Lahir</td>
                      	  <td><?php echo $tplahir?> / <?php echo tgl_indo($tglahir)?></td>
                   	    </tr>
                      	<tr>
                      	  <td>Alamat</td>
                      	  <td><?php echo $alamat?></td>
                   	    </tr>
                      	<tr>
                      	  <td>No. Hp/Telp</td>
                      	  <td><?php echo $notelp?></td>
                   	    </tr>
                      	<tr>
                      	  <td>Email</td>
                      	  <td><?php echo $email?></td>
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