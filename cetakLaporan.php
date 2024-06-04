<?php
include 'php/functions.php';
require 'pdf/fpdf/fpdf.php';

$conn = mysqli_connect("localhost", "root", "", "dbrecity");

if (!isset($_SESSION["id_supervisor"])) {
    header("Location: ../loginAdminandGov.php");
    exit();
} else {
    $id_supervisor = $_SESSION["id_supervisor"];
    $supervisor = stafLogin($id_supervisor);
}

if (isset($_GET['id_postingan'])) {
    $no_postingan = $_GET['id_postingan'];

    $query = "
        SELECT 
            p.id_postingan AS id_postingan,
            p.tgl_postingan AS tgl_postingan,
            p.caption AS caption,
            p.media AS media,
            p.status_postingan AS status_postingan,
            u.nama_user AS nama_pelapor,
            u.foto_profil_user AS foto_pelapor
        FROM 
            postingan p
        JOIN 
            user u ON p.NIK = u.NIK
        WHERE 
            p.id_postingan = '$no_postingan'
    ";

    $result = mysqli_query($conn, $query); 
    if ($result->num_rows > 0) {
        $postingan = $result->fetch_assoc();
    } else {
        die("Detail postingan tidak ditemukan.");
    }

    // Create PDF
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(40, 10, 'Laporan Pengaduan');
    $pdf->Ln();
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(40, 10, 'Nama Pelapor: ' . $postingan['nama_pelapor']);
    $pdf->Ln();
    $pdf->Cell(40, 10, 'Tanggal Laporan: ' . $postingan['tgl_postingan']);
    $pdf->Ln();
    $pdf->Cell(40, 10, 'Status Laporan: ' . $postingan['status_postingan']);
    $pdf->Ln();
    $pdf->Cell(40, 10, 'Caption: ' . $postingan['caption']);
    $pdf->Ln();
    //$pdf->Cell(40, 10, 'Gambar: ');
   // $pdf->Image($postingan['media'], 50, $pdf->GetY(), 100, 0, 'jpg');
    //$pdf->Ln();

    $pdf->Output('D', 'Laporan.pdf');
} else {
    echo "Postingan Tidak Ditemukan";
}
?>