<?php 
require '../php/functions.php';
if(!isset($_SESSION["id_admin"])){
    header("Location: ../loginAdmin.php");
    exit();
}
$id = $_POST['id'];
deleteStaf($id);
$perpage = 5;
$stafs = findGov();
$dataStaf = [];
while ($row = mysqli_fetch_assoc($stafs)) {
    $dataStaf[] = $row;
}
$jumlahStaf = count($dataStaf);
$jumlahPage = ceil($jumlahStaf / $perpage);
$activePage = isset($_GET["page"]) ? $_GET["page"] : 1;
$startPage = ($perpage * $activePage) - $perpage;
?>

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