<?php
require '../php/functions.php';
if (editStaf($_POST, $_FILES)) {
    echo "<script>alert('Data berhasil diubah');</script>";
} else {
    echo "<script>alert('Data gagal diubah.');</script>";
}
header("Location: ../admin/dataGovernment.php");
?>
