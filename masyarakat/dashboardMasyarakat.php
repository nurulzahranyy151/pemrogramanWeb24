<?php session_start() ?>
<!DOCTYPE html>
<html>
<head>
    <title>Website Title</title>
    <link rel="stylesheet" href="../css/pageMasyarakat.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="aplikasi">
                <img src="" alt="logo">
                <h1>ReCity</h1>
            </div>
            <div class="search">
                <input type="text" name="search-bar" class="search-bar" placeholder="Cari Laporan">
            </div>
            <div class="user">
                <p><?php echo $_SESSION["nama_user"];?></p>
            </div>
        </div>
        <div class="isi">
            <div class="sidebar">
                <ul>
                    <li class="access-menu"><a href="#">Dashboard</a></li>
                    <li><a href="#">Saved</a></li>
                    <li><a href="#">History</a></li>
                    <li><a href="#">Profile</a></li>
                    <li><a href="#">Statistic</a></li>
                    <li><a href="#">Setting</a></li>
                    <li><a href="../loginMasyarakat.php">Logout</a></li>
                    <li><a href="#">Ubah Mode</a></li>
                </ul>
            </div>
            <div class="konten">
                <div class="fyp">
                    <?php for ($i = 0; $i < 4; $i++) :;?>
                    <div class="post">
                        <div class="post-header">
                            <img src="gambar_pengguna.jpg" alt="Profil Picture">
                            <div class="post-info">
                                <h3>Nama Pengguna</h3>
                                <p>Waktu Posting</p>
                            </div>
                        </div>
                        <div class="post-content">
                            <img src="th.jpeg" alt="">
                        </div>
                        <div class="post-actions">
                            <button>Like</button>
                            <button>Comment</button>
                            <button>Share</button>
                        </div>
                        <form action="#" method="post" class="add-comment-form">
                            <input type="text" name="comment" id="comment" placeholder="Tambahkan komentar...">
                            <button type="submit" id="submit-comment" style="display: none;">Kirim</button>
                        </form>
                    </div>
                    <?php endfor?>
                </div>
                <div class="trend">
                    <h1>trending</h1>
                </div>
            </div>
        </div>
    </div>
    <script src="../js/masyarakatValidation.js"></script>
</body>
</html>
