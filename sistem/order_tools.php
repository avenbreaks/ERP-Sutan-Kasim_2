<style>
.loader {
    position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: url("../app/assets/ico/load.gif") 50% 50% no-repeat rgb(249,249,249);
    opacity: .8;
}
</style>
<script src="../app/assets/js/jquery2.2.4jquery.min.js"></script>
<script type="../app/text/javascript">
$(window).load(function() {
    $(".loader").fadeOut("slow");
});
</script>
<div class="loader"></div>
<?php
if($_GET['stat']=='setkirim'){
	$addsql = "UPDATE orders SET validasi = 'yes' WHERE id_order = '".$_GET['order']."'";
 
	$sukses = mysql_query($addsql, $server);
	header('Location: ?page=pembayaran');
}
?>