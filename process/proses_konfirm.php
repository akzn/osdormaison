<?php
//var_dump($_POST);die;
session_start();
	include_once "../config/conn.php";
    include_once "../config/general_helper.php";
	$insert_conf = mysql_query("INSERT INTO tb_payment(`kode_order`,`email`,`bank_asal`,`an_asal`,`bank_tujuan`,`nominal`,`tgl_konfirmasi`)
VALUES('".$_POST['key']."','".$_POST['email']."','".$_POST['bank_pengirim']."','".$_POST['atas_nama_pengirim']."','".$_POST['bank_tujuan']."','".$_POST['nominal']."','".date('Y-m-d')."')") or die(mysql_error());
	

	if ($insert_conf) {
		$judul = 'Konfirmasi Pembayaran';
		$isi = 'Pembayaran anda dengan kode '. $_POST['key'] .' sudah masuk ke sistem. Silahkan menuggu konfirmasi dari kami, terimakasih telah berbelanja di toko kami';
		mailer_2($judul,$isi,$_POST['email']);
		?>

		<meta http-equiv="refresh" content="0;url=<?=BASE?>?hal=confirm_ok">

		<?php
	}

?>

