<?php
session_start();
$conn = mysqli_connect("localhost" , "root", "", "dbrecity");
function sign($data){
    global $conn;
    $nama = htmlspecialchars($data["nama"]);
    $nik = htmlspecialchars($data["nik"]);
    $dob = htmlspecialchars($data["dob"]);
    $email = htmlspecialchars($data["email"]);
    $password = htmlspecialchars($data["password"]);
    $cek = mysqli_query($conn, "SELECT * FROM user");
    while($row = mysqli_fetch_assoc($cek)){
        if($row["NIK"] == $nik){
            return 0;
        }
    }
    $query= "INSERT INTO user
    VALUES('$nik', '$nama', '$email', '$password','','$dob','','','','../img/default.jpeg')";
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

function adminLogin($id){
    global $conn;
    $result = mysqli_query($conn, "SELECT * FROM admin WHERE id_admin = $id");
    return mysqli_fetch_assoc($result);
}

function stafLogin($id){
    global $conn;
    $result = mysqli_query($conn, "SELECT * FROM supervisor WHERE id_supervisor = $id");
    return mysqli_fetch_assoc($result);
}

function findMasyarakat(){
    global $conn;
    return mysqli_query($conn, "SELECT * FROM user");
}

function paginationMasyarakat($DataUserStart, $SumDataEachPage){
    global $conn;
    return mysqli_query($conn, "SELECT * FROM user LIMIT $DataUserStart, $SumDataEachPage");
}

function findGov(){
    global $conn;
    return mysqli_query($conn, "SELECT * FROM supervisor");
}

function paginationGov($start, $perpage){
    global $conn;
    return mysqli_query($conn, "SELECT * FROM supervisor LIMIT $start, $perpage");
}

function paginationSearchGov($keyword, $start, $perpage){
    global $conn;
    return mysqli_query($conn, "SELECT * FROM supervisor WHERE nama_supervisor LIKE '$keyword%' LIMIT $start, $perpage");
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
    return mysqli_query($conn, "SELECT postingan.*, user.nama_user, user.foto_profil_user FROM postingan JOIN user ON postingan.NIK = user.NIK ORDER BY postingan.tgl_postingan DESC");
}

function trendingpost(){
    global $conn;
    $currMonth = date("m");
    $currYear = date("Y");
    return mysqli_query($conn, "SELECT postingan.media, postingan.tgl_postingan, postingan.alamat_postingan, user.nama_user FROM postingan JOIN user ON postingan.NIK = user.NIK WHERE MONTH(postingan.tgl_postingan) = $currMonth AND YEAR(postingan.tgl_postingan) = $currYear AND postingan.status_postingan = 'diterima' ORDER BY postingan.jumlah_saved DESC LIMIT 5");
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
    }else{
        $query = "INSERT INTO postingan VALUES('', NOW(), '$address', 0, '', '$caption', '$nik', 'ditunggu')";
        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }
    return false;
}


function popupPost($idpost){
    global $conn;
    $query = mysqli_query($conn, "SELECT postingan.*, user.nama_user, user.foto_profil_user FROM postingan JOIN user ON postingan.NIK = user.NIK WHERE postingan.id_postingan = $idpost");
    return mysqli_fetch_assoc($query);
}

