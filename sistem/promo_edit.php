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
		
		$sql 	= "SELECT * FROM promo WHERE id_promo = '".$_GET['id']."'";
		$query	= mysql_query($sql);
		$data	= mysql_fetch_array($query);
		
		$judul	 = $data['judul_promo'];
		$des	 = $data['deskripsi'];
		$kode    = $data['kode_promo'];
		$diskon  = $data['besar_promo'];
		$minorder= format_rupiah($data['min_order']);
		$tglstart= save_tgl_indo($data['mulai_promo']);
		$tglend  = save_tgl_indo($data['akhir_promo']);
		
	  ?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            
            <div class="page-title">
              <div class="title_left">
                <h3>Event Promo</h3>
              </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Tambah Event Promo</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                   <?php
					if(isset($_POST["btnsimpan"])){
						$judul	 = htmlspecialchars(strtoupper($_POST['inputJudul']));
						$des	 = htmlspecialchars(strtoupper($_POST['inputDeskripsi']));
						$kode	 = $_POST['inputKode'];
						$diskon	 = $_POST['inputDiskon'];
						$minorder= str_replace(" ","",$_POST['inputMinorder']);
						$minorder= str_replace(".","",$minorder);
						$minorder= str_replace(",","",$minorder);
						$tglstart= save_tgl_english($_POST['inputMulai']);
						$tglend	 = save_tgl_english($_POST['inputAkhir']);
						
						if ($tglstart > $tglend){
							echo "<div class='alert alert-warning alert-dismissible' role='alert'>
								<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
								<strong>Tanggal mulai event promo lebih kecil dari tanggal berakhir </strong>.
								</div>";
						}else{
							$addsql = "UPDATE promo SET 
							judul_promo = '".strip_tags(addslashes($judul))."',
							deskripsi	= '".strip_tags(addslashes($des))."',
							kode_promo	= '".$kode."',
							besar_promo	= '".$diskon."', 
							min_order	= '".$minorder."',
							mulai_promo = '".$tglstart."',
							akhir_promo = '".$tglend."' WHERE
							id_promo	= '".$_GET['id']."'";
						 
						$sukses = mysql_query($addsql, $server);
						
						if ($sukses){
							echo "<div class='alert alert-success alert-dismissible' role='alert'>
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
							<strong>Berhasil Memperbaharui Data Event Promo</strong>.
							</div>";
							echo "<meta http-equiv=Refresh content=0;url=?page=promo>";
							
						}
					  }
					}	
				  ?>
				  <!-- start of Data Personal -->
				  <form name="forminput" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <p>&nbsp;</p>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputJudul">Judul Event
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input autofocus required name="inputJudul" type="text" class="form-control col-md-7 col-xs-12" id="inputJudul" placeholder="Judul Event" title="Judul Event" value="<?php echo $judul?>" size="100">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputDeskripsi">Deskripsi Event
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea autofocus required name="inputDeskripsi" class="form-control col-md-7 col-xs-12" id="inputDeskripsi" placeholder="Deskripsi Event" title="Deskripsi Event" rows="5"><?php echo $des?></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputKode">Kode Promo
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="inputKode" type="text" class="form-control col-md-7 col-xs-12" id="inputKode" placeholder="Kode Promo" title="Kode Promo" value="<?php echo $kode?>" size="8" readonly>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputDiskon">Diskon Promo [%]
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="inputDiskon" type="number" autofocus required class="form-control col-md-7 col-xs-12" id="inputDiskon" placeholder="Diskon Promo" max="100" min="0" title="Diskon Promo" value="<?php echo $diskon?>" size="8">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputMinorder">Minimal Belanja [Rp.]
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="inputMinorder" type="text" autofocus required class="form-control col-md-7 col-xs-12" id="inputMinorder" placeholder="Minimal Belanja" title="Minimal Belanja" value="<?php echo $minorder?>" size="20">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Mulai Promo</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="inputMulai" class="date-picker form-control col-md-7 col-xs-12" placeholder="dd-mm-yyyy" title="Mulai Promo" value="<?php echo $tglstart?>" data-inputmask="'mask': '99-99-9999'">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Berakhir Promo</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="inputAkhir" class="date-picker form-control col-md-7 col-xs-12" placeholder="dd-mm-yyyy" title="Akhir Promo" value="<?php echo $tglend?>" data-inputmask="'mask': '99-99-9999'">
                        </div>
                      </div>
                      
                      
                      <div class="ln_solid"></div>
                      
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <a href="?page=promo" class="btn btn-primary">Batal</a>
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