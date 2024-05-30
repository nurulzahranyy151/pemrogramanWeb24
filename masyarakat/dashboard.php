<?php 
require '../php/functions.php';
if (!isset($_SESSION["NIK"])) {
    header("Location: ../loginMasyarakat.php");
    exit();
}else{
    $nik = $_SESSION["NIK"];
    $user = userLogin($nik);
}

if(isset($_POST["submit-report"])){
    if($_FILES["media"]["error"] == 4){
        $mediacek = true;
    } else {
        $mediacek = false;
        uploadPostingan($_POST, $_FILES);
        header("Location: dashboard.php");
    }
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
    <title>Dashboard</title>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
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
                        <a href="#">
                            <i class='bx bx-bar-chart-alt-2 icon'></i>
                            <span class="text nav-text">Statistik</span>
                        </a>
                    </li>

                </ul>
            </div>

            <div class="bottom-content">
                <li class="">
                    <a href="../php/logout-proses.php">
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
                <a href="profileUser.php">
                    <img src="
                    <?= $user["foto_profil_user"];?>" alt="Profil Picture">
                </a>
                <p><?= $user["nama_user"];?></p>
            </div>
        </div>
        <div class="isi-konten-dashboard">
            <div class="fyp">
                <form action="" method="post" enctype="multipart/form-data" class="make-report">
                    <div class="header-report">
                        <div class="reporter">
                            <img src="<?= $user["foto_profil_user"];?>" alt="Profil Picture">
                        </div>
                        <div class="caption-media">
                            <div class="caption">
                                <textarea class="input-caption" name="caption" placeholder="Laporkan keluhan anda di sini..."></textarea>
                            </div>
                            <div class="address-post">
                            <textarea class="input-address" name="address" placeholder="Masukkan alamat postingan..."></textarea>
                            </div>
                            <div class="media-preview">
                            </div>
                        </div>
                    </div>
                    <div class="footer-report">
                        <div class="atribut">
                            <i class='bx bx-image-add icon' onclick="chooseFile()"></i>
                        </div>
                        <?php if(isset($mediacek) && $mediacek == true){
                            echo "<p style='color: red;, font-size: 12px;'>Gambar tidak boleh kosong</p>";
                        }
                        ?>
                        <div class="submit-report">
                            <button type="submit" id="submit-report" name="submit-report">Post</button>
                        </div>
                    </div>
                    <input type="file" id="imageUpload"  name="media" style="display: none;" accept="image/*" >
                </form>
                <?php 
                $postingan = showAllpostingan();
                while ($row = mysqli_fetch_assoc($postingan)):?>
                <?php $saveornot = cekSave($row["id_postingan"], $nik) ? True : False;?>
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
                            <button type="submit" class="comment-button" name="comment-button" onclick="popupcomment(<?php echo $row['id_postingan'];?>)"><i class='bx bx-comment'></i></button>
                        </div>
                        <div class="right-post-action">
                            <button data-post-id="<?php echo $row['id_postingan']; ?>" name="savePost" class="<?php echo $saveornot ? 'saved' : 'save-button'; ?>" onclick="toggleSave(this, <?php echo $row['id_postingan']; ?>)">
                                <i class='<?php echo $saveornot ? 'bx bxs-bookmark' : 'bx bx-bookmark'; ?>'></i>
                            </button>
                        </div>
                    </div>
                    <div class="add-comment-form">
                        <input type="text" name="comment" class="comment" id="comment-<?php echo $row['id_postingan'];?>" placeholder="Tambahkan komentar...">
                        <button type="button" id="submitcomment" name="postComment" onclick="postComment(<?php echo $row['id_postingan'];?>)">Kirim</button>
                    </div>
                </div>
                <?php endwhile;?>
            </div>
            <div class="trend">
                <div class="trend-content">
                    <div class="header-trend">
                        <img src="<?= $user["foto_profil_user"];?>" alt="">
                        <h4>Accepted Post</h4>
                    </div>
                    <hr>
                    <?php 
                    $trending = trendingpost();
                    while ($trend = mysqli_fetch_assoc($trending)):?>
                        <div class="accepted-post">
                            <a href="#">
                                <img src="<?= $trend['media'];?>" alt="">
                            </a>
                            <div class="accepted-post-atr">
                                <h5><?= $trend['tgl_postingan'];?></h5>
                                <p><?= $trend['alamat_postingan'];?></p>
                            </div>
                        </div>
                        <?php endwhile?>
                </div>
            </div>
        </div>
    </div>
    <div id="commentPopup" class="popup"></div>
    <script src="../js/masyarakatValidation.js"></script>
    <script src="../js/sidebar.js"></script>
</body>
</html>