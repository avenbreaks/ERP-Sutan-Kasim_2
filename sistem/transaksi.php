    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
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
                    <h2>Laporan Trasaksi</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <?php
				  	  $now = strtotime(date('Y-m-d'));
					  $date_mulai = date("Y-m-d", strtotime('-6 day', $now));
					  $date_akhir = date("Y-m-d");
					  $date_mulai2= str_replace("-","/",tgl_to_format_mdy($date_mulai));
					  $date_akhir2= str_replace("-","/",tgl_to_format_mdy($date_akhir));
					  if(isset($_POST["btnCari"])){
						 
						  $date_set  = $_POST['reservation'];
						  $tgl_mulai = substr($date_set,3,2);
						  $bln_mulai = substr($date_set,0,2);
						  $th_mulai  = substr($date_set,6,4);
						  
						  $tgl_akhir = substr($date_set,16,2);
						  $bln_akhir = substr($date_set,13,2);
						  $th_akhir  = substr($date_set,19,4);
						  
						  $date_mulai = $th_mulai."-".$bln_mulai."-".$tgl_mulai;
						  $date_akhir = $th_akhir."-".$bln_akhir."-".$tgl_akhir;
						  $date_mulai2= str_replace("-","/",tgl_to_format_mdy($date_mulai));
					  	  $date_akhir2= str_replace("-","/",tgl_to_format_mdy($date_akhir));
						  
						  echo "<div class='alert alert-info alert-dismissible fade in' role='alert'>
								<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span>
								</button>
								Pesanan Tanggal <b>'".tgl_indo($date_mulai)."'</b> Sampai Tanggal <b>'".tgl_indo($date_akhir)."'</b>'
							  </div>";
						 
					  }
							$sql2	= "SELECT * FROM orders JOIN member ON 
												orders.id_member = member.id_member
												WHERE tgl_order BETWEEN '$date_mulai' AND '$date_akhir'";
												
							$query2	= mysql_query($sql2);
							$d2 	= mysql_fetch_array($query2);
							$idmember 	= $d2['id_order'];
							$namamember	= $d2['nama_toko'];
							
					  ?>
                      <a href="?page=cetak-transaksi&startdate=<?php echo $date_mulai?>&enddate=<?php echo $date_akhir?>" target="_blank" title="Cetak Laporan Transaksi" class="btn btn-success pull-left"><i class="fa fa-print"></i> Cetak</a>
					  <form name="forminput" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">
						<fieldset>
                            <div class="control-group">
                              <div class="controls">
                                <div class="input-prepend input-group">
                                  <input type="text" style="width: 300px" name="reservation" id="reservation" class="form-control pull-right" value="<?php echo $date_mulai2?> - <?php echo $date_akhir2?>" />
                                  
                                  <span class="input-group-btn">
                                    <button type="submit" name="btnCari" class="btn btn-info"><i class="fa fa-search"></i></button>
                                  </span>
                                </div>
                              </div>
                            </div>
                          </fieldset>
                      </form>
                      
                    <table id="data-tabel" class="table jambo_table table-striped table-bordered bulk_action">
                      <thead>
                        <tr>
                          <th>REF ID</th>
                          <th>Order By</th>
                          <th>Date</th> 
                          <th>Item</th>
                          <th>Total</th>
                        </tr>
                      </thead>
                      <tbody>
						<?php
						$sql 	= "SELECT * FROM orders JOIN
									 member ON orders.id_member = member.id_member
									 WHERE orders.validasi = 'yes' AND tgl_order BETWEEN '$date_mulai' AND '$date_akhir' ORDER BY orders.tgl_order DESC";
						$qry	= mysql_query($sql);
						$sql_history = "SELECT * FROM orders JOIN
									 member ON orders.id_member = member.id_member
									 WHERE orders.validasi = 'yes' AND tgl_order BETWEEN '$date_mulai' AND '$date_akhir' ORDER BY orders.tgl_order DESC";
						$qry_history = mysql_query($sql_history);
						while ($data	= mysql_fetch_array($qry_history)){
							$sql_order = "SELECT count(id_produk) AS Jitem FROM orders_items WHERE id_order = '".$data['id_order']."'";
							$qry_order = mysql_query($sql_order);
							$data2	= mysql_fetch_array($qry_order);
							
						$id		= $data['id_order'];
						$nama	= $data['nama_toko'];
						$date	= waktu_indo_angka($data['tgl_order']);
						$Item	= $data2['Jitem'];
						$email	= $data['email'];
						$total  = $data['total'] - ($data['total'] * ($data['diskon'] / 100));
						$total	= format_rupiah($total);
						$status	= $data['status'];
						?>
                        <tr>
                          <td><a href="?page=detail-transaksi&order=<?php echo $id?>" title="Detail"><i class="fa fa-eye"></i> <?php echo $id?></a></td>
                          <td><?php echo $nama?></td>
                          <td><?php echo $date?></td>
                          <td><?php echo $Item?></td>
                          <td class="text-right">Rp. <?php echo $total?></td>
                        </tr>
                        <?php
						 } 
						 $sql_history2 = "SELECT SUM(total -((diskon/100)*total)) AS G_TOTAL FROM orders 
									 WHERE validasi = 'yes' AND tgl_order BETWEEN '$date_mulai' AND '$date_akhir' ORDER BY orders.tgl_order DESC";
						$qry_history2 = mysql_query($sql_history2);
						$data2	= mysql_fetch_array($qry_history2);
						 ?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <td class="text-right"><b>TOTAL</b></td>
                          <td colspan="4" class="text-right">Rp. <?php echo format_rupiah($data2['G_TOTAL'])?></td>
                        </tr>
                      </tfoot>
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
    <!-- bootstrap-daterangepicker -->
    <script src="../vendors/moment/min/moment.min.js"></script>
    <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    
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