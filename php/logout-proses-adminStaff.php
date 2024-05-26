<?php
session_start();
session_destroy();
header("Location: ../loginAdminandGov.php");
exit();
?>