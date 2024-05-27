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

function userLogin($nik){
    global $conn;
    $result = mysqli_query($conn, "SELECT * FROM user WHERE NIK = $nik");
    return mysqli_fetch_assoc($result);

}

function loginAdminandGov($user){
    global $conn;
    $email = $user["email"];
    $pass = $user["password"];
    $admin = mysqli_query($conn, "SELECT * FROM admin WHERE email_admin = '$email' AND password_admin = '$pass'");
    $gov = mysqli_query($conn, "SELECT * FROM supervisor WHERE email_supervisor= '$email' AND password_supervisor = '$pass'");
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
    return mysqli_query($conn, "SELECT postingan.*, user.nama_user, user.foto_profil_user FROM postingan JOIN user ON postingan.NIK = user.NIK;");
}

function trendingpost(){
    global $conn;
    $currMonth = date("m");
    $currYear = date("Y");
    return mysqli_query($conn, "SELECT postingan.media, postingan.tgl_postingan, postingan.alamat_postingan, user.nama_user FROM postingan JOIN user ON postingan.NIK = user.NIK WHERE MONTH(postingan.tgl_postingan) = $currMonth AND YEAR(postingan.tgl_postingan) = $currYear AND postingan.status_postingan = 'Accepted' ORDER BY postingan.jumlah_saved DESC LIMIT 5");
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
            $query = "INSERT INTO postingan VALUES('', NOW(), '$address', 0, '$targetFile', '$caption', '$nik', 'ditunggu')";
            mysqli_query($conn, $query);
            return mysqli_affected_rows($conn);
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

function addStaf($data, $file) {
    global $conn;
    $name = htmlspecialchars($data["addName"]);
    $email = htmlspecialchars($data["addEmail"]);
    $pass = htmlspecialchars($data["addPassword"]);
    if(isset($file["addFoto"]) && $file["addFoto"]["error"] == 0){
        $targetDir = "../img/";
        $targetFile = $targetDir . basename($file["addFoto"]["name"]);
        if(move_uploaded_file($file["addFoto"]["tmp_name"], $targetFile)){
            $query = "INSERT INTO supervisor VALUES('', '$name', '$email', '$pass', '$targetFile')";
            mysqli_query($conn, $query);
            return mysqli_affected_rows($conn);
        }
    }
    $query = "INSERT INTO supervisor VALUES('', '$name', '$email', '$pass', '../img/default.jpeg')";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function editStaf($data, $file) {
    global $conn;
    $id = htmlspecialchars($data["editId"]);
    $name = htmlspecialchars($data["editNama"]);
    $email = htmlspecialchars($data["editEmail"]);
    if(isset($file["profile-staf"]) && $file["profile-staf"]["error"] == 0){
        $targetDir = "../img/";
        $targetFile = $targetDir . basename($file["profile-staf"]["name"]);
        if(move_uploaded_file($file["profile-staf"]["tmp_name"], $targetFile)){
            $query = "UPDATE supervisor SET nama_supervisor = '$name', email_supervisor = '$email', foto_profil_staff = '$targetFile' WHERE id_supervisor = $id";
            mysqli_query($conn, $query);
            return mysqli_affected_rows($conn);
        }
    }
}

function deleteStaf($id) {
    global $conn;
    $query = "DELETE FROM supervisor WHERE id_supervisor = $id";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function kelolaMasyarakat($data) {
    global $conn;
    $nik = htmlspecialchars($data["editNik"]);
    $username = htmlspecialchars($data["editNama"]);
    $email = htmlspecialchars($data["editEmail"]);
    $password = htmlspecialchars($data["editPassword"]);
    $query = "UPDATE user SET email_user = '$email', password_user = '$password', nama_user = '$username' WHERE NIK = $nik";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function deleteMasyarakat($nik) {
    global $conn;
    $query = "DELETE FROM user WHERE NIK = $nik";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function savePostingan($post){
    global $conn;
    $id = $post["idpost"];
    $nik = $post["nik"];
    $tanggal = date("Y-m-d");
    $query = "INSERT INTO saved VALUES('$id', '$nik', NOW())";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function unsavePostingan($post){
    global $conn;
    $id = $post["idpost"];
    $nik = $post["nik"];
    $query = "DELETE FROM saved WHERE id_postingan = '$id' AND NIK = '$nik'";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function cekSave($idpost, $nik){
    global $conn;
    $query = mysqli_query($conn, "SELECT * FROM saved WHERE NIK = $nik AND id_postingan = $idpost");
    if(mysqli_num_rows($query) > 0){
        return true;
    }else{
        return false;
    }
}

function userSaved($nik){
    global $conn;
    return mysqli_query($conn, "SELECT postingan.*, user.nama_user, user.foto_profil_user, saved.waktu_disimpan FROM postingan JOIN saved ON postingan.id_postingan = saved.id_postingan JOIN user ON postingan.NIK = user.NIK WHERE saved.NIK = $nik");
}

function findHistPost($nik){
    global $conn;
    return mysqli_query($conn, "SELECT postingan.*, user.nama_user, user.foto_profil_user FROM postingan JOIN user ON postingan.NIK = user.NIK WHERE postingan.NIK = $nik");
}

?>