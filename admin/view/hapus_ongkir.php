<?php 
include '../config/config.php';
$id=$_GET['id'];


mysql_query("delete from tb_ongkir where id_wilayah='$id'") or die(mysql_error());

mysql_query("delete from tb_provinsi where id_provinsi='$id'")or die(mysql_error());

header("location:ongkos_kirim.php");

?>