<?php
require '../php/functions.php';
require '../pdf/fpdf/fpdf.php';

if (!isset($_SESSION["id_supervisor"])) {
    header("Location: ../loginAdminandGov.php");
    exit();
} else {
    $id_supervisor = $_SESSION["id_supervisor"];
    $supervisor = stafLogin($id_supervisor);
}

if (isset($_GET['id_postingan'])) {
    $no_postingan = $_GET['id_postingan'];

    $postingan = selectPost($no_postingan);

    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(40, 10, 'Laporan Pengaduan');
    $pdf->Ln();
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(40, 10, 'Nama Pelapor: ' . $postingan['nama_user']);
    $pdf->Ln();
    $pdf->Cell(40, 10, 'Tanggal Laporan: ' . $postingan['tgl_postingan']);
    $pdf->Ln();
    $pdf->Cell(40, 10, 'Status Laporan: ' . $postingan['status_postingan']);
    $pdf->Ln();
    $pdf->Cell(40, 10, 'Caption: ' . $postingan['caption']);
    $pdf->Ln();
    $pdf->Cell(40, 10, 'Gambar: ');
    $media = $postingan['media'];
    $mediaArray = explode(",", $media);
    foreach ($mediaArray as $img) {
        if (strpos($img, '.png') !== false || strpos($img, '.jpg') !== false || strpos($img, '.jpeg') !== false || strpos($img, '.gif') !== false) {
            $pdf->Image($img, 50, $pdf->GetY(), 100, 0);
            $pdf->Ln();
        }
    }
    $pdf->Ln();

    $pdf->Output('D', 'Laporan_' . $postingan['id_postingan'] . '-by-' . $postingan['nama_user'] . '.pdf');
} else {
    echo "Postingan Tidak Ditemukan";
}
?>