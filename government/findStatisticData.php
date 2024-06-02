<?php
require '../php/functions.php';
if (isset($_GET['year']) && is_numeric($_GET['year'])) {
    $year = $_GET['year'];

    $monthlyStats = findMonthlyStats($year);
    echo json_encode($monthlyStats);
} else {
    echo json_encode(array('error' => 'Invalid year parameter'));
}
?>
