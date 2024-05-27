<?php
require '../php/functions.php';
if (deleteMasyarakat($_POST["deleteNik"])) {
    echo "<script>alert('Data berhasil dihapus');</script>";
} else {
    echo "<script>alert('Data gagal dihapus.');</script>";
}
header("Location: ../admin/dataMasyarakat.php");
?>
