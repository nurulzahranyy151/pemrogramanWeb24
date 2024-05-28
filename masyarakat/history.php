<?php 
require '../php/functions.php';
if (!isset($_SESSION["NIK"])) {
    header("Location: ../loginMasyarakat.php");
    exit();
}else{
    $nik = $_SESSION["NIK"];
    $user = userLogin($nik);
}

if(isset($_POST["comment-button"])){
    global $conn;
    $showPopupcomment = true;
    $idcomment = $_POST["idpost-comment"];
    $saveornotpopup = cekSave($idcomment, $nik) ? True : False;
    $commented = popupPost($idcomment);
    unset($_POST);
}else{
    $showPopupcomment = false;
}

if(isset($_POST["deletePost"])){
    $idpost = $_POST["deleteId"];
    deletePostingan($idpost);
    unset($_POST);
}


if(isset($_POST["savePost"])){
    $idpost = $_POST["idpost"];
    if($_POST["ceksave"] == "not"){
        savePostingan($idpost, $nik);
    } else {
        unsavePostingan($idpost, $nik);
    }
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
                <li class="search-box">
                    <i class='bx bx-search icon'></i>
                    <input type="text" placeholder="Search...">
                </li>
                <ul class="menu-links">
                    <li class="nav-link">
                        <a href="dashboard.php">
                            <i class='bx bx-home-alt icon' ></i>
                            <span class="text nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="saved.php">
                            <i class='bx bx-bookmark icon'></i>
                            <span class="text nav-text">Saved</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="history.php">
                            <i class='bx bx-history icon'></i>
                            <span class="text nav-text">History</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="">
                            <i class='bx bx-pie-chart-alt icon' ></i>
                            <span class="text nav-text">Statistic</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="">
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
        <div class="isi-konten">
            <?php
            $histPost = findHistpost($nik);
            while ($post = mysqli_fetch_assoc($histPost)):?>
            <?php $saveornot = cekSave($post["id_postingan"], $nik) ? True : False;?>
            <div class="history-post">
                <div class="post-header">
                    <img src="<?= $user["foto_profil_user"];?>" alt="Profil Picture">
                    <div class="post-info">
                        <h3><?= $user["nama_user"];?></h3>
                        <p><?= $post["tgl_postingan"];?></p>
                    </div>
                </div>
                <div class="post-content">
                    <p class="<?= $post["caption"];?>">Ini caption</p>
                    <img src="<?= $post["media"];?>" alt="ini gambar">
                </div>
                <div class="post-actions">
                    <div class="left-actions">
                        <form action="" method="post">
                            <input type="hidden" name="idpost-comment" value="<?= $post["id_postingan"];?>">
                            <button type="submit" class="comment-button" name="comment-button"><i class='bx bx-comment'></i></button>
                        </form>
                        <form action="" method="post">
                            <input type="hidden" name="ceksave" value="<?php echo $saveornot ? 'saved' : 'not';?>">
                            <input type="hidden" name="idpost" value="<?= $post["id_postingan"];?>">
                            <input type="hidden" name="nik" value="<?= $nik;?>">
                            <button type="submit" name="savePost" class="<?php echo $saveornot ? 'saved' : 'save-button';?>" onclick="toggleSave(this)">
                                <i class='<?php echo $saveornot ? 'bx bxs-bookmark' : 'bx bx-bookmark';?>' style=""></i>
                            </button>
                        </form>
                    </div>
                    <div class="center-action">
                        <button><i class='bx bx-check-square icon'></i></button>
                    </div>
                    <div class="right-action">
                        <button type="button" class="btn del-btn" onclick="showDelete(<?php echo $post['id_postingan'];?>)">
                            <i class='bx bx-trash icon'></i>
                        </button>
                    </div>
                </div>
                <form action="#" method="post" class="add-comment-form">
                    <input type="text" name="comment" id="comment" placeholder="Tambahkan komentar...">
                    <button type="submit" id="submit-comment" style="display: none;">Kirim</button>
                </form>
            </div>
            <?php endwhile?>
        </div>
    </div>

    <div id="deleteModal" class="deleteModal">
        <div class="deleteModal-content">
            <span class="closeDelete" id="closeDelete" onclick="closeDelete()">&times;</span>
            <h2>Delete Supervisor</h2>
            <p>Are you sure you want to delete this supervisor?</p>
            <form action="" id="deleteForm" method="post">
                <input type="hidden" id="deleteId" name="deleteId">
                <button type="submit" name="deletePost">Yes, Delete</button>
                <button type="button" id="cancelDelete" onclick="closeDelete()">Cancel</button>
            </form>
        </div>
    </div>

    <div id="commentPopup" class="popup" style="display: <?php echo $showPopupcomment ? 'flex' : 'none'; ?>">
        <div class="popup-content">
            <span class="close">&times;</span>
            <div class="popup-left">
                <img src="<?= $commented["media"];?>" alt="Post Image">
            </div>
            <div class="popup-right">
                <div class="post-header">
                    <img src="<?= $commented["foto_profil_user"];?>" alt="Profile Picture" class="profile-picture-pop-up">
                    <div class="profile-info">
                        <h3><?= $commented["nama_user"];?></h3>
                        <p><?= $commented["tgl_postingan"];?></p>
                    </div>
                </div>
                <div class="previous-comments">
                    <div class="comments">
                        <?php if($commented["caption"] != ""):?>
                        <div class="image-user-comment">
                            <img src="<?= $commented["foto_profil_user"];?>" alt="">
                        </div>
                        <div class="comments-user">
                            <h4><?= $commented["nama_user"];?></h4>
                            <p><?= $commented["caption"];?></p>
                        </div>
                        <?php endif;?>
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
                        <button class="comment-button" ><label for="comment-pop">
                        <i class='bx bx-comment'></i>
                        </label></button>
                    </div>
                    <div class="right-post-action">
                        <form action="" method="post">
                            <input type="hidden" name="ceksave" value="<?php echo $saveornotpopup ? 'saved' : 'not';?>">
                            <input type="hidden" name="idpost" value="<?= $idcomment;?>">
                            <input type="hidden" name="nik" value="<?= $nik;?>">
                            <button type="submit" name="savePost" class="<?php echo $saveornot ? 'saved' : 'save-button';?>" onclick="toggleSave(this)">
                                <i class='<?php echo $saveornot ? 'bx bxs-bookmark' : 'bx bx-bookmark';?>' style=""></i>
                            </button>
                        </form>
                    </div>
                </div>
                <form action="#" method="post" class="add-comment-form">
                    <input type="text" name="comment" id="comment-pop" placeholder="Tambahkan komentar...">
                    <button type="submit" id="submit-comment">Kirim</button>
                </form>
            </div>
        </div>
    </div>
    <script src="../js/masyarakatValidation.js"></script>
    <script src="../js/sidebar.js"></script>
</body>
</html>