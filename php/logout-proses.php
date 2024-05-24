<?php
session_start();
session_destroy();
header("Location: ../loginMasyarakat.php");
exit();
?>