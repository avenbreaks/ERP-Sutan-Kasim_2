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
		$level 	= $_SESSION['dunlop_level'];
		if ($level == '5'){
			$read = "readonly";
			$read2 = "disabled";
		}else{
			$read = "";
			$read2 = "";
		}
		
		$sql 	= "SELECT * FROM produk WHERE id_produk = '".$_GET['id']."'";
		$query	= mysql_query($sql);
		$data	= mysql_fetch_array($query);
		
		$nama	= $data['nama_produk'];
		$des	= $data['deskripsi'];
		$pelek	= $data['ukuran_pelek'];
		$lebar  = $data['lebar_ban'];
		$speed  = $data['speed_rating'];
		$stok   = $data['stok'];
		$ket	=$data['id_kategori'];
		$harga	= format_rupiah($data['harga']);
		if ($speed=='Q'){$sel1 = "selected";}else{$sel1="";}
		if ($speed=='R'){$sel2 = "selected";}else{$sel2="";}
		if ($speed=='S'){$sel3 = "selected";}else{$sel3="";}
		if ($speed=='T'){$sel4 = "selected";}else{$sel4="";}
		if ($speed=='U'){$sel5 = "selected";}else{$sel5="";}
		if ($speed=='H'){$sel6 = "selected";}else{$sel6="";}
		if ($speed=='V'){$sel7 = "selected";}else{$sel7="";}
		
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
                    <h2>Edit Data Produk</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                   <?php
					if(isset($_POST["btnsimpan"])){
						
						$id 	 = NewKode("produk","PRD"); 
						$nama	 = htmlspecialchars(ucwords(strtolower($_POST['inputNama'])));
						$des	 = $_POST['inputDes'];
						$pelek	 = $_POST['inputPelek'];
						$lebar	 = $_POST['inputLebar'];
						$speed	 = $_POST['inputSpeed'];
						$stok	 = $_POST['inputStok'];
						$ket	 = $_POST['inputKategori'];
						$harga	 = htmlspecialchars($_POST['inputHarga']);
						$harga	 = str_replace(" ","",$harga);
						$harga	 = str_replace(".","",$harga);
						$harga	 = str_replace(",","",$harga);
						$namafoto= str_replace(" ","_",$nama);
						if ($speed=='Q'){$sel1 = "selected";}else{$sel1="";}
                        if ($speed=='R'){$sel2 = "selected";}else{$sel2="";}
						if ($speed=='S'){$sel3 = "selected";}else{$sel3="";}
						if ($speed=='T'){$sel4 = "selected";}else{$sel4="";}
						if ($speed=='U'){$sel5 = "selected";}else{$sel5="";}
						if ($speed=='H'){$sel6 = "selected";}else{$sel6="";}
						if ($speed=='V'){$sel7 = "selected";}else{$sel7="";}
						
						$cekuname= mysql_num_rows(mysql_query("SELECT nama_produk FROM produk WHERE nama_produk='$nama' AND id_produk != '".$_GET['id']."'"));
						if ($cekuname > 0){
							echo "<div class='alert alert-warning alert-dismissible' role='alert'>
								<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
								<strong>Produk sudah ada</strong>.
								</div>";
						}else{
							if (!empty($_FILES['inputFoto']['tmp_name'])) {
								$nama_file 		= $_FILES['inputFoto']['name'];
								$ekstensi_file 	= substr(strtolower(strrchr($nama_file, ".")), 1);
								$nama_file 		= $namafoto.".".$ekstensi_file;
								
								copy($_FILES['inputFoto']['tmp_name'],"../images/produk/".$nama_file);
							}
							else {
								$nama_file = "";
							}
							$addsql = "UPDATE produk SET 
								nama_produk = '".strip_tags(addslashes($nama))."',
								ukuran_pelek= '".strip_tags(addslashes($pelek))."',
								lebar_ban	= '".strip_tags(addslashes($lebar))."',
								speed_rating= '".$speed."',
								stok		= '".$stok."',
								harga		= '".$harga."',
								id_kategori = '".$ket."',
								foto_produk	= '".$nama_file."' WHERE id_produk   = '".$id."'";
							 
							$sukses = mysql_query($addsql, $server);
							
							if ($sukses){
								echo "<div class='alert alert-success alert-dismissible' role='alert'>
								<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
								<strong>Berhasil Memperbaharui Data Produk</strong>.
								</div>";
								echo "<meta http-equiv=Refresh content=0;url=?page=produk>";
								
							}
						  }	
						}
						?>
				  <!-- start of Data Personal -->
				  <form name="forminput" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <p>&nbsp;</p>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputNama">Nama Produk
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="inputNama" type="text" <?php echo $read?> class="form-control col-md-7 col-xs-12" id="inputNama" placeholder="Nama" title="Nama" value="<?php echo $nama?>" size="150">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputKategori">Kategori
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select  class="form-control col-md-7 col-xs-12" <?php echo $read2?> name="inputKategori" required id="inputKategori" title="Kategori">
                            <option value="">Pilih Kategori</option>
                            <?php
							$sqlktg = "SELECT * FROM kategori ORDER BY kategori ASC";
							$qryktg = mysql_query($sqlktg);
                            while ($ktg = mysql_fetch_array($qryktg)){
								if ($ktg['id_kategori'] = $ket)
								{$selkat = "selected";}else{$selkat="";}
								
							?>
                            <option value="<?php echo $ktg['id_kategori']?>" <?php echo $selkat?>><?php echo $ktg['kategori']?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputDes">Deskripsi
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="inputDes" type="text" <?php echo $read?> class="form-control col-md-7 col-xs-12" id="inputDes" placeholder="Deskripsi" title="Deskripsi" value="<?php echo $des?>" size="150">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputPelek">Ukuran Pelek (Inchi)
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="inputPelek" type="text" <?php echo $read?> class="form-control col-md-7 col-xs-12" id="inputPelek" placeholder="Ukuran Pelek" title="Ukuran Pelek" value="<?php echo $pelek?>" size="5">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputLebar">Lebar Ban (Inchi)
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="inputLebar" type="text" <?php echo $read?> class="form-control col-md-7 col-xs-12" id="inputLebar" placeholder="Lebar Ban" title="Lebar Ban" value="<?php echo $lebar?>" size="5">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputSpeed">Speed rating
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select name="inputSpeed" required <?php echo $read2?>  class="form-control col-md-7 col-xs-12" id="inputSpeed" title="Speed rating">
                            <option value="">Pilih Speed Rating</option>
                            <option value="Q" <?php echo $sel1?>>Q (max. speed 99 MPH)</option>
                            <option value="R" <?php echo $sel2?>>R (max. speed 106 MPH)</option>
                            <option value="S" <?php echo $sel3?>>S (max. speed 112 MPH)</option>
                            <option value="T" <?php echo $sel4?>>T (max. speed 118 MPH)</option>
                            <option value="U" <?php echo $sel5?>>U (max. speed 124 MPH)</option>
                            <option value="H" <?php echo $sel6?>>H (max. speed 130 MPH)</option>
                            <option value="V" <?php echo $sel7?>>V (max. speed 149 MPH)</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputStok">Stok
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="inputStok" type="text" class="form-control col-md-7 col-xs-12" id="inputStok" placeholder="Stok" title="Stok" value="<?php echo $stok?>" size="10">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputHarga">Harga (Rp.)
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="inputHarga" type="text" <?php echo $read?> class="form-control col-md-7 col-xs-12" id="inputHarga" placeholder="Harga" title="Harga" value="<?php echo $harga?>" size="12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputFoto">File Foto</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="inputFoto" type="file" <?php echo $read2?> class="form-control col-md-7 col-xs-12" id="inputFoto" title="File Foto">
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <a href="?page=produk" class="btn btn-primary">Batal</a>
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