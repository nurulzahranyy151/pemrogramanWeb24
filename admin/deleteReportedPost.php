<?php
require '../php/functions.php';
if(!isset($_SESSION["id_admin"])){
    header("Location: ../loginAdmin.php");
    exit();
}

if(isset($_POST['idpost'])){
    $deleted = deletePostingan($_POST['idpost']);

    if($deleted) {
        $result = findReported();
        if(mysqli_num_rows($result) > 0) {
        ?>
            <table>
                <tr class="head-table">
                    <th>No</th>
                    <th>Postingan</th>
                    <th>NIK</th>
                    <th>Kategori</th>
                    <th>Action</th>
                </tr>
                <?php 
                $count = 1;
                while($row = mysqli_fetch_assoc($result)) {
                ?>
                    <tr class="isi-data">
                        <td><?= $count;?></td>
                        <td><img src="<?= $row['media'];?>" alt="Profil Picture" class="media-report" onclick="showPopupReport(<?= $row['id_postingan'];?>)"></td>
                        <td><?= $row['NIK'];?></td>
                        <td><?= $row["kategori"];?></td>
                        <td>    
                            <div class="button-container">
                                <button type="button" class="btn del-btn" onclick="showDelete(<?php echo $row['id_postingan'];?>)">
                                    <i class='bx bx-trash icon'></i>
                                    <span>Hapus</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                <?php 
                    $count++;
                }
                ?>
            </table>
    <?php 
        } else {
            echo "<p>Tidak ada laporan.</p>";
        }
    }
}
?>
