<style>
.body{
	background:#FFFFFF;
}
</style>
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
			  <?php
                $cariorder = isset($_GET['order']) ? $_GET['order'] : '';
                $sql2	= "SELECT * FROM orders JOIN member ON 
                                    orders.id_member = member.id_member
                                    WHERE orders.id_order='".$cariorder."'";
                $query2	= mysql_query($sql2);
                $d2 	= mysql_fetch_array($query2);
                $idmember 	= $d2['id_order'];
                $namamember	= $d2['nama_toko'];
                    
              ?>
               <table border="0" width="100%">
                  <thead>
                    <tr>
                      <th width="52%" rowspan="3" class="text-center">
                      <img width="200" src="../app/themes/images/logo.png"><br>
                      Jl. Veteran No.14A, Purus, Padang Barat,<br>
                      Kota Padang, Sumatera Barat 25115<br>
                      (0751) 32906
                      </th>
                      <th colspan="2" valign="top">
                          <h2 class="text-center">SURAT JALAN</h2>
                      </th>
                    </tr>
                    <tr>
                      <th width="11%">Yth. </th>
                      <th width="37%">: <?php echo $namamember?></th>
                    </tr>
                    <tr>
                      <th width="11%">Alamat</th>
                      <th width="37%">: <?php echo $d2['alamat']?>, <?php echo $d2['kota']?>, <?php echo $d2['pos']?></th>
                    </tr>
                  </thead>
                </table><br>
                <table width="50%" border="0" cellpadding="3" cellspacing="3">
                  <thead>
                    <tr>
                      <th width="37%">Tanggal</th>
                      <th width="63%">: <?php echo tgl_indo(date("Y-m-d"))?></th>
                    </tr>
                    <tr>
                      <th width="37%">ID Order</th>
                      <th width="63%">: <?php echo $d2['id_order']?></th>
                    </tr>
                  </thead>
                </table>
                <br>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Nama Produk</th>
                      <th>Jumlah</th>
                      <th>Harga (Rp.)</th>
                      <th>Total (Rp.)</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sql	= "SELECT * FROM orders JOIN orders_items ON 
                                        orders.id_order = orders_items.id_order JOIN produk ON
                                        produk.id_produk = orders_items.id_produk 
                                        WHERE orders.id_order='".$cariorder."'";
                    $query	= mysql_query($sql);
                    $no=1;
                    while($d = mysql_fetch_array($query)){
                        $id = $d['id_order'];
                        $nama = $d['nama_produk'];
                        $produk_id = $d['id_produk'];
                        $j_order   =$d['jumlah_order'];
                        
                        $harga 	= format_rupiah($d['harga']);
                        $jumlah = $d['jumlah_order'];
                        $total  = format_rupiah($d['jumlah_order'] * $d['harga']);
                    ?>
                  
                    <tr>
                      <td><?php echo $no?></td>
                      <td><?php echo $nama?></td>
                      <td><?php echo $j_order?></td>
                      <td><?php echo $harga?></td>
                      <td><?php echo $total?></td>
                    </tr>
                    <?php $no++;}
                        $sqlcekorder 	= "SELECT * FROM orders JOIN orders_items ON orders.id_order = orders_items.id_order WHERE orders.id_order='".$cariorder."'";
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
                      <td colspan="4" style="text-align:right"><strong>TOTAL BAYAR</strong></td>
                      <td> <strong>Rp. <?php echo $tbayar?></strong></td>
                    </tr>
                  </tbody>
                </table>
                <table width="100%" height="135" border="0">
                  <thead>
                    <tr>
                      <th width="50%" height="29" class="text-center">Tanda Terima Dari</th>
                      <th width="50%" class="text-center">Pet. Gudang</th>
                      <th width="50%" class="text-center">Hormat Kami</th>
                    </tr>
                    <tr>
                      <th height="100" valign="bottom" class="text-center">...............................</th>
                      <th valign="bottom" class="text-center">...............................</th>
                      <th valign="bottom" class="text-center">...............................</th>
                    </tr>
                  </thead>
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