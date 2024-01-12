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
		}else{
			$sql 	= "SELECT * FROM karyawan WHERE id_karyawan = '".$_SESSION['dunlop_id']."'";
			$query 	= mysql_query($sql,$server);
			$data	= mysql_fetch_array($query);
			$nama	= $data['nama'];
			$jk		= $data['jk'];
			$tplahir= $data['tmp_lahir'];
			$tglahir= tgl_indo_format($data['tgl_lahir']);
			$alamat	= $data['alamat'];
			$notelp	= $data['no_telp'];
			$email	= $data['email'];
			$notelp	= $data['no_telp'];
			$foto	= $data['foto'];
			if ($data['foto'] == ""){
			$avatar = "../images/avatar/avatar.png";
			}else{
			$avatar = "../images/avatar/".$data['foto'];
			}
			if ($jk == "pria"){$selp="checked";}else{$selp="";}
			if ($jk == "wanita"){$selw="checked";}else{$selw="";}
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
                      
                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-12">

                      <div class="profile_title">
                        <div class="col-md-6">
                          <h2>Data Personal</h2>
                        </div>
                      </div>
                      <?php
						if(isset($_POST["btnsimpan"])){
							$nama	= htmlspecialchars(strtoupper($_POST['inputNama']));
							$jk		= htmlspecialchars($_POST['inputJk']);
							$tplahir= htmlspecialchars(strtoupper($_POST['inputTempat']));
							$tglahir= htmlspecialchars(save_tgl_english($_POST['inputTanggal']));
							$alamat	= htmlspecialchars($_POST['inputAlamat']);
							$notelp	= htmlspecialchars($_POST['inputHp']);
							$email	= htmlspecialchars( $_POST['inputEmail']);
							
							if (!empty($_FILES['inputFoto']['tmp_name'])) {
								$nama_file 		= $_FILES['inputFoto']['name'];
								$ekstensi_file 	= substr(strtolower(strrchr($nama_file, ".")), 1);
								$nama_file 		= $_SESSION['dunlop_id'].".".$ekstensi_file;
								
								copy($_FILES['inputFoto']['tmp_name'],"../images/avatar/".$nama_file);
							}
							else {
								$nama_file = $foto;
							}
							
								$addsql = "UPDATE karyawan SET nama = '" . strip_tags(addslashes($nama)) . "',
								 jk			= '".$jk."',
								 tmp_lahir	= '".strip_tags(addslashes($tplahir))."',
								 tgl_lahir	= '".$tglahir."', 
								 alamat		= '".strip_tags(addslashes($alamat))."',
								 no_telp	= '".$notelp."',
								 email		= '".strip_tags(addslashes($email))."',
								 foto		= '$nama_file' 
								 WHERE id_karyawan = '".$_SESSION['dunlop_id']."'";
								 
								$sukses = mysql_query($addsql, $server);
								
								if ($sukses){
									echo "<div class='alert alert-success alert-dismissible' role='alert'>
									<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
									<strong>Berhasil Memperbaharui Profil</strong>.
									</div>";
									echo "<meta http-equiv=Refresh content=0;url=?page=profil>";
									
								}
							}
							?>
                      <!-- start of Data Personal -->
                      <p>&nbsp;</p>
                      <form name="forminput" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id">ID
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" class="form-control col-md-7 col-xs-12" id="id" value="<?php echo $_SESSION['dunlop_id']?>" readonly>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputNama">Nama
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="inputNama" type="text" class="form-control col-md-7 col-xs-12" id="inputNama" placeholder="Nama" title="Nama" value="<?php echo $nama?>" size="50">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Kelamin</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div id="inputJk" class="btn-group" data-toggle="buttons">
                             <input name="inputJk" type="radio" class="flat" title="Pria" value="pria" <?php echo $selp?>> &nbsp; Pria &nbsp;
                             <input name="inputJk" type="radio" class="flat" title="Wanita" value="wanita" <?php echo $selw?>> Wanita
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputTempat">Tempat Lahir</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="inputTempat" type="text" class="form-control col-md-7 col-xs-12" id="inputTempat" placeholder="Tempat Lahir" title="Tempat Lahir" value="<?php echo $tplahir?>" size="25">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Lahir</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="inputTanggal" class="date-picker form-control col-md-7 col-xs-12" placeholder="dd-mm-yyyy" title="Tanggal Lahir" value="<?php echo $tglahir?>" data-inputmask="'mask': '99-99-9999'">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputAlamat">Alamat</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea name="inputAlamat" type="text" class="form-control col-md-7 col-xs-12" id="inputAlamat" placeholder="Tempat Lahir" title="Alamat" rows="3"><?php echo $alamat?></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">No. Hp / Telp</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="inputHp" class="date-picker form-control col-md-7 col-xs-12" placeholder="No. Hp / Telp" title="No. Hp / Telp" value="<?php echo $notelp?>" data-inputmask="'mask': '9999-9999-9999'">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputEmail">Email
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="inputEmail" type="email" class="form-control col-md-7 col-xs-12" id="inputEmail" placeholder="Email" title="Email" value="<?php echo $email?>" size="50">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputFoto">File Foto</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="inputFoto" type="file" class="form-control col-md-7 col-xs-12" id="inputFoto" title="File Foto">
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <a href="?page=profil" class="btn btn-primary">Batal</a>
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