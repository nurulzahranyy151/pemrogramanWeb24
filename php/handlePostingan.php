<?php
require '../php/functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (uploadPostingan($_POST, $_FILES)) {
        $_SESSION['message'] = "Upload successful!";
    } else {
        $_SESSION['message'] = "Failed to upload report.";
    }
    header("Location: ../masyarakat/dashboard.php");
    exit();
}
?>
