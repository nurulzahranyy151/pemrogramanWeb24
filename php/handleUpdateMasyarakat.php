<?php
require '../php/functions.php';

if(editMasyarakat($_POST)){
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
