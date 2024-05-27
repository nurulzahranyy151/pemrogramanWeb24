<?php
require '../php/functions.php';
if(deleteStaf($_POST["deleteId"])){
    echo "<script>
    alert('Data berhasil dihapus');
    </script>";
} else {
    echo "<script>
    alert('Data gagal dihapus');
    </script>";
}
header("Location: ../admin/dataGovernment.php");
?>
