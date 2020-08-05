<?php
// -----------------------------------------------------------------------------



if (!function_exists('uang')) {

    function uang($money) {
        $h = 'Rp.'.number_format($money,0,'.','.');
        return $h;
    }

}

if (!function_exists('bilangan')) {

    function bilangan($money) {
        $h = number_format($money,0,'.','.');
        return $h;
    }

}

if (!function_exists('convertToHoursMins')) {
function convertToHoursMins($time, $format = '%d:%d') {
    settype($time, 'integer');
    if ($time < 1) {
        return;
    }
    $hours = floor($time / 60);
    $minutes = ($time % 60);
    return sprintf($format, $hours, $minutes);
}
}

if (!function_exists('bulanwow')) {

    function bulanwow($i) {
        $BulanIndo = array("Januari", "Februari", "Maret",
                           "April", "Mei", "Juni",
                           "Juli", "Agustus", "September",
                           "Oktober", "November", "Desember");
            
        $result = $BulanIndo[$i-1];
        return($result);
        //$h = date('d F Y',strtotime($dt));
        //return $h;
    }

}

if (!function_exists('tanggalwow')) {

    function tanggalwow($date) {
        $BulanIndo = array("Januari", "Februari", "Maret",
                           "April", "Mei", "Juni",
                           "Juli", "Agustus", "September",
                           "Oktober", "November", "Desember");
    
        $tahun = substr($date, 0, 4); // memisahkan format tahun menggunakan substring
        $bulan = substr($date, 5, 2); // memisahkan format bulan menggunakan substring
        $tgl   = substr($date, 8, 2); // memisahkan format tanggal menggunakan substring
        
        $result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;
        return($result);
        //$h = date('d F Y',strtotime($dt));
        //return $h;
    }

}

if (!function_exists('tanggalwoah')) {

    function tanggalwoah($date) {
        $BulanIndo = array("Januari", "Februari", "Maret",
                           "April", "Mei", "Juni",
                           "Juli", "Agustus", "September",
                           "Oktober", "November", "Desember");
    
        $tahun = substr($date, 0, 4); // memisahkan format tahun menggunakan substring
        $bulan = substr($date, 5, 2); // memisahkan format bulan menggunakan substring
        $tgl   = substr($date, 8, 2); // memisahkan format tanggal menggunakan substring
        
        $jam = date('H:i',$date);
        $result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun." ".$jam;
        return($result);
        //$h = date('d F Y',strtotime($dt));
        //return $h;
    }

}


if (!function_exists('numerik')) {

    function numerik($number) {
        $h = number_format($number,0,'.',',');
        return $h;
    }

}
if (!function_exists('Terbilang')) {
    function Terbilang($x)
    {
      $abil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
      if ($x < 12)
        return " " . $abil[$x];
      elseif ($x < 20)
        return Terbilang($x - 10) . "belas";
      elseif ($x < 100)
        return Terbilang($x / 10) . " puluh" . Terbilang($x % 10);
      elseif ($x < 200)
        return " seratus" . Terbilang($x - 100);
      elseif ($x < 1000)
        return Terbilang($x / 100) . " ratus" . Terbilang($x % 100);
      elseif ($x < 2000)
        return " seribu" . Terbilang($x - 1000);
      elseif ($x < 1000000)
        return Terbilang($x / 1000) . " ribu" . Terbilang($x % 1000);
      elseif ($x < 1000000000)
        return Terbilang($x / 1000000) . " juta" . Terbilang($x % 1000000);
    }
}

if(!function_exists('decode_imap_text')) {
    
    function decode_imap_text($str){
        $result = '';
        $decode_header = imap_mime_header_decode($str);
        foreach ($decode_header AS $obj) {
            $result .= htmlspecialchars(rtrim($obj->text, "\t"));
        }
        return $result;
        }
}

if (!function_exists('tanggaljam')) {

    function tanggaljam($dt) {
        $h = date('d/m/Y H:i',strtotime($dt));
        return $h;
    }

}

if (!function_exists('tanggal')) {

    function tanggal($dt) {
        $h = date('d/m/Y',strtotime($dt));
        return $h;
    }

}

if (!function_exists('des')) {

    function des($num) {
        $h = number_format($num,0,'.',',');
        return $h;
    }
}

if (!function_exists('gen_pass')) {
    function gen_pass($length = 6) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}

if (!function_exists('haritanggal')) {
    function haritanggal($tanggal) {
    $day = date('D', strtotime($tanggal));
    $dayList = array(
        'Sun' => 'Minggu',
        'Mon' => 'Senin',
        'Tue' => 'Selasa',
        'Wed' => 'Rabu',
        'Thu' => 'Kamis',
        'Fri' => 'Jumat',
        'Sat' => 'Sabtu'
    );
    return($dayList[$day]);
    }
}

if (!function_exists('mailer_1')){
    function mailer_1($judul,$isi,$email){
        require 'admin/assets/PHPMailer/PHPMailerAutoload.php';

        //$judul = $_POST['judul'];
        //$isi = $_POST['isi'];

        $judul = $judul;
        $isi = $isi;

        $mail = new PHPMailer;

        //$mail->SMTPDebug = 3;                               // Enable verbose debug output

        $mail = new PHPMailer(); // create a new object
        $mail->IsSMTP(); // enable SMTP
        $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true; // authentication enabled
        $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587; // or 587
        $mail->IsHTML(true);
        $mail->Username = "wishes.apparel1@gmail.com";
        $mail->Password = "farik1111";
        $mail->SetFrom("wishes.apparel1@gmail.com");
        $mail->Subject = $judul;
        $mail->Body = $isi;
        $mail->AddAddress($email);

        if(!$mail->send()) {
            $msg =  'Message could not be sent.';
            //echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            $msg = 'Message has been sent';
        }
        return $msg;
    }
}

if (!function_exists('mailer_2')){
    function mailer_2($judul,$isi,$email){
        require '../admin/assets/PHPMailer/PHPMailerAutoload.php';

        //$judul = $_POST['judul'];
        //$isi = $_POST['isi'];

        $judul = $judul;
        $isi = $isi;

        $mail = new PHPMailer;

        //$mail->SMTPDebug = 3;                               // Enable verbose debug output

        $mail = new PHPMailer(); // create a new object
        $mail->IsSMTP(); // enable SMTP
        $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true; // authentication enabled
        $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587; // or 587
        $mail->IsHTML(true);
        $mail->Username = "wishes.apparel1@gmail.com";
        $mail->Password = "farik1111";
        $mail->SetFrom("wishes.apparel1@gmail.com");
        $mail->Subject = $judul;
        $mail->Body = $isi;
        $mail->AddAddress($email);

        if(!$mail->send()) {
            $msg =  'Message could not be sent.';
            //echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            $msg = 'Message has been sent';
        }
        return $msg;
    }
}

