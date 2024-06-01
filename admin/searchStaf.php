<?php
require '../php/functions.php';

$keyword = $_GET["keyword"];
$staf = searchStaf($keyword);

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
    while($row = mysqli_fetch_assoc($staf)): ?>
    <tr class="isi-data">
        <td><?php echo $count; ?></td>
        <td><img src="<?= $row["foto_profil_staff"];?>" alt="Profil Picture" class="staf-foto"></td>
        <td><?php echo $row["id_supervisor"]; ?></td>
        <td><?php echo $row["nama_supervisor"]; ?></td>
        <td><?php echo $row["email_supervisor"]; ?></td>
        <td><?php echo $row["password_supervisor"]; ?></td>
        <td>
            <div class="button-container">
                <form method="post" style="display:inline;">
                    <input type="hidden" name="edited" value="<?php echo $row['id_supervisor']; ?>">
                    <button type="submit" class="btn edit-btn">
                        <i class='bx bx-edit icon'></i>
                        <span>Ubah</span>
                    </button>
                </form>
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