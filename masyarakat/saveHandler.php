<?php
require '../php/functions.php';

$idpost = $_POST['id'];
$status = filter_var($_POST['status'], FILTER_VALIDATE_BOOLEAN);

if ($status) {
    savePostingan($idpost);
} else {
    unsavePostingan($idpost);
}
?>
