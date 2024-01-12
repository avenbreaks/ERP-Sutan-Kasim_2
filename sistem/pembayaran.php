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
                    <h2>Pembayaran</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="data-tabel" class="table jambo_table table-striped table-bordered bulk_action">
                      <thead>
                        <tr>
                          <th>&nbsp;</th>
                          <th>Order</th>
                          <th>Pembayaran</th>
                          <th>Pengiriman</th>
                          <th>&nbsp;</th>
                        </tr>
                      </thead>
                      <tbody>
						<?php
						$sql 	= "SELECT * FROM orders JOIN
									 member ON orders.id_member = member.id_member JOIN
									 bukti_transfer ON orders.id_order = bukti_transfer.id_order
									 WHERE status = '3' AND orders.validasi != 'yes' ORDER BY orders.tgl_order DESC";
						$qry	= mysql_query($sql);
						
						while ($data	= mysql_fetch_array($qry)){
							$sql_order = "SELECT count(id_produk) AS Jitem FROM orders_items WHERE id_order = '".$data['id_order']."'";
							$qry_order = mysql_query($sql_order);
							$data2	= mysql_fetch_array($qry_order);
								
						$id		= $data['id_order'];
						$nama	= $data['nama_toko'];
						$date	= waktu_indo($data['tgl_order']);
						$Item	= $data2['Jitem'];
						$email	= $data['email'];
						$total  = $data['total'] - ($data['total'] * ($data['diskon'] / 100));
						$total	= format_rupiah($total);
						$status	= $data['status'];
						$bukti	= $data['file'];
						if($data['file'] == ""){
							$bukti = "../images/konfirmasi/no_foto.jpg";
						}else{
							$bukti = "../images/konfirmasi/".$data['file'];
						}
							
						if ($status == '1'){
							$status = "Order";
							$label2  = "label label-warning";
						}else
						if ($status == '2'){
							$status = "Pending";
							$label2  = "label label-warning";
						}else
						if ($status == '3'){
							$status = "Lunas";
							$label2  = "label label-success";
						}
						$validasi	= $data['validasi'];
						if ($validasi == '3'){
							$validasi = "Dikirim";
						}else{
							$validasi = "Belum";
						}
                        ?>

                      
                        <tr>
                          <td><a target="_blank" title="Lihat Bukti Pembayaran" href="<?php echo $bukti?>"><img class="img-preview" width="100" src="<?php echo $bukti?>"/></a>
                          </td>
                          <td>
                          <span class="<?php echo $label2?>"><?php echo $status?></span><br><br>
                          <ul>
                          	<li><a href="?page=detail-transaksi&order=<?php echo $id?>" title="Detail"><i class="fa fa-eye"></i> <?php echo $id?></a></li>
                          	<li><?php echo $nama?></li>
                          	<li>Rp.<?php echo $total?> [<?php echo $Item?> Item ]</li><br>
                          </ul>
                          <?php echo $date?>
                          </td>
                          <td>
                          	  <li><?php echo strtoupper($data['nama_bank'])?></li>
                          	  <li>Rp. <?php echo format_rupiah($data['jumlah'])?></li>
                          	  <li><?php echo waktu_indo($data['tgl'])?></li>
                          </td>
                          <td><?php echo $validasi?></td>
                          <td>
                          <a href="?page=detail-transaksi&order=<?php echo $id?>" class="btn btn-danger btn-xs pull-right" title="Detail"><i class="fa fa-eye"></i> Detail</a><br>
                          <a href="?page=surat-jalan&order=<?php echo $id?>" title="Edit" class="btn btn-success btn-xs pull-right"><i class="fa fa-print"></i> Surat Jalan</a><br>
                          <a href="?page=tools&stat=setkirim&order=<?php echo $id?>" title="Edit" class="btn btn-info btn-xs pull-right"><i class="fa fa-truck"></i> Kirim Barang</a>
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