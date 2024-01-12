<style>
.loader {
    position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: url("assets/ico/load.gif") 50% 50% no-repeat rgb(249,249,249);
    opacity: .8;
}
</style>
<script src="assets/js/jquery2.2.4jquery.min.js"></script>
<script type="text/javascript">
$(window).load(function() {
    $(".loader").fadeOut("slow");
});
</script>
<div class="loader"></div>
<?php
	$sqlcekorder 	= "SELECT * FROM orders_items JOIN orders ON orders.id_order = orders_items.id_order WHERE orders.id_member='".$_SESSION['dunlop_id']."' AND orders.status='1'";
	$querycekorder	= mysql_query($sqlcekorder);
	$cekorder		= mysql_num_rows($querycekorder);
	$j 				= $cekorder;
	
	$id_order = $_GET['id'];
	$id_produk = $_GET['produk'];
	
	$sql	= "SELECT * FROM orders JOIN orders_items ON 
						orders.id_order = orders_items.id_order JOIN produk ON
						produk.id_produk = orders_items.id_produk WHERE orders.id_member= '".$_SESSION['dunlop_id']."' AND orders.status='1' AND orders_items.id_produk='$id_produk' ";
					$query	= mysql_query($sql);
					//mysql_fetch_array($query);
					//echo mysql_num_rows($query);
					//exit;
						$d = mysql_fetch_array($query);
						$produkid = $d['id_produk'];
						$idorder= $d['id_order'];
						$harga 	= $d['harga'];
						$jumlah = $d['jumlah_order'];
						$totaldb= $d['total'];
						$total  = $jumlah * $harga;
						$GTOT	= $totaldb - $total;
					
	if($id_order!= "" or $id_produk!=""){
		if($j < 2){
			$del2 = mysql_query("DELETE FROM orders_items WHERE 
										id_produk= '".$_GET['produk']."' &&
										id_order = '".$_GET['id']."' ");
			$del = mysql_query("DELETE FROM orders WHERE id_order = '".$_GET['id']."' && id_member='".$_SESSION['dunlop_id']."'");
			
			
		}else if($j > 1){
			$del2 = mysql_query("DELETE FROM orders_items WHERE id_order = '".$_GET['id']."' && id_produk='$id_produk' && id_produk='$produkid'");
			$sql7 = mysql_query("UPDATE orders SET total='".$GTOT."' WHERE id_order = '".$_GET['id']."' && status ='1' && id_member='".$_SESSION['dunlop_id']."'");
			
		}
	}
	echo "<meta http-equiv=Refresh content=0;url=?page=keranjang-belanja>";
?>