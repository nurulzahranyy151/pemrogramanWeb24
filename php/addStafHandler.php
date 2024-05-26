<?php
require '../php/functions.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (addStaf($_POST, $_FILES)) {
        echo "<script>alert('Data berhasil dibuat');</script>";
    } else {
        echo "<script>alert('Data gagal dibuat.');</script>";
    }
    header("Location: ../admin/dataGovernment.php");
    exit();
}
?>
