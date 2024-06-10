<?php 
require '../php/functions.php';
if (!isset($_SESSION["id_admin"])) {
    header("Location: ../loginAdmin.php");
    exit();
}else{
    $id_admin = $_SESSION["id_admin"];
    $adminData = adminLogin($id_admin);

}

if(isset($_POST['saveChange'])){
    
    kelolaMasyarakat($_POST);
    header("Location: dataMasyarakat.php");
}

if(isset($_POST['deleteUser'])){
    hapusUser($_POST['deleteNik']);
    header("Location: dataMasyarakat.php");
}

$searchUser = findMasyarakat();
$user = [];
$SumDataEachPage =  5;
$SumData = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM user"));
$SumPage = ceil($SumData/$SumDataEachPage);
$activePage = (isset($_GET["halaman"])) ?  $_GET["halaman"] : 1;
$DataUserStart = ($SumDataEachPage * $activePage) - $SumDataEachPage;
while($row = mysqli_fetch_assoc($searchUser)){
    $user[] = $row;
}
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

    <title>Kelola Masyarakat</title>
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
                            <span class="text nav-text">Kelola Report</span>
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
                <h2>Kelola Masyarakat</h2>
            </div>
            <div class="user-login">
                <p><?php echo $adminData["nama_admin"];?></p>
            </div>
        </div>
        <div class="isi-konten">
            <div class="header-data">
                <h3>Data Masyarakat</h3>
            </div>
            <div id="editModal" class="editModal" style="display: none"></div>
            
            <div id="data-masyarakat" class="isi-table">
                <div class="search-add">
                    <div class="search">
                        <input type="text" id="search-keyword-masyarakat" name="search-bar" class="search-bar" placeholder="Cari Masyarakat">
                        <button><i class='bx bx-search icon'></i></button>
                    </div>
                </div>
                <div id="table-data-masyarakat" class="table-masyarakat">
                    <table>
                        <tr class="head-table">
                            <th>No</th>
                            <th>Foto</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Action</th>
                        </tr>
                    
                        <?php 
                        $count = $DataUserStart + 1;
                        $result = paginationMasyarakat($DataUserStart, $SumDataEachPage);
                        while ($row = mysqli_fetch_assoc($result)):
                        ?>
                        <tr class="isi-data">
                            <td><?= $count;?></td>
                            <td><img src="<?= $row["foto_profil_user"];?>" alt="Profil Picture" class="foto-masyarakat"></td>
                            <td><?= $row["NIK"];?></td>
                            <td><?= $row["nama_user"];?></td>
                            <td><?= $row["email_user"];?></td>
                            <td><?= $row["password_user"];?></td>
                            <td>
                                <div class="button-container">
                                    <button class="btn edit-btn" name="editUser" onclick="editMasyarakat(<?php echo $row['NIK'];?>)">
                                        <i class='bx bx-edit icon'></i>
                                        <span>Ubah</span>
                                    </button>
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
                    <br>
                    <!--Pagination START-->
                    <div class="pagination">
                        <ul>
                            <?php if($activePage > 1): ?>
                                <li><a href="?page=1"><<</a></li>
                                <li><a href="?page=<?php echo $activePage - 1; ?>"><</a></li>
                            <?php endif; ?>
                            <?php for($i = 1; $i <= $SumPage; $i++): ?>
                                <?php if($i == $activePage): ?>
                                    <li><a href="?page=<?php echo $i; ?>" class="active"><?php echo $i; ?></a></li>
                                <?php else: ?>
                                    <li><a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                <?php endif; ?>
                            <?php endfor; ?>
                            <?php if($activePage < $SumPage): ?>
                                <li><a href="?page=<?php echo $activePage + 1; ?>">></a></li>
                                <li><a href="?page=<?php echo $SumPage; ?>">>></a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <!--Pagination END-->
                </div>  
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div id="deleteModal" class="deleteModal">
        <div class="deleteModal-content">
            <span class="close" id="closeDelete">&times;</span>
            <h2>Hapus Masyarakat</h2>
            <p>Apakah Anda yakin ingin menghapus data ini?</p>
            <div>
                <button type="submit" id="deleteMasyarakat" class="delete-selected">Delete</button>
                <button type="button" id="cancelDelete" class="cancel-delete-selected">Cancel</button>
            </div>
        </div>
    </div>
    <script src="../js/sidebar.js"></script>
    <script src="../js/modalmasyarakat.js"></script>

</body>
</html>
