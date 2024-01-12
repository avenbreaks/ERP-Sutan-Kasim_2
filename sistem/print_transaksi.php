	<link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="../build/css/custom.min.css" rel="stylesheet">
  </head>

  <body onload="window.print();">
  <?php 
    include_once "../lib/koneksi.php";
  ?>
    <div class="wrapper">
      <!-- Main content -->
      <section class="invoice">
        <!-- title row -->
        <div class="row">
          <div class="col-xs-12">
			  <table border="0" width="100%">
                  <thead>
                    <tr>
                      <th width="52%" class="text-left">
                      <img width="200" src="../app/themes/images/logo.png"><br>
                      Jl. Veteran No.14A, Purus, Padang Barat, Kota Padang, Sumatera Barat 25115<br>
                      (0751) 32906
                      </th>
                    </tr>
                  </thead>
                </table>
                <hr>
                <span class="pull-left">Laporan Transaksi : <?php echo tgl_indo($_GET['startdate'])?> - <?php echo tgl_indo($_GET['enddate'])?></span>
                <span class="pull-right"><?php echo tgl_indo(date("Y-m-d"))?></span><br><br>
                <table id="data-tabel" class="table jambo_table table-striped table-bordered bulk_action">
                      <thead>
                        <tr>
                          <th>REF</th>
                          <th>Order By</th>
                          <th>Date</th> 
                          <th>Item</th>
                          <th>Total</th>
                        </tr>
                      </thead>
                  <tbody>
						<?php
						$date_mulai = $_GET['startdate'];
			    		$date_akhir = $_GET['enddate'];    
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
                          <td><?php echo $id?></td>
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
        </section>
      </div>

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
  </body>
</html>