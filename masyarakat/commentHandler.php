<?php
require '../php/functions.php';
if(isset($_SESSION['NIK'])){
    if(isset($_POST)){
        addComment($_POST);
    }
}