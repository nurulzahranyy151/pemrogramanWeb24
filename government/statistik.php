<?php 
require '../php/functions.php';
if (!isset($_SESSION["id_supervisor"])) {
    header("Location: ../loginAdminandGov.php");
    exit();
} else {
    $id_supervisor = $_SESSION["id_supervisor"];
    $supervisor = stafLogin($id_supervisor);
    $currentYear = date("Y");
    $sumStatus = findSumStatusPostingan();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/pageAdminStyle.css">
    <link rel="stylesheet" href="../css/statistikStyle.css">
    
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-rounded-bar@2.0.0"></script> 

    <title>Statistik</title>
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
                    <a href="projectGovernment.php">
                        <i class='bx bx-task icon' ></i>
                        <span class="text nav-text">Projek</span>
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
            <h2>Statistik</h2>
        </div>
        <div class="user-login">
            <a href="profilStaff.php"><img src="<?php echo $supervisor['foto_profil_staff'];?>" alt="Profil Picture"></a>
            <p><?php echo $supervisor["nama_supervisor"];?></p>
        </div>
    </div>
    <div class="isi-konten">
        <div class="box-container">
            <div class="container">
                <div class="year-selection">
                    <label for="tahun">Pilih Tahun: </label>
                    <select name="tahun" id="tahun">
                        <?php
                        $currentYear = date("Y");
                        for ($year = 2020; $year <= $currentYear; $year++) {
                            $selected = ($year == $currentYear) ? 'selected' : '';
                            echo "<option value='$year' $selected>$year</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="chart">
                    <canvas class="chart-monthly" id="monthlyChart"></canvas>
                </div>
            </div>
        <div class="laporan-container">
            <div class="box box-diterima">
                <h5>Diterima</h5>
                <p><?php echo $sumStatus['diterima']; ?> Laporan</p>
                <p><?php echo date("d F Y"); ?></p>
            </div>
            <div class="box box-menunggu">
                <h5>Menunggu</h5>
                <p><?php echo $sumStatus['ditunggu']; ?> Laporan</p>
                <p><?php echo date("d F Y"); ?></p>
            </div>
            <div class="box box-total">
                <h5>Total Laporan</h5>
                <p><?php echo $sumStatus['total']; ?> Laporan</p>
                <p><?php echo date("d F Y"); ?></p>
            </div>
        </div>
    </div>
</div>
<script src="../js/sidebar.js"></script>
<script src="../js/showStatistic.js"></script>
</body>
</html>
