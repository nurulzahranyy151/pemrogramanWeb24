<?php
require 'functions.php';
if($_POST["ceksave"] == "not"){
    if (savePostingan($_POST)) {
        echo "<script>alert('Post berhasil disimpan');</script>";
    } else {
        echo "<script>alert('Post gagal disimpan');</script>";
    }
} else {
    if (unsavePostingan($_POST)) {
        echo "<script>alert('Post berhasil dihapus');</script>";
    } else {
        echo "<script>alert('Post gagal dihapus');</script>";
    }
}
header("Location: " . $_SERVER['HTTP_REFERER']);
exit();
?>
