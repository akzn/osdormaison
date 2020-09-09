<?php 
// include '../config/config.php';

require '../../config/conn.php';

$id=$_POST['id_produk'];
$nama=$_POST['nama_produk'];
$harga=$_POST['harga'];
$jumlah=$_POST['stok'];
$deskripsi = mysql_real_escape_string($_POST['deskripsi']);

//var_dump($_POST);die;

if ($_FILES["file"]["name"]) {
    

$target_dir = "../img/produk/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["Simpan"])) {
    $check = getimagesize($_FILES["file"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        die;
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    unlink($target_file);
    //die;
    $uploadOk = 1;
}
// Check file size
if ($_FILES["file"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    die;
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg") {
    echo "Sorry, only JPG files are allowed.";
    die;
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    die;
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
        die;
    }
}


$file_name = pathinfo($_FILES['file']['name'], PATHINFO_FILENAME);
}

if ($file_name) {
    $gbr = ",gambar='$file_name'";
} else $gbr = '';
$update = mysql_query("update tb_produk set nama_produk='$nama', id_kategori='".$_POST['kategori']."',deskripsi='$deskripsi',harga='$harga', stok='$jumlah'".$gbr." where id_produk='$id'") or die(mysql_error());

if ($update) {
     header("location:barang.php");
 } else echo "terjadi error";

?>