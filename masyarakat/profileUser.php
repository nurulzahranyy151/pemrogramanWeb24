<?php 
require '../php/functions.php';
if(!isset($_SESSION["NIK"])){
    header("Location: ../loginMasyarakat.php");
    exit;
} else {
    $nik = $_SESSION["NIK"];
    $user = userLogin($nik);
}

if(isset($_POST["saveChange"])){
    editMasyarakat($_POST, $_FILES);
    $user = userLogin($nik);
    unset($_POST);
    unset($_FILES);
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/pageMasyarakat.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,300;0,600;0,700;0,800;1,200;1,300;1,600;1,700;1,800&display=swap" rel="stylesheet" />
    <title>Profile Anda</title>
</head>
<body>
    <nav class="sidebar close">
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="../img/recity.png" alt="logo recity">
                </span>
                <div class="text logo-text">
                    <span class="name">Recity</span>
                    <span class="profession">Resolver City</span>
                </div>
            </div>
            <i class='bx bx-chevron-right toggle'></i>
        </header>

        <div class="menu-bar">
            <div class="menu">
                <ul class="menu-links">
                    <li class="nav-link">
                        <a href="dashboard.php">
                            <i class='bx bx-home-alt icon' ></i>
                            <span class="text nav-text">Beranda</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="saved.php">
                            <i class='bx bx-bookmark icon'></i>
                            <span class="text nav-text">Tersimpan</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="history.php">
                            <i class='bx bx-history icon'></i>
                            <span class="text nav-text">Riwayat</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="statistic.php">
                            <i class='bx bx-pie-chart-alt icon' ></i>
                            <span class="text nav-text">Statistik</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="bottom-content">
                <li class="">
                    <a href="#">
                        <i class='bx bx-log-out icon' ></i>
                        <span class="text nav-text">Logout</span>
                    </a>
                </li>

                <li class="mode">
                    <div class="sun-moon">
                        <i class='bx bx-moon icon moon'></i>
                        <i class='bx bx-sun icon sun'></i>
                    </div>
                    <span class="mode-text text">Dark mode</span>
                    <div class="toggle-switch">
                        <span class="switch"></span>
                    </div>
                </li>
            </div>
        </div>
    </nav>

    <div class="konten">
        <div class="header-konten">
            <div class="page-name">
                <h2>Profil</h2>
            </div>
            <div class="user-login">
                <a href="profileUser.html">
                    <img src="
                    <?= $user["foto_profil_user"];?>" alt="Profil Picture">
                </a>
                <p><?= $user["nama_user"];?></p>
            </div>
        </div>
        <div class="isi-konten">
            <div class="profile">
                <form action="" method="post" enctype="multipart/form-data" class="profile-form">
                    <div class="profile-container">
                        <div class="profile-pic-container">
                            <img id="profile-pic" src="<?= $user['foto_profil_user'];?>" class="profile-pic">
                            <input type="file" id="profile-pic-input" name="profile-pic"  style="display: none;">
                            <button type="button"  class="edit-button" onclick="changeProfilUser()"><i class='bx bx-pencil icon'></i></button>
                        </div>
                        <div class="form-container">
                            <div class="form-group">
                                <label for="nik">NIK (Wajib)</label>
                                <input type="text" id="nik" name="nik" value="<?= $user["NIK"];?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="name">Nama Anda</label>
                                <input type="text" id="nama" name="nama" value="<?= $user["nama_user"];?>">
                            </div>
                            <div class="form-group">
                                <label for="dob">Tanggal Lahir</label>
                                <input type="date" id="dob" name="dob" value="<?= $user["tgl_lahir_user"];?>">
                            </div>
                            <div class="form-group">
                                <label for="gender">Jenis Kelamin</label>
                                <select id="gender" name="gender" class="select-gender">
                                    <option value="Perempuan" <?= $user["gender"] == 'Perempuan' ? 'selected' : ''; ?>>Perempuan</option>
                                    <option value="Laki-laki" <?= $user["gender"] == 'Laki-laki' ? 'selected' : ''; ?>>Laki-laki</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="address">Alamat</label>
                                <input type="text" id="address" name="address" value="<?= $user["alamat_asal"];?>">
                            </div>
                            <div class="form-group">
                                <label for="current-address">Alamat Sekarang</label>
                                <input type="text" id="current-address" name="current-address" value="<?= $user["alamat_sekarang"];?>">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" value="<?= $user["email_user"];?>">
                            </div>
                            <div class="form-group">
                                <label for="password">Kata Sandi</label>
                                <input type="password" id="password" name="password" value="<?= $user["password_user"];?>">
                            </div>
                            <div class="form-actions">
                                <button type="button" class="cancel-button" onclick="cancelEdit()">Batalkan</button>
                                <button type="submit" class="save-button" name="saveChange">Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="../js/masyarakatValidation.js"></script>
    <script src="../js/postAtribut.js"></script>
    <script src="../js/sidebar.js"></script>
    
</body>
</html>
