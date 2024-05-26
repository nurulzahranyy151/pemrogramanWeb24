<?php
require '../php/functions.php';
$id = $_POST["deleteId"];
$delete = deleteStaf($id);
if($delete > 0){
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
