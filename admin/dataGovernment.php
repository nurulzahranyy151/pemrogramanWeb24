<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    <link rel="stylesheet" href="../css/pageAdminStyle.css">
    
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <title>Dashboard</title>
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
                        <a href="#">
                            <i class='bx bx-bar-chart-alt-2 icon'></i>
                            <span class="text nav-text">Statistik Laporan</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="dataMasyarakat.php">
                            <i class='bx bx-user icon'></i>
                            <span class="text nav-text">Kelola Masyarakat</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="dataGovernment.php">
                            <i class='bx bx-user-circle icon'></i>
                            <span class="text nav-text">Kelola Supervisor</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="#">
                            <i class='bx bx-image icon'></i>
                            <span class="text nav-text">Kelola Laporan</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="#">
                            <i class='bx bx-error icon'></i>
                            <span class="text nav-text">Kelola Report</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="bottom-content">
                <li class="">
                    <a href="../loginAdminandGov.php">
                        <i class='bx bx-log-out icon'></i>
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
                <h2>Kelola Supervisor</h2>
            </div>
            <div class="user-login">
                <img src="../img/coba.jpeg" alt="Profil Picture">
                <p><?php echo $_SESSION["nama_admin"];?></p>
            </div>
        </div>
        <div class="isi-konten">
            <div class="header-data">
                <h3>Data Supervisor</h3>
            </div>
            <div class="isi-table">
                <div class="search">
                    <input type="text" name="search-bar" class="search-bar" placeholder="Cari Masyarakat">
                    <button type="submit"><i class='bx bx-search icon'></i></button>
                </div>
                <table>
                    <tr class="head-table">
                        <th>No</th>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Action</th>
                    </tr>
                    <?php 
                    $count = 1;
                    $result = findGov();
                    while( $row = mysqli_fetch_assoc($result)):?> -->
                    <tr class="isi-data">
                        <td>1</td>
                        <td><?= $row["id_supervisor"];?></td>
                        <td><?= $row["nama_supervisor"];?></td>
                        <td><?= $row["email_supervisor"];?></td>
                        <td><?= $row["password_supervisor"];?></td>
                        <td class="aksi">
                            <a href="">ubah</a>
                            <a href="">hapus</a>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td><?= $row["id_supervisor"];?></td>
                        <td><?= $row["nama_supervisor"];?></td>
                        <td><?= $row["email_supervisor"];?></td>
                        <td><?= $row["password_supervisor"];?></td>
                        <td class="aksi">
                            <a href="">ubah</a>
                            <a href="">hapus</a>
                        </td>
                    </tr>
                    <?php 
                        $count++;
                        endwhile;?>
                </table>
            </div>
        </div>
    </div>

    <script src="../js/masyarakatValidation.js"></script>
    <script src="../js/sidebar.js"></script>
    <script src="../js/statistik.js"></script>
</body>
</html>
