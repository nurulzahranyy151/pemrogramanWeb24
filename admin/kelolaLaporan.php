<?php 
require '../php/functions.php';
if (!isset($_SESSION["id_admin"])) {
    header("Location: ../loginAdmin.php");
    exit();
}else{
    $id_admin = $_SESSION["id_admin"];
    $adminData = adminLogin($id_admin);

}

if(isset($_POST['deleteUser'])){
    hapusUser($_POST['deleteNik']);
    header("Location: dataMasyarakat.php");
}
//$searchReport = findReported();
//$report = [];
//$SumDataEachPage =  5;
//$SumData = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM report"));
//$SumPage = ceil($SumData/$SumDataEachPage);
//$activePage = (isset($_GET["halaman"])) ?  $_GET["halaman"] : 1;
//$DataReportStart = ($SumDataEachPage * $activePage) - $SumDataEachPage;
//while($row = mysqli_fetch_assoc($searchReport)){
//    $report[] = $row;
//}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    <link rel="stylesheet" href="../css/pageAdminStyle.css">
    
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <title>Kelola Laporan</title>
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
                        <a href="StatisticAdmin.php">
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
                        <a href="kelolaLaporan.php">
                            <i class='bx bx-error icon'></i>
                            <span class="text nav-text">Kelola Laporan</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="bottom-content">
                <li class="">
                    <a href="../php/logout-proses.php">
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
                <h2>Kelola Laporan</h2>
            </div>
            <div class="user-login">
                <p><?php echo $adminData["nama_admin"];?></p>
            </div>
        </div>
        <div class="isi-konten">
            <div class="header-data">
                <h3>Data Laporan Postingan</h3>
            </div>
            <div id="data-masyarakat" class="isi-table">
                <div class="search-add">
                    <div class="search">
                        <input type="text" id="search-keyword-masyarakat" name="search-bar" class="search-bar" placeholder="Cari Laporan">
                        <button><i class='bx bx-search icon'></i></button>
                    </div>
                </div>
                <div id="table-kelola-report" class="table-kelola-report">
                    <table>
                        <tr class="head-table">
                            <th>No</th>
                            <th>NIK</th>
                            <th>Caption</th>
                            <th>Media</th>
                            <th>Kategori</th>
                            <th>Action</th>
                        </tr>
                        <?php 
                        $count = 1;
                        $result = findReported();
                        while( $row = mysqli_fetch_assoc($result)):?>
                        <tr class="isi-data">
                            <td><?= $count;?></td>
                            <td><?= $row["NIK"];?></td>
                            <td id="caption-reported"><?= $row["caption"];?></td>
                            <td id = "media-reported">
                                <img src="<?= $row["media"];?>" alt="Media">
                            </td>
                            <td><?= $row["kategori"];?></td>
                            <td>    
                                <div class="button-container">
                                    <button type="button" class="btn del-btn" onclick="showDeleteModal(<?php echo $row['NIK'];?>)">
                                        <i class='bx bx-trash icon'></i>
                                        <span>Hapus</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php 
                            $count++;
                            endwhile;?>
                    </table>
                </div>  
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div id="deleteModal" class="deleteModal">
        <div class="deleteModal-content">
            <span class="close" id="closeDelete" onclick="closeDelete()">&times;</span>
            <h2>Hapus Postingan</h2>
            <p>Apakah Anda yakin ingin menghapus Postingan yang dilaporkan?</p>
            <div>
                <button type="submit" id="deletePost" class="delete-selected" onclick="deletePost()">Delete</button>
                <button type="button" id="cancelDelete" class="cancel-delete-selected" onclick="closeDelete()">Cancel</button>
            </div>
        </div>
    </div>
    <script src="../js/sidebar.js"></script>
    <script src="../js/modalmasyarakat.js"></script>
</body>
</html>
