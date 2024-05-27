<?php
require '../php/functions.php';
if (uploadPostingan($_POST, $_FILES)) {
    echo "<script>alert('Post berhasil dibuat');</script>";
} else {
    echo "<script>alert('Postingan gagal dibuat.');</script>";
}
header("Location: ../masyarakat/dashboard.php");
?>
