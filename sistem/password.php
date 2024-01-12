    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
      <?php 
		include_once "sidebar.php";
		include_once "topbar.php";
		
		if($_SESSION['dunlop_id'] == 'superadmin'){
			$nama	= ucfirst($_SESSION['dunlop_username']);
		}else{
			$sql 	= "SELECT * FROM karyawan WHERE id_karyawan = '".$_SESSION['dunlop_id']."'";
			$query 	= mysql_query($sql,$server);
			$data	= mysql_fetch_array($query);
			$nama	= $data['nama'];
		}
		
	  ?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            
            <div class="page-title">
              <div class="title_left">
                <h3>Ganti Password</h3>
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
                    <div class="col-md-12 col-sm-12 col-xs-12">

                      <?php
						if(isset($_POST['btnsimpan'])){
						$inppasslama= md5($_POST['passlama']);
						$inppass	= $_POST['passbaru1'];
						$inppass2	= $_POST['passbaru2'];
						
						if(trim($_SESSION['dunlop_password']) != trim($inppasslama)){
								echo "<div class='alert alert-warning alert-dismissible' role='alert'>
								<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
								<i class='fa fa-info-circle'></i> Password Lama Salah!.
								</div>";
						}else{
						
							if (trim($inppass) != trim($inppass2)) {
								echo "<div class='alert alert-warning alert-dismissible' role='alert'>
								<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
								<i class='fa fa-info-circle'></i> Password Tidak Sama!.
								</div>";
							}else{
								$sql 	= "UPDATE login SET password = '".md5($inppass)."' WHERE id_user='".$_SESSION['dunlop_id']."'";
								$query	= mysql_query($sql);
								if($query){
									echo "<div class='alert alert-success alert-dismissible' role='alert'>
									<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
									<i class='fa fa-check-circle'></i> Password berhasil diganti!.
									</div>";
									$inppass	= "";$inppass2	= "";
									echo "<meta http-equiv='refresh' content='1; url=?page=logout'>";
								}
							}
						}
					}
					?>
                      <!-- start of Data Personal -->
                      <p>&nbsp;</p>
                      <form name="forminput" method="post" data-parsley-validate enctype="multipart/form-data" class="form-horizontal form-label-left">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id">Username
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" class="form-control col-md-7 col-xs-12" id="id" value="<?php echo $_SESSION['dunlop_username']?>" readonly>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="passlama">Password Lama
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="passlama" type="password" required class="form-control col-md-7 col-xs-12" id="passlama" placeholder="Password Lama" title="Password Lama" size="32">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="passbaru1">Password Baru
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="passbaru1" type="password" required class="form-control col-md-7 col-xs-12" id="passbaru1" placeholder="Password Baru" title="Password Baru" size="32">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="passbaru2">Ulangi Password Baru
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="passbaru2" type="password" required class="form-control col-md-7 col-xs-12" id="passbaru2" placeholder="Ulangi Password Baru" title="Ulangi Password Baru" size="32">
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button class="btn btn-primary" type="reset">Reset</button>
                          <button type="submit" name="btnsimpan" class="btn btn-success">Simpan</button>
                        </div>
                      </div>

                    </form>
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
    <!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>
    <!-- morris.js -->
    <script src="../vendors/raphael/raphael.min.js"></script>
    <script src="../vendors/morris.js/morris.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="../vendors/moment/min/moment.min.js"></script>
    <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- jquery.inputmask -->
    <script src="../vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
    
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>

  </body>
</html>