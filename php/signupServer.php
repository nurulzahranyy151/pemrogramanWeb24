<?php
    if(isset($_GET['Input'])){
        $email = $_GET['email'];
        echo "Email Anda : <b>$email</b>";
    }
   
    if(isset($_GET['username'])) {
        $username = $_GET['username'];
        echo "Nama Anda : <b>$username</b><br>";
    }
    if(isset($_GET['email'])) {
        $email = $_GET['email'];
        echo "Email Anda : <b>$email</b><br>";
    }
    if(isset($_GET['password'])) {
        $password = $_GET['password'];
        echo "Password Anda : <b>$password</b><br>";
    }
?>