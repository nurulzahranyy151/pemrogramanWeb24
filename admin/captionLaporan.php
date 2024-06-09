<?php
require '../php/functions.php';
$conn = new mysqli("localhost", "root", "", "dbrecity");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$caption = $_GET["tombolCaption"];

$query = "SELECT r.id_postingan, r.kategori, r.waktu_report, p.id_postingan, p.media, p.caption
FROM report r 
JOIN postingan p on p.id_postingan = r.id_postingan";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo $row["caption"];
    }
} else {
    echo "No caption found";
}

$conn->close();
?>

