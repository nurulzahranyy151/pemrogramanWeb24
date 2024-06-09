<?php
require '../php/functions.php';
if(isset($_SESSION['NIK'])){
    if(isset($_POST['id'])){
        $id = $_POST['id'];
        $nik = $_SESSION['NIK'];
        $query = "DELETE FROM komentar WHERE id_komentar = $id AND NIK = $nik";
        mysqli_query($conn, $query);
    }
}