<?php
require 'functions.php';
$loginResult = loginAdminandGov($_POST);
if ($loginResult == 1) {
    header("Location: ../admin/dashboardAdmin.php");
    exit();
} else if ($loginResult == 0) {
    header("Location: ../government/dashboardGovernment.php");
    exit();
} else {
    header("Location: /pemrogramanWeb24/loginAdminandGov.php?error=1");
    exit();
}
?>
