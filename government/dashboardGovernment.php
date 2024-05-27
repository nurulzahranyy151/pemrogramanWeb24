<?php 
require '../php/functions.php';
if (!isset($_SESSION["id_supervisor"])) {
    header("Location: ../loginMasyarakat.php");
    exit();
}
$conn = mysqli_connect("localhost" , "root", "", "dbrecity");
$idsup = $_SESSION["id_supervisor"];
$query = mysqli_query($conn, "SELECT * FROM supervisor WHERE id_supervisor = $idsup");
$user = mysqli_fetch_assoc($query);
$_SESSION["nama_supervisor"] = $user["nama_supervisor"];
$_SESSION["foto_profil_staff"] = $user["foto_profil_staff"];


if(isset($_POST["submit-report"])){
    uploadPostingan($_POST, $_FILES);
}


?>
<!
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/pageMasyarakat.css">
    
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>

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
                    <img src="
                    <?= $_SESSION["foto_profil_staff"];?>" alt="Profil Picture">
                </a>
                <p><?= $_SESSION["nama_supervisor"];?></p>
            </div>
        </div>
        <div class="isi-konten">
            <div class="fyp">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="make-report">
                        <div class="header-report">
                            <div class="reporter">
                                <img src="<?= $_SESSION["foto_profil_staff"];?>" alt="Profil Picture">
                                <h5><?= $_SESSION["nama_supervisor"];?></h5>
                            </div>
                            <div class="caption-media">
                                <div class="caption">
                                    <textarea class="input-caption" name="caption" placeholder="Buat Postingan "></textarea>
                                </div>
                                <div class="address-post">
                                <textarea class="input-address" name="address" placeholder="Masukkan alamat laporan..."></textarea>
                                </div>
                                <div class="media-preview">
                                </div>
                            </div>
                        </div>
                        <div class="footer-report">
                            <div class="atribut">
                                <li><i class='bx bx-image-add icon'></i></i></li>
                                <li><i class='bx bx-smile icon'></i></li>
                                <li><i class='bx bx-map icon'></i></li>
                            </div>
                            <div class="submit-report">
                                <button type="submit" id="submit-report" name="submit-report">Post</button>
                            </div>
                        </div>
                        <input type="file" id="imageUpload"  name="media" style="display: none;" accept="image/*">
                    </div>
                </form>
                <?php 
                $postingan = showAllpostingan();
                while ($row = mysqli_fetch_assoc($postingan)):?>
                    <div class="post">
                        <div class="post-header">
                            <img src="<?= $row['foto_profil_staff'];?>" alt="Profil Picture">
                            <div class="post-info">
                                <h3><?= $row['nama_supervisor'];?></h3>
                                <p><?= $row['tgl_laporan'];?></p>
                            </div>
                        </div>
                        <div class="post-content">
                            <p class="caption"><?= $row['caption'];?></p>
                            <img src="<?= $row['media'];?>" alt="Gambar postingan">
                        </div>
                        <div class="post-actions">
                            <div class="left-post-action">
                                <button class="like-button" onclick="toggleLike(this)">
                                    <i class='bx bx-heart'></i>Beri Tanggapan
                                </button>
                            </div>
                            <div class="left-post-action">
                                <button class="save-button" onclick="toggleSave(this)">
                                    <i class='bx bx-bookmark'></i>Terima
                            </div>
                            <div class="right-post-action">
                                <button class="save-button" onclick="toggleSave(this)">
                                    <i class='bx bx-bookmark'></i>Tolak
                            </div>
                            <div class="right-post-action">
                                <button class="save-button" onclick="toggleSave(this)">
                                    <i class='bx bx-bookmark'></i>Cetak
                            </div>
                        </div>
                        <form action="#" method="post" class="add-comment-form">
                            <input type="text" name="comment" id="comment" placeholder="Tambahkan komentar..." onchange="validateComment()">
                            <button type="submit" id="submit-comment" style="display: none;">Kirim</button>
                        </form>
                    </div>
                    <?php endwhile;?>
            </div>
            <div class="trend">
                <div class="trend-content">
                    <div class="header-trend">
                        <img src="<?= $_SESSION["foto_profil_staff"];?>" alt="">
                        <h4>Accepted Post</h4>
                    </div>
                    <hr>
                    <?php 
                    $trending = trendingpost();
                    while ($trend = mysqli_fetch_assoc($trending)) {
                        ?>
                        <div class="accepted-post">
                            <a href="#">
                                <img src="<?= $trend['media'];?>" alt="">
                            </a>
                            <div class="accepted-post-atr">
                                <h5><?= $trend['tgl_laporan'];?>03-11-2024</h5>
                                <p><?= $trend['alamat_laporan'];?>Jalan Prabu rangksari karang parwa abiantubuh baru</p>
                            </div>
                        </div>
                        <?php
                    }?>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
<div id="commentPopup" class="popup">
    <div class="popup-content">
        <span class="close">&times;</span>
        <div class="popup-left">
            <img src="../img/default.jpeg" alt="Post Image">
        </div>
        <div class="popup-right">
            <div class="post-header">
                <img src="../img/coba.jpeg" alt="Profile Picture" class="profile-picture-pop-up">
                <div class="profile-info">
                    <h3>Username</h3>
                    <p>Posted on date</p>
                </div>
            </div>
            <div class="previous-comments">
                <div class="comments">
                    <div class="image-user-comment">
                        <img src="../img/coba.jpeg" alt="">
                    </div>
                    <div class="comments-user">
                        <h4>Lulu</h4>
                        <p>keren bang</p>
                    </div>
                </div>
                <div class="comments">
                    <div class="image-user-comment">
                        <img src="../img/coba.jpeg" alt="">
                    </div>
                    <div class="comments-user">
                        <h4>Lulu</h4>
                        <p>keren bang</p>
                    </div>
                </div>
            </div>
            <div class="post-actions">
                <div class="left-post-action">
                    <button class="like-button" onclick="toggleLike(this)">
                        <i class='bx bx-heart'></i>
                    </button>
                    <button class="comment-button" ><label for="comment-pop">
                    <i class='bx bx-comment'></i>
                    </label></button>
                </div>
                <div class="right-post-action">
                    <button class="save-button" onclick="toggleSave(this)">
                        <i class='bx bx-bookmark'></i>
                    </button>
                </div>
            </div>
            <form action="#" method="post" class="add-comment-form">
                <input type="text" name="comment" id="comment-pop" placeholder="Tambahkan komentar...">
                <button type="submit" id="submit-comment">Kirim</button>
            </form>
        </div>
    </div>
</div>
<script src="../js/loginValidation.js"></script>
<script src="../js/sidebar.js"></script>
</body>
</html>