<?php 
require '../php/functions.php';

if(!isset($_SESSION["id_admin"])){
    header("Location: ../loginAdminandGov.php");
    exit;
}else{
    $id_admin = $_SESSION["id_admin"];
    $adminData = adminLogin($id_admin);
}


if(isset($_POST["submitChange"])){
    editStaf($_POST, $_FILES);
    header("Location: dataGovernment.php");
}

if(isset($_POST["addName"])){
    addStaf($_POST, $_FILES);
    header("Location: dataGovernment.php");
}

$stafs = findGov();
$perpage = 5;
$dataStaf = [];
while($row = mysqli_fetch_assoc($stafs)){
    $dataStaf[] = $row;
}
$jumlahStaf = count($dataStaf);
$jumlahPage = ceil($jumlahStaf/$perpage);
$activePage = (isset($_GET["page"])) ? $_GET["page"] : 1;
$startPage = ($perpage * $activePage) - $perpage;

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
    <title>Kelola Supervisor</title>
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
                        <a href="statisticAdmin.php">
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
                <p><?php echo $adminData["nama_admin"];?></p>
            </div>
        </div>
        <div class="isi-konten">
            <div class="header-data">
                <h3>Data Supervisor</h3>
            </div>
            <div id="editModal" class="editModal">
                
            </div>
            <div id="data-staf" class="isi-table">
                <div class="search-add">
                    <div class="search">
                        <input type="text" id="search-keyword" name="search-bar" class="search-bar" placeholder="Cari Staf">
                        <button type="submit"><i class='bx bx-search icon'></i></button>
                    </div>
                    <button class="add-data" type="button" id="openAddModal">
                        <span>Tambah Supervisor</span>
                        <i class='bx bx-plus-circle'></i>
                    </button>
                </div>
                <div id="table-data-staf" class="table-staf">
                    <table>
                        <tr class="head-table">
                            <th>No</th>
                            <th>Foto</th>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Action</th>
                        </tr>
                        <?php 
                        $count = $startPage + 1;
                        $result = paginationGov($startPage, $perpage);
                        while($row = mysqli_fetch_assoc($result)): ?>
                        <tr class="isi-data">
                            <td><?php echo $count; ?></td>
                            <td><img src="<?= $row["foto_profil_staff"];?>" alt="Profil Picture" class="staf-foto"></td>
                            <td><?php echo $row["id_supervisor"]; ?></td>
                            <td><?php echo $row["nama_supervisor"]; ?></td>
                            <td><?php echo $row["email_supervisor"]; ?></td>
                            <td><?php echo $row["password_supervisor"]; ?></td>
                            <td>
                                <div class="button-container">
                                    <button type="submit" id="editstafpop" class="btn edit-btn" onclick="editStaf(<?php echo $row['id_supervisor'];?>)">
                                        <i class='bx bx-edit icon'></i>
                                        <span>Ubah</span>
                                    </button>
                                    <button type="button" class="btn del-btn" onclick="showDeleteModal(<?php echo $row['id_supervisor']; ?>)">
                                        <i class='bx bx-trash icon'></i>
                                        <span>Hapus</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php 
                            $count++;
                            endwhile; ?>
                    </table>
                    <div class="pagination">
                        <ul>
                            <?php if($activePage > 1): ?>
                                <li><a href="?page=1"><<</a></li>
                                <li><a href="?page=<?php echo $activePage - 1; ?>"><</a></li>
                            <?php endif; ?>
                            <?php for($i = 1; $i <= $jumlahPage; $i++): ?>
                                <?php if($i == $activePage): ?>
                                    <li><a href="?page=<?php echo $i; ?>" class="active"><?php echo $i; ?></a></li>
                                <?php else: ?>
                                    <li><a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                <?php endif; ?>
                            <?php endfor; ?>
                            <?php if($activePage < $jumlahPage): ?>
                                <li><a href="?page=<?php echo $activePage + 1; ?>">></a></li>
                                <li><a href="?page=<?php echo $jumlahPage; ?>">>></a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Modal -->
    <div id="addModal" class="addModal">
        <div class="addModal-content">
            <span class="close" id="closeAdd">&times;</span>
            <h2>Tambah Supervisor</h2>
            <form action="" id="addForm" method="post" enctype="multipart/form-data">
                <div class="form-add-staf">
                    <div class="form-group">
                        <label for="addName">Nama:</label>
                        <input type="text" id="addName" name="addName">
                        <p id="msg-error-name"  class="error-message"></p>
                    </div>
                    <div class="form-group">
                        <label for="addEmail">Email:</label>
                        <input type="text" id="addEmail" name="addEmail">
                        <p id="msg-error-email"  class="error-message"></p>
                    </div>
                    <div class="form-group">
                        <label for="addPassword">Password:</label>
                        <input type="password" id="addPassword" name="addPassword">
                        <p id="msg-error-pass"  class="error-message"></p>
                    </div>
                    <div class="foto-staf-preview">
                        <img src="" alt="" id="media-preview">
                        <button type="button" id="btn-hapus-preview" onclick="hapusPreview()" style="display: none">Hapus</button>
                    </div>
                    <div class="add-staf-btn">
                        <div>
                            <input type="file" id="addFoto" name="addFoto" style="display: none;" accept="image/*">
                            <button type="button" id="btn-add-foto-staf" onclick="addProfilStaf()">Tambah Foto</button>
                        </div>
                        <div>
                            <button type="submit" id="btn-add-staf" name="btn-addStaf" onclick="addStaf()">Add Supervisor</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Modal -->
    <div id="deleteModal" class="deleteModal">
        <div class="deleteModal-content">
            <span class="close" id="closeDelete">&times;</span>
            <h2>Delete Supervisor</h2>
            <p>Are you sure you want to delete this supervisor?</p>
            <div>
                <button type="submit" id="deleteStaf" class="delete-selected">Delete</button>
                <button type="button" id="cancelDelete" class="cancel-delete-selected">Cancel</button>
            </div>
        </div>
    </div>
    <script src="../js/sidebar.js"></script>
    <script src="../js/modalstaf.js"></script>

</body>
</html>
