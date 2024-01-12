<style>
.loader {
    position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: url("../images/load.gif") 50% 50% no-repeat rgb(249,249,249);
    opacity: .8;
}
</style>
<script type="text/javascript">
$(window).load(function() {
    $(".loader").fadeOut("slow");
});
</script>
<div class="loader"></div>
<?php
	$cek 	= substr($_GET['id'],0,3);
	
	if ($cek == "KRY"){
		$sqlfoto 	= "SELECT foto FROM karyawan WHERE id_karyawan='".$_GET['id']."'";
		$queryfoto	= mysql_query($sqlfoto);
		$dfoto		= mysql_fetch_array($queryfoto);
		$target = "../images/avatar/".$dfoto['foto'];
		if(file_exists($target)){
			unlink($target);
		}
		
		$sql 	= "DELETE FROM login WHERE id_user='".$_GET['id']."'";
		$query	= mysql_query($sql, $server);
		
		$sql2 	= "DELETE FROM karyawan WHERE id_karyawan='".$_GET['id']."'";
		$query2	= mysql_query($sql2, $server);
		if($query && $query2){
			header("location:?page=karyawan");
		}
		
	}else if ($cek == "U_M"){
		$sqlfoto 	= "SELECT foto_member FROM member WHERE id_karyawan='".$_GET['id']."'";
		$queryfoto	= mysql_query($sqlfoto);
		$dfoto		= mysql_fetch_array($queryfoto);
		$target = "../app/foto_member/".$dfoto['foto_member'];
		if(file_exists($target)){
			unlink($target);
		}
		
		$sql 	= "DELETE FROM login WHERE id_user='".$_GET['id']."'";
		$query	= mysql_query($sql, $server);
		
		$sql2 	= "DELETE FROM member WHERE id_member='".$_GET['id']."'";
		$query2	= mysql_query($sql2, $server);
		if($query && $query2){
			header("location:?page=member");
		}
	}
	else if ($cek == "CTG"){
		$sql 	= "DELETE FROM kategori WHERE id_kategori='".$_GET['id']."'";
		$query	= mysql_query($sql, $server);
		
		if($query){
			header("location:?page=kategori");
		}
	}
	else if ($cek == "CAR"){
		$sql 	= "DELETE FROM kendaraan WHERE id_kendaraan='".$_GET['id']."'";
		$query	= mysql_query($sql, $server);
		
		if($query){
			header("location:?page=kendaraan");
		}
	}
	else if ($cek == "PRD"){
		$sql 	= "DELETE FROM produk WHERE id_produk='".$_GET['id']."'";
		$query	= mysql_query($sql, $server);
		
		if($query){
			header("location:?page=produk");
		}
	}
?>