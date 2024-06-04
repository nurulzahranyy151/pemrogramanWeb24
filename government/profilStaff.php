<?php 
require '../php/functions.php';
if (!isset($_SESSION["id_supervisor"])) {
    header("Location: ../loginAdminandGov.php");
    exit();
}else{
    $id_supervisor = $_SESSION["id_supervisor"];
    $supervisor = stafLogin($id_supervisor);
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
                    <a href="dashboardGovernment.php">
                        <i class='bx bx-home-alt icon' ></i>
                        <span class="text nav-text">Beranda</span>
                    </a>
                </li>
                <li class="nav-link">
                    <a href="projectGovernment.php">
                        <i class='bx bx-edit icon' ></i>
                        <span class="text nav-text">Projek</span>
                    </a>
                </li>
<<<<<<< HEAD
            </div>
        </div>
    </nav>

    <div class="konten">
        <div class="header-konten">
            <div class="page-name">
                <h2>Profil</h2>
            </div>
            <div class="user-login">
                <a href="profilStaff.php">
                    <img src="
                    <?= $supervisor["foto_profil_staff"];?>" alt="Profil Picture">
                </a>
                <p><?= $supervisor["nama_supervisor"];?></p>
            </div>
=======
                <li class="nav-link">
                    <a href="projectDone.php">
                        <i class='bx bx-file icon' ></i>
                        <span class="text nav-text">Selesai</span>
                    </a>
                </li>
                <li class="nav-link">
                    <a href="statistik.php">
                        <i class='bx bx-bar-chart-alt-2 icon'></i>
                        <span class="text nav-text">Statistik Laporan</span>
                    </a>
                </li>
            </ul>
>>>>>>> e0ec1aa77a2c81a93a07d8581987c2c38613c1d8
        </div>

        <div class="bottom-content">
            <li class="">
                <a href="../php/logout-proses-adminStaff.php">
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
            <h2>Statistik</h2>
        </div>
        <div class="user-login">
            <a href="profilStaff.php"><img src="<?php echo $supervisor['foto_profil_staff'];?>" alt="Profil Picture"></a>
            <p><?php echo $supervisor["nama_supervisor"];?></p>
        </div>
    </div>
        <div class="isi-konten">
            <div class="profile">
                <form action="../php/functions.php" method="post" enctype="multipart/form-data" class="profile-form">
                    <div class="profile-container">
                        <div class="profile-pic-container">
                            <img src="<?= $supervisor["foto_profil_staff"];?>" class="profile-pic">
                        </div>
                        <div class="form-container">
                            <div class="form-group">
                                <label for="nik">Staff ID</label>
                                <input type="text" id="nik" name="nik" value="<?= $supervisor["id_supervisor"];?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="name">Nama Anda</label>
                                <input type="text" id="name" name="name" placeholder="<?= $supervisor["nama_supervisor"];?>"readonly>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" placeholder="<?= $supervisor["email_supervisor"];?>"readonly>
                            </div>
                            <div class="form-group">
                                <label for="password">Kata Sandi</label>
                                <input type="password" id="password" name="password" placeholder="<?= $supervisor["password_supervisor"];?>"readonly>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="../js/loginValidation.js"></script>
    <script src="../js/sidebar.js"></script>
    <script src="../js/postAtribut.js"></script>
</body>
</html>
