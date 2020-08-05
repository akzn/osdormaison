<?php

include '../config/config.php';
include '../config/general_helper.php';
require('../assets/pdf/fpdf.php');

$pdf = new FPDF("L","cm","A4");

$pdf->SetMargins(2,1,1);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','B',11);
$pdf->Image('../img/logo.jpg',1,1,2,2);
$pdf->SetX(4);            
$pdf->MultiCell(19.5,0.5,'Osdormaison',0,'L');
$pdf->SetX(4);   
$pdf->SetFont('Arial','B',10);
$pdf->SetX(4);
$pdf->MultiCell(19.5,0.5,'Sleman Yogyakarta',0,'L');
$pdf->SetX(4);
$pdf->Line(1,3.1,28.5,3.1);
$pdf->SetLineWidth(0.1);      
$pdf->Line(1,3.2,28.5,3.2);   
$pdf->SetLineWidth(0);
$pdf->ln(1);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,0.7,'Laporan Data Penjualan Barang',0,0,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(5,0.7,"Di cetak pada : ".date("D-d/m/Y"),0,0,'C');
$pdf->ln(1);
$pdf->Cell(6,0.7,"Laporan Penjualan pada : ".$_GET['tanggal'],0,0,'C');
$pdf->ln(1);
$pdf->Cell(1, 0.8, 'NO', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Tanggal', 1, 0, 'C');
$pdf->Cell(6, 0.8, 'Kode Order', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Total', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Ongkir', 1, 0, 'C');
$pdf->Cell(4.5, 0.8, 'Jumlah', 1, 1, 'C');

$no=1;
$tanggal=$_GET['tanggal'];
$query=mysql_query("select * from tb_order where tgl_order=" . $tanggal);
while($lihat=mysql_fetch_array($query)){
	$pdf->Cell(1, 0.8, $no , 1, 0, 'C');
	$pdf->Cell(3, 0.8, $lihat['tgl_order'],1, 0, 'C');
	$pdf->Cell(6, 0.8, $lihat['kode_order'],1, 0, 'C');
	$pdf->Cell(3, 0.8, uang($lihat['subtotal']), 1, 0,'C');
	$pdf->Cell(4, 0.8, "Rp. ".number_format($lihat['ongkir'])." ,-", 1, 0,'C');
	$pdf->Cell(4.5, 0.8, "Rp. ".number_format($lihat['total'])." ,-",1, 1, 'C');	
	
	$no++;
}
$q=mysql_query("select sum(total) as total from tb_order where tgl_order=".$tanggal);
// select sum(total_harga) as total from barang_laku where tanggal='$tanggal'
while($total=mysql_fetch_array($q)){
	$pdf->Cell(17, 0.8, "Total", 1, 0,'C');		
	$pdf->Cell(4.5, 0.8, "Rp. ".number_format($total['total'])." ,-", 1, 0,'C');	
}

$pdf->Output("laporan_buku.pdf","I");

?>

