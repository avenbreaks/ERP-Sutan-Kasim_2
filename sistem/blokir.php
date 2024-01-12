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
	$sql 	= "UPDATE login SET blokir = '1' WHERE id_user='".$_GET['id']."'";
	$query	= mysql_query($sql, $server);
	
	$cek 	= substr($_GET['id'],0,3);
	if($query){
		if ($cek == "KRY"){
			header("location:?page=karyawan");
		}else if ($cek == "U_M"){
			header("location:?page=member");
		}
	}
?>