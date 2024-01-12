<?php
$level 		= $_SESSION['dunlop_level'];
if ($level == '1'){

}else{
if($_GET['page']=='detail-transaksi'){
$sql_to_alert = "SELECT * FROM orders JOIN orders_items ON 
					orders.id_order = orders_items.id_order JOIN produk ON
					produk.id_produk = orders_items.id_produk 
					WHERE orders.id_order='".$_GET['order']."'";
$query_to_alert	= mysql_query($sql_to_alert);
$d_to_alert = mysql_fetch_array($query_to_alert);
$view		= $d_to_alert['view'];
if ($level == '3'){
	if (($view=='')or($view=='1')){
			$view_update = "1";
	}else
	if (($view=='2')or($view=='23')or($view=='3')){
			$view_update = "$view1";
	}else
	if ($view=='123'){
			$view_update = "123";
	}
}else
if ($level == '4'){
	if (($view=='')or($view=='2')){
			$view_update = "2";
	}else
	if ($view=='1'){
			$view_update = "12";
	}else
	if ($view=='3'){
			$view_update = "23";
	}else
	if (($view=='13')or($view=='123')){
			$view_update = "123";
	}
}else
if ($level == '5'){
	if (($view=='')or($view=='3')){
			$view_update = "3";
	}else
	if (($view=='1')or($view=='12')or($view=='2')){
			$view_update = "$view"."3";
	}else
	if ($view=='123'){
		$view_update = "123";
	}
}

$udpate = mysql_query("UPDATE orders SET view ='".$view_update."' WHERE id_order = '".$_GET['order']."'");
}else
if($_GET['page']=='order'){
$sql_to_alert = "SELECT * FROM orders JOIN orders_items ON 
					orders.id_order = orders_items.id_order JOIN produk ON
					produk.id_produk = orders_items.id_produk";
$query_to_alert	= mysql_query($sql_to_alert);
while($d_to_alert = mysql_fetch_array($query_to_alert)){
$view		= $d_to_alert['view'];
if ($level == '3'){
	if (($view=='')or($view=='1')){
			$view_update = "1";
	}else
	if (($view=='2')or($view=='23')or($view=='3')){
			$view_update = "$view1";
	}else
	if ($view=='123'){
			$view_update = "123";
	}
}else
if ($level == '4'){
	if (($view=='')or($view=='2')){
			$view_update = "2";
	}else
	if ($view=='1'){
			$view_update = "12";
	}else
	if ($view=='3'){
			$view_update = "23";
	}else
	if (($view=='13')or($view=='123')){
			$view_update = "123";
	}
}else
if ($level == '5'){
	if (($view=='')or($view=='3')){
			$view_update = "3";
	}else
	if (($view=='1')or($view=='12')or($view=='2')){
			$view_update = "$view"."3";
	}else
	if ($view=='123'){
			$view_update = "123";
	}
}

$udpate = mysql_query("UPDATE orders SET view ='".$view_update."' WHERE id_order = '".$d_to_alert['id_order']."'");
}
}
}
?>