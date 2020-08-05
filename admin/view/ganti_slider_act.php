<?php 
include 'config.php';


$target_dir = "../img/slider/";


if ($_GET['slide']==1) {
    $newfilename ='slide1.png';
} else if ($_GET['slide']==2) {
    $newfilename ='slide2.png';
} else if ($_GET['slide']==3) {
    $newfilename ='slide3.png';
} else {
    header("location:ganti_slider.php?pesan=error");
}



$target_file = $target_dir . $newfilename;
$uploadOk = 1;

$temp = explode(".", $_FILES["file"]["name"]);
$ext =end($temp);


//$imageFileType = pathinfo($target_file_lalala,PATHINFO_EXTENSION);
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
if($ext != "jpg" && $ext != "png") {
    echo "Sorry, only JPG,PNG files are allowed.";
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
        header("location:ganti_slider.php?pesan=oke");
    } else {
        echo "Sorry, there was an error uploading your file.";
        die;
    }
}


?>
