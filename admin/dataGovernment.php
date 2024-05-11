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
                <p><?php echo $_SESSION["nama_supervisor"];?></p>
            </div>
        </div>
        <div class="isi">
            <div class="sidebar">
                <ul>
                    <li><a href="dashboardAdmin.php">Statistik Laporan</a></li>
                    <li><a href="dataMasyarakat.php">Kelola Masyarakat</a></li>
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
                    <input type="text" name="search-bar" class="search-bar" placeholder="Cari Supervisor">
                </div>
                <h1>Data Supervisor</h1>
                <table border ="1" cellpadding="10" cellspacing="0">
                    <tr>
                        <th>Action</th>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Password</th>
                    </tr>
                    <?php 
                    $result = findGov();
                    while( $row = mysqli_fetch_assoc($result)):?>
                    <tr>
                        <td>
                            <a href="">ubah</a> |
                            <a href="">hapus</>
                        </td>
                        <td><?= $row["id_supervisor"];?></td>
                        <td><?= $row["nama_supervisor"];?></td>
                        <td><?= $row["email_supervisor"];?></td>
                        <td><?= $row["password_supervisor"];?></td>
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
