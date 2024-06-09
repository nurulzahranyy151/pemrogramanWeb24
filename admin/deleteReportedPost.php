<?php
require '../php/functions.php';
if(isset($_SESSION["id_admin"])){
    if(isset($_POST)){
        deletePostingan($_POST['idpost']);
    }
}