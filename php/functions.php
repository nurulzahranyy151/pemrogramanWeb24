<?php
session_start();
$conn = mysqli_connect("localhost" , "root", "", "dbrecity");
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
    VALUES('$nik', '$nama', '$email', '$password','','','','','','../img/default.jpeg')";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function loginMasyarakat($user){
    global $conn;
    $email = $user["email"];
    $pass = $user["password"];
    $result = mysqli_query($conn, "SELECT * FROM user WHERE email_user = '$email' AND password_user = '$pass'");
    if ($row = mysqli_fetch_assoc($result)) {
        $_SESSION["NIK"] = $row["NIK"];
        return 1;
    } else {
        return 0;
    }
}

function loginAdminandGov($user){
    global $conn;
    $email = $user["email"];
    $pass = $user["password"];
    $admin = mysqli_query($conn, "SELECT * FROM admin WHERE email_admin = '$email' AND password_admin = '$pass'");
    $gov = mysqli_query($conn, "SELECT * FROM supervisor WHERE email_supervisor = '$email' AND password_supervisor= '$pass'");
    if ($rowadmin = mysqli_fetch_assoc($admin)) {
        $_SESSION["id_admin"] = $rowadmin["id_admin"];
        return 1;
    } else if($rowgov = mysqli_fetch_assoc($gov)){
        $_SESSION["id_supervisor"] = $rowgov["id_supervisor"];
        return 0;
    }else {
        return -1;
    }
}

function findMasyarakat(){
    global $conn;
    return mysqli_query($conn, "SELECT * FROM user");
}

function findGov(){
    global $conn;
    return mysqli_query($conn, "SELECT * FROM supervisor");
}

function hapusUser($nik){
    global $conn;
    mysqli_query($conn, "DELETE FROM user WHERE NIK = '$nik'");
    return mysqli_affected_rows($conn);
}

function hapusStaf($id){
    global $conn;
    mysqli_query($conn, "DELETE FROM supervisor WHERE id_supervisor = '$id'");
    return mysqli_affected_rows($conn);
}

function hapuspostingan($id){
    global $conn;
    mysqli_query($conn, "DELETE FROM postingan WHERE id_postingan = '$id'");
    return mysqli_affected_rows($conn);
}

function showAllpostingan(){
    global $conn;
    return mysqli_query($conn, "SELECT postingan.*, user.nama_user, user.foto_profil FROM postingan JOIN user ON postingan.NIK = user.NIK;");
}

function trendingpost(){
    global $conn;
    $currMonth = date("m");
    $currYear = date("Y");
    return mysqli_query($conn, "SELECT postingan.media, postingan.tgl_postingan, postingan.alamat_postingan, user.nama_user FROM postingan JOIN user ON postingan.NIK = user.NIK WHERE MONTH(postingan.tgl_postingan) = $currMonth AND YEAR(postingan.tgl_postingan) = $currYear AND postingan.status = 'Accepted' ORDER BY postingan.jumlah_like DESC LIMIT 5");
}

function uploadPostingan($data, $file) {
    global $conn;
    $nik = $_SESSION["NIK"];
    $caption = htmlspecialchars($data["caption"]);
    $address = htmlspecialchars($data["address"]);

    if (isset($file["media"]) && $file["media"]["error"] == 0) {
        $targetDir = "../postingan/";
        $targetFile = $targetDir . basename($file["media"]["name"]);
        if (move_uploaded_file($file["media"]["tmp_name"], $targetFile)) {
            $query = "INSERT INTO postingan VALUES('', NOW(), '$address', 0, '$targetFile', '$caption', 'Wait', '$nik')";
            mysqli_query($conn, $query);
            return true;
        }
    }
    return false;
}

function editMasyarakat($data) {
    global $conn;
    $nik = $_SESSION["NIK"];
    $name = htmlspecialchars($data["nama"]);
    $dob = htmlspecialchars($data["dob"]);
    $gender = htmlspecialchars($data["gender"]);
    $address = htmlspecialchars($data["address"]);
    $currentAddress = htmlspecialchars($data["current-address"]);
    $email = htmlspecialchars($data["email"]);
    $query = "UPDATE user SET nama_user = '$name', tanggal_lahir = '$dob', jenis_kelamin = '$gender', alamat_asal = '$address', alamat_sekarang = '$currentAddress', email_user = '$email' WHERE NIK = $nik";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function addStaf($data) {
    global $conn;
    $name = htmlspecialchars($data["addName"]);
    $email = htmlspecialchars($data["addEmail"]);
    $pass = htmlspecialchars($data["addPassword"]);
    $query = "INSERT INTO supervisor VALUES('', '$name', '$email', '$pass', '../img/default.jpeg')";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function editStaf($data) {
    global $conn;
    $id = htmlspecialchars($data["editId"]);
    $name = htmlspecialchars($data["editNama"]);
    $email = htmlspecialchars($data["editEmail"]);
    $query = "UPDATE supervisor SET nama_supervisor = '$name', email_supervisor = '$email' WHERE id_supervisor = $id";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function deleteStaf($id) {
    global $conn;
    $query = "DELETE FROM supervisor WHERE id_supervisor = $id";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

?>