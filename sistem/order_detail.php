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
		include_once "topbar_alert_view.php";
	  ?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>List Order</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>Produk</th>
                          <th>Nama Produk</th>
                          <th>Jumlah Order</th>
                          <th>Harga (Rp.)</th>
                          <th>Total (Rp.)</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $sql	= "SELECT * FROM orders JOIN orders_items ON 
                                            orders.id_order = orders_items.id_order JOIN produk ON
                                            produk.id_produk = orders_items.id_produk 
                                            WHERE orders.id_order='".$_GET['order']."'";
                        $query	= mysql_query($sql);
                        while($d = mysql_fetch_array($query)){
                            $id = $d['id_order'];
                            $nama = $d['nama_produk'];
                            $produk_id = $d['id_produk'];
                            $j_order   =$d['jumlah_order'];
                            if($d['foto_produk'] == ""){
                                $image = "../images/produk/no_foto.jpg";
                            }else{
                                $image = "../images/produk/".$d['foto_produk'];
                            }
                            $harga 	= format_rupiah($d['harga']);
                            $jumlah = $d['jumlah_order'];
                            $total  = format_rupiah($d['jumlah_order'] * $d['harga']);
                        ?>
                      
                        <tr>
                          <td> <img width="60" src="<?php echo $image?>" alt="<?php echo $nama?>"/></td>
                          <td><?php echo $nama?></td>
                          <td><?php echo $j_order?></td>
                          <td><?php echo $harga?></td>
                          <td><?php echo $total?></td>
                        </tr>
                        <?php }
                            $sqlcekorder 	= "SELECT * FROM orders JOIN orders_items ON orders.id_order = orders_items.id_order WHERE orders.id_order='".$_GET['order']."'";
                            $querycekorder	= mysql_query($sqlcekorder);
                            $totaldidatabase = mysql_fetch_array($querycekorder);
                            $gtot =  format_rupiah($totaldidatabase['total']);
                            $sqlvoucer 	= mysql_query("SELECT diskon FROM orders WHERE status='1'");
                            $jvou		= mysql_fetch_array($sqlvoucer);
                            $diskon		= $jvou['diskon'] / 100 ;
                            $potongan	= $totaldidatabase['total'] * $diskon;
                            $djvou 		= format_rupiah($potongan);
                            $tbayar 	= format_rupiah($totaldidatabase['total'] - $potongan);
                            $pembayaran = strtoupper($totaldidatabase['tipe_pembayaran']);
                            $status		= $totaldidatabase['status'];
                            if ($status == '1'){
                                $status = "Order";
                                $label1  = "label label-primary";
                                $label2  = "label label-warning";
                            }else
                            if ($status == '2'){
                                $status = "Pending";
                                $label1  = "label label-primary";
                                $label2  = "label label-warning";
                            }else
                            if ($status == '3'){
                                $status = "Lunas";
                                $label1  = "label label-primary";
                                $label2  = "label label-success";
                            }
                        ?>
                        <tr>
                          <td colspan="4" style="text-align:right">Total Belanja:</td>
                          <td>Rp. <?php echo $gtot?></td>
                        </tr>
                         <tr>
                          <td colspan="4" style="text-align:right">Diskon:	</td>
                          <td>Rp. <?php echo $djvou?></td>
                        </tr>
                         <tr>
                          <td colspan="4" style="text-align:right"><strong>TOTAL PEMBAYARAN</strong></td>
                          <td class="label label-danger" style="display:block"> <strong>Rp. <?php echo $tbayar?></strong></td>
                        </tr>
                         <tr>
                           <td colspan="4" style="text-align:right">Pembayaran</td>
                           <td class="<?php echo $label1?>" style="display:block"><?php echo $pembayaran?></td>
                         </tr>
                         <tr>
                           <td colspan="4" style="text-align:right">Status Pembayaran</td>
                           <td class="<?php echo $label2?>" style="display:block"><?php echo $status?></td>
                         </tr>
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