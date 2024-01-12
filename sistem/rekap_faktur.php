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
                    <h2>Rekap Faktur</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  
                      <a href="?page=cetak-rekap-faktur" target="_blank" title="Cetak Rekap Faktur" class="btn btn-success pull-left"><i class="fa fa-print"></i> Cetak</a>
					  
                    <table id="data-tabel" class="table jambo_table table-striped table-bordered bulk_action">
                      <thead>
                        <tr>
                          <th>REF ID</th>
                          <th>Order</th>
                          <th>Harga</th> 
                          <th width="5%">Jumlah</th>
                          <th>Total</th>
                        </tr>
                      </thead>
                      <tbody>
						<?php
						$sql 	= "SELECT * FROM orders JOIN
									 member ON orders.id_member = member.id_member
									 WHERE orders.validasi = 'yes' ORDER BY orders.tgl_order DESC";
						$qry	= mysql_query($sql);
						$sql_history = "SELECT * FROM orders JOIN
									 member ON orders.id_member = member.id_member
									 WHERE orders.validasi = 'yes' ORDER BY orders.tgl_order DESC";
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
                          <td width="10%"><strong><?php echo $id?></strong></td>
                          <td colspan="4"><?php echo $date?><strong> - <?php echo $nama?></strong></td>
                        </tr>
                        <tr>
                          <th>&nbsp;</th>
                          <th colspan="4">Daftar Pesanan</th>
                        </tr>
                        <?php
                        $sql6	= "SELECT * FROM orders JOIN orders_items ON 
                                            orders.id_order = orders_items.id_order JOIN produk ON
                                            produk.id_produk = orders_items.id_produk 
                                            WHERE orders.id_order='".$id."'";
                        $query6	= mysql_query($sql6);
                        while($d6 = mysql_fetch_array($query6)){
                            $id6 = $d6['id_order'];
                            $nama6 = $d6['nama_produk'];
                            $produk_id6 = $d6['id_produk'];
                            $j_order6   =$d6['jumlah_order'];
                            
                            $harga6 	= format_rupiah($d6['harga']);
                            $jumlah6 = $d6['jumlah_order'];
                            $total6  = format_rupiah($d6['jumlah_order'] * $d6['harga']);
                        ?>
                      
                        <tr>
                          <td>&nbsp;</td>
                          <td><?php echo $nama6?></td>
                          <td>Rp. <?php echo $harga6?></td>
                          <td><?php echo $j_order6?></td>
                          <td class="text-right">Rp. <?php echo $total6?></td>
                        </tr>
                        <?php
                        	}
						 } 
						 $sql_history2 = "SELECT SUM(total -((diskon/100)*total)) AS G_TOTAL FROM orders 
									 WHERE validasi = 'yes'ORDER BY orders.tgl_order DESC";
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