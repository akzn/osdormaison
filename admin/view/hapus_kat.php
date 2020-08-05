<?php 
include '../config/config.php';
$id=$_GET['id'];
mysql_query("delete from tb_kategori where id_kategori='$id'");
header("location:kategori.php");

?>