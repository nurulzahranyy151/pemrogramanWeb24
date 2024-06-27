<?php 
require '../php/functions.php';
if(!isset($_SESSION["id_admin"])){
    header("Location: ../loginAdmin.php");
    exit();
}
$id = $_POST['id'];
deleteMasyarakat($id);
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