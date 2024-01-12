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
    <!-- Datatables -->
    <link href="../vendors/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
      <?php 
		include_once "sidebar.php";
		include_once "topbar.php";
		
	  ?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="clearfix"></div>

            <div class="row">
              
              <div class="col-md-12 col-sm-12 col-xs-12"><!-- col -->
                <div class="x_panel"><!-- x_panel -->
                  <div class="x_title"><!-- x_title -->
                    <h2>Kendaraan</h2>
                    <div class="clearfix"></div>
                  </div><!--end x_title -->
                  <div class="x_content"><!-- x_content -->
                    <div class="col-md-5 col-sm-5 col-xs-12">
                      <div class="profile_title">
                        <div class="col-md-6">
                          <h2>Tambah Kendaraan</h2>
                        </div>
                      </div>
                      <br>
                      <?php
                      if(isset($_POST["btnsimpan"])){
						$id 	 = NewKode("kendaraan","CAR"); 
						$nama	 = htmlspecialchars(strtoupper($_POST['inputKendaraan']));
						$kategori= $_POST['inputKategori'];
						
						$cek	 = mysql_num_rows(mysql_query("SELECT nama_kendaraan FROM kendaraan WHERE nama_kendaraan='$nama'"));
						if ($cek > 0){
							echo "<div class='alert alert-warning alert-dismissible' role='alert'>
								<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
								<strong>Kendaraan Sudah Ada</strong>.
								</div>";
						}else{
							$addsql = "INSERT INTO kendaraan SET 
								id_kendaraan 	= '".$id."',
								nama_kendaraan 	= '".strip_tags(addslashes($nama))."',
								id_kategori 		= '".$kategori."'";
							 
							$sukses = mysql_query($addsql, $server);
							
							if ($sukses){
								echo "<div class='alert alert-success alert-dismissible' role='alert'>
								<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
								<strong>Berhasil Menambah Kendaraan</strong>.
								</div>";
								//echo "<meta http-equiv=Refresh content=0;url=?page=kategori>";
							}
						  }	
						}
					  ?>
                        <form name="forminput" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">
                          <div class="form-group">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12" for="inputKendaraan">Merek Kendaraan
                            </label>
                            <div class="col-md-7 col-sm-7 col-xs-12">
                              <input name="inputKendaraan" type="text" autofocus required class="form-control col-md-7 col-xs-12" id="inputKendaraan" placeholder="Merek Kendaraan" title="Merek Kendaraan" size="100">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12" for="inputKategori">Kategori
                            </label>
                            <div class="col-md-7 col-sm-7 col-xs-12">
                              <select name="inputKategori" autofocus required class="form-control col-md-7 col-xs-12" id="inputKategori" title="Nama Kategori">
                                <option value=""> Pilih Kategori</option>
							    <?php 
                                  $sqlkat = mysql_query("SELECT * FROM kategori");
                                  while ($dkat = mysql_fetch_array($sqlkat)){ 
                                ?>
                                <option value="<?php echo $dkat['id_kategori']?>"> <?php echo $dkat['kategori']?></option>
                                <?php }?>
                              </select>
                            </div>
                          </div>
                          <div class="ln_solid"></div>
                          <div class="form-group">
                            <div class="col-md-8 col-sm-8 col-xs-12 col-md-offset-3">
                              <button class="btn btn-primary" type="reset">Reset</button>
                              <button type="submit" name="btnsimpan" class="btn btn-success">Simpan</button>
                            </div>
                          </div>
                        </form>
                      </div>
                    <div class="col-md-7 col-sm-7 col-xs-12">
                        <table id="data-tabel" class="table jambo_table table-striped table-bordered bulk_action">
                          <thead>
                            <tr>
                              <th width="10%">ID</th>
                              <th width="15%">Kategori</th>
                              <th>Merek</th>
                              <th width="30%">#</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $sql 	= "SELECT * FROM kendaraan JOIN kategori ON kendaraan.id_kategori = kategori.id_kategori ORDER BY kategori.kategori ASC";
                            $query 	= mysql_query($sql,$server);
                            
                            while ($data	= mysql_fetch_array($query)){
                            $id		= $data['id_kendaraan'];
                            $nama	= $data['nama_kendaraan'];
                            $kategori= $data['kategori'];
                            ?>
    
                          
                            <tr>
                              <td><?php echo $id?></td>
                              <td><?php echo $kategori?></td>
                              <td><?php echo $nama?></td>
                              <td>
                              <a href="?page=update-kendaraan&id=<?php echo $id?>" title="Edit" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i> Edit</a>
                              <a href="?page=hapus-kendaraan&id=<?php echo $id?>" title="Hapus" onClick="return confirm('Yakin ingin menghapus kendaraan &quot;<?php echo $nama?>&quot; ?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Hapus</a>
                              </td>
                            </tr>
                            <?php } ?>
                          </tbody>
                        </table>
                    </div>
                  </div><!--end x_content -->
                </div><!--end x_panel -->
              </div><!--end col -->
            </div><!-- row -->
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
    
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
    
    <!-- DATA TABES SCRIPT -->
    <script src="../vendors/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="../vendors/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <script type="text/javascript">
      $(function () {
        $('#data-tabel').dataTable({
          "bPaginate": true,
          "bLengthChange": true,
          "bFilter": true,
          "bSort": false,
          "bInfo": false,
          "bAutoWidth": true
        });
      });
    </script>

  </body>
</html>