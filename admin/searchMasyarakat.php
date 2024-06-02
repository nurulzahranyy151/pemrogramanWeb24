<?php
require '../php/functions.php';

$keyword = $_GET["keyword"];
$masyarakat = searchMasyarakat($keyword);

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
    while( $row = mysqli_fetch_assoc($masyarakat)):?>
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