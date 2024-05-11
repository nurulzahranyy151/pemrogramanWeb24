<?php require '../php/functions.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Website Title</title>
    <link rel="stylesheet" href="../css/pageAdminStyle.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="aplikasi">
                <img src="" alt="logo">
                <h1>ReCity</h1>
            </div>
            <div class="user">
                <p><?php echo $_SESSION["nama_admin"];?></p>
            </div>
        </div>
        <div class="isi">
            <div class="sidebar">
                <ul>
                    <li><a href="dashboardAdmin.php">Menu Statistik</a></li>
                    <li class="access-menu"><a href="#">Kelola Masyarakat</a></li>
                    <li><a href="dataGovernment.php">Kelola Supervisor</a></li>
                    <li><a href="#">Kelola Laporan</a></li>
                    <li><a href="#">Kelola Report</a></li>
                    <li><a href="../loginAdminandGov.php">Logout</a></li>
                    <li><a href="#">Ubah Mode</a></li>
                </ul>
            </div>
            <div class="konten">
                <h1>INI KONTEN</h1>
                <div class="search">
                    <input type="text" name="search-bar" class="search-bar" placeholder="Cari Masyarakat">
                </div>
                <h1>Data Masyarakat</h1>
                <table border ="1" cellpadding="10" cellspacing="0">
                    <tr class="head-table">
                        <th>Action</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Password</th>
                    </tr>
                    <?php 
                    $result = findMasyarakat();
                    while( $row = mysqli_fetch_assoc($result)):?>
                    <tr>
                        <td class="aksi">
                            <a href="">ubah</a> |
                            <a href="">hapus</>
                        </td>
                        <td><?= $row["NIK"];?></td>
                        <td><?= $row["nama_user"];?></td>
                        <td><?= $row["email_user"];?></td>
                        <td><?= $row["password_user"];?></td>
                    </tr>
                    <?php endwhile;?>
                </table>
            </div>
        </div>
        <div class="footer">
            <div class="copyright">Copyright &copy; 2024</div>
            <div class="contact">Contact: contact@example.com</div>
        </div>
    </div>
</body>
</html>
