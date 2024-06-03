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
    <title>Projek</title>
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
            <h2>Projek</h2>
        </div>
        <div class="user-login">
            <a href="profilStaff.php"><img src="<?php echo $supervisor['foto_profil_staff'];?>" alt="Profil Picture"></a>
            <p><?php echo $supervisor["nama_supervisor"];?></p>
        </div>
    </div>
    <div id="project-staf" class="isi-konten">
    <?php
    $accPost = showProject();
    while ($post = mysqli_fetch_assoc($accPost)):?>
    <div class="saved-post" data-post-id="<?= $post['id_postingan']; ?>">
        <div class="saved-media">
            <img src="<?= $post["media"];?>" alt="">
        </div>
        <div class="saved-infomation">
            <div class="caption">
                <p><?= $post["caption"];?></p>
                <p class="saved-on">Image . accept on <?= $post["waktu_terima"];?></p>
            </div>
            <div class="uploader">
                <img src="<?= $post["foto_profil_user"];?>" alt="">
                <p class="posted-by">Posted by <b><?= $post["nama_user"];?></b></p>
            </div>
            <div class="unsave">
                <button type="submit" class="unsave-button" name="unsavePost" onclick="projectDone(<?php echo $post['id_postingan'];?>)">Projek Selesai</button>
            </div>
        </div>
    </div>
    <?php endwhile;?>
</div>

<!-- Modal for Confirmation -->
<div id="confirmationModal" class="modal">
    <div class="modal-content">
        <span class="close-button" onclick="closeModal()">&times;</span>
        <p id="confirmationMessage"></p>
        <button id="confirmButton" onclick="confirmDone()" class="confirmAction">Confirm</button>
        <button onclick="closeModal()" class="cancelAction">Cancel</button>
    </div>
</div>

<script src="../js/sidebar.js"></script>
<script src="../js/stafAction.js"></script>
</body>
</html>
