<?php

include '../config/config.php';
$nama_provinsi = $_POST['nama_provinsi'];
$ongkir = $_POST['ongkir'];

$sql1 = mysql_query("insert into tb_provinsi(nama_provinsi) values('$nama_provinsi')") or die(mysql_error());

$insert_id = mysql_insert_id();




$sql2 = mysql_query("insert into tb_ongkir(id_wilayah,ongkir) values('$insert_id','$ongkir')") or die(mysql_error());;



if ($sql2) {
    header("location:ongkos_kirim.php");
} else echo "TERJADI ERROR SAAT MENYIMPAN, HARAP ULANGI";

?>