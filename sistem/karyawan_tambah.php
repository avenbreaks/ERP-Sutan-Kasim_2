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
		
		$nama	= "";
		$jk		= "";
		$tplahir= "";
		$tglahir= "";
		$alamat	= "";
		$notelp	= "";
		$email	= "";
		$notelp	= "";
		$sel3	= "";
		$sel4	= "";
		$sel5	= "";
		$selp 	= "";
		$selw 	= "";
	
		
	  ?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            
            <div class="page-title">
              <div class="title_left">
                <h3>Karyawan</h3>
              </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Tambah Karyawan Baru</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                   <?php
					if(isset($_POST["btnsimpan"])){
						$id 	 = NewKode("karyawan","KRY"); 
						$nama	 = htmlspecialchars(strtoupper($_POST['inputNama']));
						$jk		 = htmlspecialchars($_POST['inputJk']);
						$tplahir = htmlspecialchars(strtoupper($_POST['inputTempat']));
						$tglahir = save_tgl_english($_POST['inputTanggal']);
						$alamat	 = htmlspecialchars($_POST['inputAlamat']);
						$notelp	 = htmlspecialchars($_POST['inputHp']);
						$email	 = htmlspecialchars( $_POST['inputEmail']);
						$username= htmlspecialchars($_POST['inputUsername']);
						$pass	 = $_POST['inputPass'];
						$pass2	 = $_POST['inputPass2'];
						$level	 = $_POST['inputLevel'];
						if ($jk == "pria"){$selp="checked";}else{$selp="";}
						if ($jk == "wanita"){$selw="checked";}else{$selw="";}
						
						if ($level==3){$sel3 = "selected";}else{$sel3="";}
                        if ($level==4){$sel4 = "selected";}else{$sel4="";}
						if ($level==5){$sel5 = "selected";}else{$sel5="";}
						
						$cekuname= mysql_num_rows(mysql_query("SELECT username FROM login WHERE username='$username'"));
						if ($cekuname > 0){
							echo "<div class='alert alert-warning alert-dismissible' role='alert'>
								<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
								<strong>Username sudah digunakan</strong>.
								</div>";
						}else{
							if (trim($pass) != trim($pass2)) {
							echo "<div class='alert alert-warning alert-dismissible' role='alert'>
								<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
								<i class='fa fa-info-circle'></i> Password Tidak Sama!.
								</div>";
							
							}else{
								if (!empty($_FILES['inputFoto']['tmp_name'])) {
									$nama_file 		= $_FILES['inputFoto']['name'];
									$ekstensi_file 	= substr(strtolower(strrchr($nama_file, ".")), 1);
									$nama_file 		= $id.".".$ekstensi_file;
									
									copy($_FILES['inputFoto']['tmp_name'],"../images/avatar/".$nama_file);
								}
								else {
									$nama_file = "";
								}
								$addsql = "INSERT INTO karyawan SET 
									id_karyawan = '".$id."',
									nama 		= '".strip_tags(addslashes($nama))."',
									jk			= '".$jk."',
									tmp_lahir	= '".strip_tags(addslashes($tplahir))."',
									tgl_lahir	= '".$tglahir."', 
									alamat		= '".strip_tags(addslashes($alamat))."',
									no_telp		= '".$notelp."',
									email		= '".strip_tags(addslashes($email))."',
									foto		= '$nama_file',
									tgl_daftar	= NOW()";
								 
								$sukses = mysql_query($addsql, $server);
								
								$addsql2 = "INSERT INTO login SET 
									id_user 	= '".$id."',
									username 	= '".strip_tags(addslashes($username))."',
									password	= '".md5($pass)."',
									level		= '".$level."',
									blokir		= '0'";
								 
								$sukses2 = mysql_query($addsql2, $server);
								
								if ($sukses && $sukses2){
									echo "<div class='alert alert-success alert-dismissible' role='alert'>
									<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
									<strong>Berhasil Menambah Karyawan</strong>.
									</div>";
									echo "<meta http-equiv=Refresh content=0;url=?page=karyawan>";
									
								}
							
							}
						
						}	
						}
						?>
				  <!-- start of Data Personal -->
				  <form name="forminput" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">
                    <div class="col-md-5 col-sm-5 col-xs-12">
                      <div class="profile_title">
                        <div class="col-md-6">
                          <h2>Data Login</h2>
                        </div>
                      </div>
                      <p>&nbsp;</p>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputUsername">Username <?php echo $tglahir?>
                        </label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <input name="inputUsername" type="text" autofocus required class="form-control col-md-7 col-xs-12" id="inputUsername" placeholder="Username" title="Username" size="32">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputPass">Password
                        </label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <input name="inputPass" type="password" autofocus required class="form-control col-md-7 col-xs-12" id="inputPass" placeholder="Password" title="Password" size="32">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputPass2">Ulangi Password
                        </label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <input name="inputPass2" type="password" autofocus required class="form-control col-md-7 col-xs-12" id="inputPass2" placeholder="Ulangi Password" title="Ulangi Password" size="32">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id">Posisi
                        </label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <select name="inputLevel" autofocus required class="form-control col-md-7 col-xs-12" id="inputLevel" title="Posisi">
                          	<option value="0"> Pilih Posisi [Jabatan]</option>
                            <option value="3" <?php echo $sel3?>> Karyawan [Sales]</option>
                            <option value="4" <?php echo $sel4?>> Karyawan [Managemen]</option>
                            <option value="5" <?php echo $sel5?>> Karyawan [Gudang]</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    
                    <div class="col-md-7 col-sm-7 col-xs-12">
                      <div class="profile_title">
                        <div class="col-md-6">
                          <h2>Data Personal</h2>
                        </div>
                      </div>
                      <p>&nbsp;</p>
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">No. Hp</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="inputHp" class="date-picker form-control col-md-7 col-xs-12" placeholder="No. Hp" title="No. Hp" value="<?php echo $notelp?>" data-inputmask="'mask': '9999-9999-9999'">
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
                          <a href="?page=karyawan" class="btn btn-primary">Batal</a>
						  <button class="btn btn-primary" type="reset">Reset</button>
                          <button type="submit" name="btnsimpan" class="btn btn-success">Simpan</button>
                        </div>
                      </div>

                    
                      <!-- end of Data Personal -->
                      
                      </div>
                      </form>
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