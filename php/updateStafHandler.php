<?php
require '../php/functions.php';

$update = editStaf($_POST);
if($update > 0){
    echo "<script>
    alert('Data berhasil diubah');
    </script>";
} else {
    echo "<script>
    alert('Data gagal diubah');
    </script>";
}
header("Location: ../admin/dataGovernment.php");
?>
