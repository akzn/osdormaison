<?php 
include '../config/config.php';
$id=$_GET['id'];
mysql_query("delete from tb_berita where id_berita='$id'");
header("location:berita.php");

?>