<?php
require '../php/functions.php';

$update = editMasyarakat($_POST);
if($update > 0){
    echo "<script>
    alert('Data berhasil diubah');
    </script>";
} else {
    echo "<script>
    alert('Data gagal diubah');
    </script>";
}
header("Location: ../masyarakat/profileUser.php");
?>
