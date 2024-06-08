<?php 
require '../php/functions.php';
if (!isset($_SESSION["NIK"])) {
    header("Location: ../loginMasyarakat.php");
    exit();
}else{
    $nik = $_SESSION["NIK"];
    $user = userLogin($nik);
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

    <title>Riwayat</title>
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
                            <i class='bx bx-bar-chart-alt-2 icon'></i>
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
                <h2>Riwayat</h2>
            </div>
            <div class="user-login">
                <a href="profileUser.php">
                    <img src="
                    <?= $user["foto_profil_user"];?>" alt="Profil Picture">
                </a>
                <p><?= $user["nama_user"];?></p>
            </div>
        </div>
        <div class="isi-konten" id="hist-post">
            <?php
            $histPost = findHistpost($nik);
            while ($post = mysqli_fetch_assoc($histPost)):?>
            <?php $saveornot = cekSave($post["id_postingan"], $nik) ? True : False;?>
            <div class="history-post">
                <div class="post-header">
                    <img src="<?= $post['foto_profil_user'];?>" alt="Profil Picture">
                    <div class="post-info">
                        <h3><?= $post['nama_user'];?></h3>
                        <p><?= $post['tgl_postingan'];?></p>
                    </div>
                </div>
                <div class="post-content">
                    <p class="caption"><?= $post['caption'];?></p>
                    <img src="<?= $post['media'];?>" alt="Gambar postingan">
                </div>
                <div class="post-actions">
                    <div class="left-post-action">
                        <button type="submit" class="comment-button" name="comment-button" onclick="popupcomment(<?php echo $post['id_postingan'];?>)"><i class='bx bx-comment'></i></button>
                        <button data-post-id="<?php echo $post['id_postingan']; ?>" name="savePost" class="<?php echo $saveornot ? 'saved' : 'save-button'; ?>" onclick="toggleSave(this, <?php echo $post['id_postingan']; ?>)">
                            <i class='<?php echo $saveornot ? 'bx bxs-bookmark' : 'bx bx-bookmark'; ?>'></i>
                        </button>
                    </div>
                    <div class="right-post-action">
                        <button type="button" class="btn del-btn" onclick="showDeleteModal(<?php echo $post['id_postingan'];?>)">
                            <i class='bx bx-trash icon'></i>
                        </button>
                    </div>
                </div>
                <div class="add-comment-form">
                    <input type="text" name="comment" class="comment" id="comment-<?php echo $post['id_postingan'];?>" placeholder="Tambahkan komentar...">
                    <button type="button" id="submitcomment" name="postComment" onclick="postComment(<?php echo $post['id_postingan'];?>)">Kirim</button>
                </div>
            <?php endwhile?>
        </div>
    </div>

    <div id="deleteModal" class="deleteModal">
        <div class="deleteModal-content">
            <span class="close" id="closeDelete">&times;</span>
            <h2>Delete Masyarakat</h2>
            <p>Are you sure you want to delete this Masyarakat?</p>
            <div>
                <button type="submit" id="deletePost" class="delete-selected">Delete</button>
                <button type="button" id="cancelDelete" class="cancel-delete-selected">Cancel</button>
            </div>
        </div>
    </div>
    <div id="commentPopup" class="popup"></div>
    <script src="../js/masyarakatValidation.js"></script>
    <script src="../js/sidebar.js"></script>
    <script src="../js/deletePost.js"></script>
</body>
</html>