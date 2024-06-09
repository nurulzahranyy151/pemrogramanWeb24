<?php
require '../php/functions.php';
if(isset($_SESSION['NIK'])){
    if(isset($_GET['id']) && isset($_GET['category'])){
        $id = $_GET['id'];
        $category = $_GET['category'];
        if(reportPost($id, $category)){
            echo "Laporan berhasil dikirimkan";
        }else{
            echo "Laporan gagal dikirimkan";
        }
    }
}