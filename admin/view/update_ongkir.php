<?php 
include '../config/config.php';
$id=$_POST['id_provinsi'];
$nama=mysql_real_escape_string($_POST['nama_provinsi']);
$ongkir=$_POST['ongkir'];

$update = mysql_query("update tb_ongkir a join tb_provinsi b on a.id_wilayah = b.id_provinsi set a.ongkir = '$ongkir', b.nama_provinsi = '$nama' where a.id_wilayah = '$id' and b.id_provinsi ='$id' ") or die(mysql_error());

if ($update) {
     header("location:ongkos_kirim.php");
 } else echo "terjadi error";

?>