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
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Promo</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <a href="?page=tambah-promo" title="Tambah Event Promo" class="btn btn-success btn-xs"><i class="fa fa-plus-circle"></i> Tambah Event Promo</a>
                    </p>
                    <table id="data-tabel" class="table jambo_table table-striped table-bordered bulk_action">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Judul</th>
                          <th>Deskripsi</th>
                          <th>Kode</th>
                          <th>Diskon</th>
                          <th>Min. Order</th>
                          <th>Start Promo</th>
                          <th>End Promo</th>
                          <th>#</th>
                        </tr>
                      </thead>
                      <tbody>
						<?php
						$sql 	= "SELECT * FROM promo ORDER BY akhir_promo ASC";
						$query 	= mysql_query($sql,$server);
						
						while ($data	= mysql_fetch_array($query)){
						$id		= $data['id_promo'];
						$judul	= htmlspecialchars($data['judul_promo']);
						$des	= htmlspecialchars($data['deskripsi']);
						$kode	= $data['kode_promo'];
						$diskon	= $data['besar_promo'];
						$minorder= $data['min_order'];
						$mulai	= save_tgl_indo($data['mulai_promo']);
						$akhir	= save_tgl_indo($data['akhir_promo']);
                        ?>
                        <tr>
                          <td><?php echo $id?></td>
                          <td><?php echo $judul?></td>
                          <td><?php echo $des?></td>
                          <td><?php echo $kode?></td>
                          <td><?php echo $diskon?></td>
                          <td><?php echo $minorder?></td>
                          <td><?php echo $mulai?></td>
                          <td><?php echo $akhir?></td>
                          <td>
                          <a href="?page=edit-promo&id=<?php echo $id?>" title="Edit" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i> Edit</a>
                          <a href="?page=hapus-promo&id=<?php echo $id?>" title="Hapus" onClick="return confirm('Yakin ingin menghapus karyawan &quot;<?php echo $nama?>&quot; ?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Hapus</a>
                          </td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
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