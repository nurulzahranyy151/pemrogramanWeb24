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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/pageMasyarakat.css">
    
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <script src="../js/loginValidation.js"></script>
    <title>Beranda</title>
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
                    <a href="statistik.php">
                        <i class='bx bx-bar-chart-alt-2 icon'></i>
                        <span class="text nav-text">Statistik Laporan</span>
                    </a>
                </li>
            </ul>
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
            <h2>Beranda</h2>
        </div>
        <div class="user-login">
            <a href="profilStaff.php">
                <img src="<?= $supervisor["foto_profil_staff"];?>" alt="Profil Picture">
            </a>
            <p><?= $supervisor["nama_supervisor"];?></p>
        </div>
    </div>
    <div id="dash-staf" class="isi-konten">
        <div class="fyp">
        <?php 
        $postingan = showAllpostingan();
        while ($row = mysqli_fetch_array($postingan)) {
            if ($row['status_postingan'] === 'ditunggu') {
                ?>
                <div class="post">
                    <div class="post-header">
                        <img src="<?= $row['foto_profil_user'];?>" alt="Profil Picture">
                        <div class="post-info">
                            <h3><?= $row['nama_user'];?></h3>
                            <p><?= $row['tgl_postingan'];?></p>
                        </div>
                    </div>
                    <div class="post-content">
                        <p class="caption"><?= $row['caption'];?></p>
                        <img src="<?= $row['media'];?>" alt="Gambar postingan">
                    </div>
                    <div class="post-actions">
                        <div class="left-post-action">
                            <button name="accept-button" class="accept-button" onclick="toggleAcceptReject(<?php echo $row['id_postingan'];?>, 'accept')">
                                <i class='bx bxs-check-square'></i>
                            </button>
                            <button name="reject-button" class="reject-button" onclick="toggleAcceptReject(<?php echo $row['id_postingan'];?>, 'reject')">
                                <i class='bx bxs-x-square'></i>
                            </button>
                        </div>
                        <div class="right-post-action">
                            <button class="save-button" onclick="toggleSave(this)">
                                <i class='bx bx-bookmark'></i>Cetak
                            </button>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
        ?>
        </div>
    </div>
</div>

<!-- Modal for Confirmation -->
<div id="confirmationModal" class="modal">
    <div class="modal-content">
        <span class="close-button" onclick="closeModal()">&times;</span>
        <p id="confirmationMessage"></p>
        <button id="confirmButton" onclick="confirmAction()" class="confirmAction">Confirm</button>
        <button onclick="closeModal()" class="cancelAction">Cancel</button>
    </div>
</div>

<script src="../js/sidebar.js"></script>
<script src="../js/stafAction.js"></script>
</body>
</html>
