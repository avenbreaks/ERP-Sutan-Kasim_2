<?php
include "../lib/koneksi.php";
$term = trim(strip_tags($_GET['term']));
  
$qstring = "SELECT * FROM orders WHERE status LIKE '3' AND id_order LIKE '".$term."%' OR id_order LIKE '%".$term."%'";
//query database untuk mengecek tabel anime
$result = mysql_query($qstring);
  
while ($row = mysql_fetch_array($result))
{
    $row['value']  = htmlentities(stripslashes($row['id_order']));
    $row['id_order']= $row['id_order'];
//buat array yang nantinya akan di konversi ke json
    $row_set[] = $row;
}
//data hasil query yang dikirim kembali dalam format json
echo json_encode($row_set);
?>