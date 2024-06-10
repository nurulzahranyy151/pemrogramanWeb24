<?php 
require '../php/functions.php';
if(!isset($_SESSION["id_admin"])){
    header("Location: ../loginAdmin.php");
    exit();
}
$id = $_POST['id'];
deleteMasyarakat($id);
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
    $count = 1;
    $result = findMasyarakat();
    while( $row = mysqli_fetch_assoc($result)):?>
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