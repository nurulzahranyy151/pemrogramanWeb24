<?php
$conn = mysqli_connect("localhost" , "root", "", "recity");
$users = mysqli_query($conn, "SELECT * FROM user");
function query($query){
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while( $row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}
function sign($data){
    global $conn;
    $nama = htmlspecialchars($data["nama"]);
    $nik = htmlspecialchars($data["nik"]);
    $email = htmlspecialchars($data["email"]);
    $password = htmlspecialchars($data["password"]);
    $cek = mysqli_query($conn, "SELECT * FROM user");
    while($row = mysqli_fetch_assoc($cek)){
        if($row["NIK"] == $nik){
            return 0;
        }
    }
    $query= "INSERT INTO user
    VALUES('$nik', '$nama', '$email', '$password')";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function login($user){
    global $conn;
    $email = $user["email"];
    $pass = $user["password"];
    $data = mysqli_query($conn, "SELECT * FROM user");
    $cek = 0;
    while($row = mysqli_fetch_assoc($data)){
        if($row["email_user"] == $email && $row["password_user"] == $pass){
            $cek = 1;
            break;
        }
    }
    return $cek;
}
function hapus($nik){
    global $conn;
    mysqli_query($conn, "DELETE FROM user WHERE NIK = '$nik'");
    return mysqli_affected_rows($conn);
}
?>