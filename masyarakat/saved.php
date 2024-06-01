<?php
require '../php/functions.php';
if (!isset($_SESSION["NIK"])) {
    header("Location: ../loginMasyarakat.php");
    exit();
}else{
    $nik = $_SESSION["NIK"];
    $user = userLogin($nik);
}
if(isset($_POST["unsavePost"])){
    $idpost = $_POST["idpost"];
    unsavePostingan($idpost, $nik);
    unset($_POST);
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
    <title>Saved</title>
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
                <li>
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

   <!--CONTENT START-->
    <div class="konten">
        <div class="header-konten">
            <div class="page-name">
                <h2>Saved</h2>
            </div>
            <div class="user-login">
                <a href="profileUser.php">
                    <img src="<?= $user["foto_profil_user"];?>" alt="Profil Picture">
                </a>
                <p><?= $user["nama_user"];?></p>
            </div>
        </div>
        <div class="isi-konten">
            <?php
            $savedPost = userSaved($nik);
            while ($post = mysqli_fetch_assoc($savedPost)):?>
            <div class="saved-post">
                <div class="saved-media">
                    <img src="<?= $post["media"];?>" alt="">
                </div>
                <div class="saved-infomation">
                    <div class="caption">
                        <p><?= $post["caption"];?></p>
                        <p class="saved-on">Image . saved on <?= $post["waktu_disimpan"];?></p>
                    </div>
                    <div class="uploader">
                        <img src="<?= $post["foto_profil_user"];?>" alt="">
                        <p class="posted-by">Posted by <b><?= $post["nama_user"];?></b></p>
                    </div>
                    <div class="unsave">
                        <form action="" method="post">
                            <input type="hidden" name="idpost" value="<?= $post["id_postingan"];?>">
                            <button type="submit" class="unsave-button" name="unsavePost">Unsave</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php endwhile;?>
        </div>
    </div>
<!--CONTENT END-->

    <script src="../js/masyarakatValidation.js"></script>
    <script src="../js/sidebar.js"></script>
</body>
</html>
