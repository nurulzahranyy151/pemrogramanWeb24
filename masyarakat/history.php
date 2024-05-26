<?php session_start() ?>
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
                        <a href="#">
                            <i class='bx bx-home-alt icon' ></i>
                            <span class="text nav-text">Beranda</span>
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
                <h2>Riwayat</h2>
            </div>
            <div class="user-login">
                <a href="profileUser.php">
                    <img src="
                    <?= $_SESSION["foto_profile_user"];?>" alt="Profil Picture">
                </a>
                <p><?= $_SESSION["nama_user"];?></p>
            </div>
        </div>
        <div class="isi-konten">
            <?php for ($i = 0; $i < 4; $i++) :;?>
            <div class="history-post">
                <div class="post-header">
                    <img src="gambar_pengguna.jpg" alt="Profil Picture">
                    <div class="post-info">
                        <h3>Nama Pengguna</h3>
                        <p>Waktu Posting</p>
                    </div>
                </div>
                <div class="post-content">
                    <p class="caption">Ini caption</p>
                    <img src="../img/coba.jpeg" alt="ini gambar">
                </div>
                <div class="post-actions">
                    <div class="left-actions">
                        <button><i class='bx bxs-star icon'></i></button>
                        <button><i class='bx bxs-comment icon'></i></button>
                        <button><i class='bx bxs-share icon'></i></button>
                    </div>
                    <div class="center-action">
                        <p><i class='bx bx-check-square icon'></i>Diterima</p>
                    </div>
                    <div class="right-action">
                        <button>Hapus <i class='bx bx-trash icon'></i></button>
                    </div>
                </div>
                <form action="#" method="post" class="add-comment-form">
                    <input type="text" name="comment" id="comment" placeholder="Tambahkan komentar...">
                    <button type="submit" id="submit-comment" style="display: none;">Kirim</button>
                </form>
            </div>
            <?php endfor?>
        </div>
    </div>
</div>
<script src="../js/masyarakatValidation.js"></script>
<script src="../js/sidebar.js"></script>
</body>
</html>