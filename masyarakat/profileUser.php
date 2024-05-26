<?php 
require '../php/functions.php';
$conn = mysqli_connect("localhost" , "root", "", "recity");
$nik = $_SESSION["NIK"];
$query = mysqli_query($conn, "SELECT * FROM user WHERE NIK = $nik");
$user = mysqli_fetch_assoc($query);
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
                <li class="search-box">
                    <i class='bx bx-search icon'></i>
                    <input type="text" placeholder="Search...">
                </li>
                <ul class="menu-links">
                    <li class="nav-link">
                        <a href="#">
                            <i class='bx bx-home-alt icon' ></i>
                            <span class="text nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="saved.html">
                            <i class='bx bx-bookmark icon'></i>
                            <span class="text nav-text">Saved</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="history.html">
                            <i class='bx bx-history icon'></i>
                            <span class="text nav-text">History</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="#">
                            <i class='bx bx-pie-chart-alt icon' ></i>
                            <span class="text nav-text">Statistic</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="#">
                            <i class='bx bx-cog icon'></i>
                            <span class="text nav-text">Settings</span>
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
                    <?= $_SESSION["foto_profil"];?>" alt="Profil Picture">
                </a>
                <p><?= $_SESSION["nama_user"];?></p>
            </div>
        </div>
        <div class="isi-konten">
            <div class="profile">
                <form action="../php/handleUpdateMasyarakat.php" method="post" enctype="multipart/form-data" class="profile-form">
                    <div class="profile-container">
                        <div class="profile-pic-container">
                            <img id="profile-pic" src="<?= $user['foto_profil']; ?>" class="profile-pic">
                            <input type="file" id="profile-pic-input" name="profile-pic" accept="image/*" style="display: none;">
                            <button type="button" class="edit-button"><i class='bx bx-pencil icon'></i></button>
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
                                <input type="date" id="dob" name="dob" value="<?= $user["tanggal_lahir"];?>">
                            </div>
                            <div class="form-group">
                                <label for="gender">Jenis Kelamin</label>
                                <select id="gender" name="gender" class="select-gender">
                                    <option value="Perempuan" <?= $user["jenis_kelamin"] == 'Perempuan' ? 'selected' : ''; ?>>Perempuan</option>
                                    <option value="Laki-laki" <?= $user["jenis_kelamin"] == 'Laki-laki' ? 'selected' : ''; ?>>Laki-laki</option>
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
                                <button type="submit" class="save-button">Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="../js/masyarakatValidation.js"></script>
    <script src="../js/sidebar.js"></script>
    <script src="../js/postAtribut.js"></script>
</body>
</html>
