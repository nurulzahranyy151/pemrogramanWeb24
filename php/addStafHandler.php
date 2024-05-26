<?php
require '../php/functions.php';

$add = addStaf($_POST);
if($add > 0){
    echo "<script>
    alert('Data berhasil ditambah');
    </script>";
} else {
    echo "<script>
    alert('Data gagal ditambah');
    </script>";
}
header("Location: ../admin/dataGovernment.php");
?>
