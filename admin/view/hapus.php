<?php 
include '../config/config.php';
$id=$_GET['id'];
mysql_query("delete from tb_produk where id_produk='$id'");
header("location:barang.php");

?>