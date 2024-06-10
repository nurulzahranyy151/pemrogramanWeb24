<?php 
require '../php/functions.php';
if(!isset($_SESSION["id_admin"])){
    header("Location: ../loginAdmin.php");
    exit();
}
$id = $_POST['id'];
deleteStaf($id);
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
    $count = 1;
    $result = findGov();
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