function editMasyarakat($data, $file) {
    global $conn;
    $nik = $_SESSION["NIK"];
    $name = htmlspecialchars($data["nama"]);
    $dob = htmlspecialchars($data["dob"]);
    $gender = htmlspecialchars($data["gender"]);
    $address = htmlspecialchars($data["address"]);
    $currentAddress = htmlspecialchars($data["current-address"]);
    $email = htmlspecialchars($data["email"]);
    if(isset($file["profile-pic"]) && $file["profile-pic"]["error"] == 0){
        $targetDir = "../img/";
        $targetFile = $targetDir . basename($file["profile-pic"]["name"]);
        if(move_uploaded_file($file["profile-pic"]["tmp_name"], $targetFile)){
            $query = "UPDATE user SET nama_user = '$name', tgl_lahir_user = '$dob', gender = '$gender', alamat_asal = '$address', alamat_sekarang = '$currentAddress', email_user = '$email', foto_profil_user = '$targetFile' WHERE NIK = $nik";
        }
    }else{
        $query = "UPDATE user SET nama_user = '$name', tgl_lahir_user = '$dob', gender = '$gender', alamat_asal = '$address', alamat_sekarang = '$currentAddress', email_user = '$email' WHERE NIK = $nik";
    }
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
    }else{
        $query = "UPDATE supervisor SET nama_supervisor = '$name', email_supervisor = '$email' WHERE id_supervisor = $id";
        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
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

function savePostingan($idpost) {
    global $conn;
    $nik = $_SESSION["NIK"];
    $tanggal = date("Y-m-d");
    $query = "INSERT INTO saved VALUES('$idpost', '$nik', NOW())";
    mysqli_query($conn, $query);
    mysqli_query($conn, "UPDATE postingan SET jumlah_saved = jumlah_saved + 1 WHERE id_postingan = $idpost");
    return mysqli_affected_rows($conn);
}

function unsavePostingan($idpost){
    global $conn;
    $nik = $_SESSION["NIK"];
    $query = "DELETE FROM saved WHERE id_postingan = '$idpost' AND NIK = '$nik'";
    mysqli_query($conn, $query);
    mysqli_query($conn, "UPDATE postingan SET jumlah_saved = jumlah_saved - 1 WHERE id_postingan = $idpost");
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

function deletePostingan($id){
    global $conn;
    $query = "DELETE FROM postingan WHERE id_postingan = $id";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function addComment($data){
    global $conn;
    $idpost = htmlspecialchars($data["idpost"]);
    $nik = $_SESSION["NIK"];
    $comment = htmlspecialchars($data["comment"]);
    $query = "INSERT INTO komentar VALUES('', '$comment', '$idpost', NOW(), '$nik')";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}


function showComment($idpost){
    global $conn;
    return mysqli_query($conn, "SELECT komentar.*, user.nama_user, user.foto_profil_user FROM komentar JOIN user ON komentar.NIK = user.NIK WHERE komentar.id_postingan = $idpost");
}

function searchStaf($keyword){
    global $conn;
    return mysqli_query($conn, "SELECT * FROM supervisor WHERE nama_supervisor LIKE '$keyword%'");
}

function searchMasyarakat($keyword){
    global $conn;
    return mysqli_query($conn, "SELECT * FROM user WHERE nama_user LIKE '$keyword%' OR NIK LIKE '$keyword%' OR email_user LIKE '$keyword%'");
}

function findSumStatusPostingan(){
    global $conn;
    $statuses = ['diterima', 'ditolak', 'ditunggu'];
    $results = [];

    foreach ($statuses as $status) {
        $query = mysqli_query($conn, "SELECT COUNT(*) AS total FROM postingan WHERE status_postingan = '$status'");
        if ($query) {
            $row = mysqli_fetch_assoc($query);
            $results[$status] = $row['total'];
        } else {
            $results[$status] = 0;
        }
    }
    $query = mysqli_query($conn, "SELECT COUNT(*) AS total FROM postingan");
    $total = ($query) ? mysqli_fetch_assoc($query)['total'] : 0;
    
    return array(
        'diterima' => $results['diterima'],
        'ditolak' => $results['ditolak'],
        'ditunggu' => $results['ditunggu'],
        'total' => $total
    );
}

function findMonthlyStats($year) {
    global $conn;
    $monthlyStats = array();

    for ($month = 1; $month <= 12; $month++) {
        $query = mysqli_query($conn, "SELECT COUNT(*) AS total FROM postingan WHERE YEAR(tgl_postingan) = $year AND MONTH(tgl_postingan) = $month");
        if ($query) {
            $row = mysqli_fetch_assoc($query);
            $monthlyStats[$month] = $row['total'];
        } else {
            $monthlyStats[$month] = 0;
        }
    }

    return $monthlyStats;
}

function accPostingan($id){
    global $conn;
    $query = "UPDATE postingan SET status_postingan = 'diterima' WHERE id_postingan = $id";
    mysqli_query($conn, $query);
    $idStaff = $_SESSION["id_supervisor"];
    mysqli_query($conn, "INSERT INTO accepted VALUES($idStaff, $id, NOW(), 'proses')");
    return mysqli_affected_rows($conn);
}

function rejectPostingan($id){
    global $conn;
    $query = "UPDATE postingan SET status_postingan = 'ditolak' WHERE id_postingan = $id";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function showProject(){
    global $conn;
    return mysqli_query($conn, "SELECT postingan.*, user.nama_user, user.foto_profil_user, accepted.waktu_terima FROM postingan JOIN user ON postingan.NIK = user.NIK JOIN accepted ON postingan.id_postingan = accepted.id_postingan WHERE postingan.status_postingan = 'diterima' AND accepted.status_projek = 'proses'");
}

function projectDone($id){
    global $conn;
    $query = "UPDATE accepted SET status_projek = 'selesai' WHERE id_postingan = $id";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function showProjectDone(){
    global $conn;
    return mysqli_query($conn, "SELECT postingan.*, user.nama_user, user.foto_profil_user, accepted.waktu_terima FROM postingan JOIN user ON postingan.NIK = user.NIK JOIN accepted ON postingan.id_postingan = accepted.id_postingan WHERE postingan.status_postingan = 'diterima' AND accepted.status_projek = 'selesai'");
}

function selectPost($id){
    global $conn;
    $query = "SELECT postingan.*, user.nama_user, user.foto_profil_user FROM postingan JOIN user ON postingan.NIK = user.NIK WHERE postingan.id_postingan = $id";
    $result = mysqli_query($conn, $query);
    return mysqli_fetch_assoc($result);
}

function findReported(){
    global $conn;
    return mysqli_query($conn, "SELECT user.*, postingan.caption, postingan.media FROM user JOIN postingan ON user.NIK = postingan.NIK");
}

function laporkanUser($nik) {
    global $conn;
    $query = "SELECT * FROM user WHERE NIK = $nik";
    $result = mysqli_query($conn, $query);
    return mysqli_fetch_assoc($result);
  }
  
  function popupLaporkan($nik) {
    global $conn;
    $query = "SELECT postingan.caption, postingan.media, user.nama_user, user.foto_profil_user FROM postingan JOIN user ON postingan.NIK = user.NIK WHERE postingan.NIK = $nik";
    $result = mysqli_query($conn, $query);
    return mysqli_fetch_assoc($result);
  }
  
  function senyapkanAkun($nik) {
    global $conn;
    $query = "UPDATE user SET status = 'enyap' WHERE NIK = $nik";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
  }
  
  function blokirAkun($nik) {
    global $conn;
    $query = "UPDATE user SET status = 'blokir' WHERE NIK = $nik";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
  }
  

?>