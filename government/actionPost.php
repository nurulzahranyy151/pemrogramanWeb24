<?php
require '../php/functions.php';
if(!isset($_SESSION["id_supervisor"])){
    header("Location: ../loginAdminandGov.php");
    exit();
}
$id = $_POST['id'];
$kondisi = $_POST['kondisi'];
if ($kondisi === 'accept') {
    accPostingan($id);
} else {
    rejectPostingan($id);
}
$postingan = showAllpostingan();
?>

<div class="fyp">
<?php 
while ($row = mysqli_fetch_array($postingan)) {
    if ($row['status_postingan'] === 'ditunggu') {
        ?>
        <div class="post">
            <div class="post-header">
                <img src="<?= $row['foto_profil_user'];?>" alt="Profil Picture">
                <div class="post-info">
                    <h3><?= $row['nama_user'];?></h3>
                    <p><?= $row['tgl_postingan'];?></p>
                </div>
            </div>
            <div class="post-content">
                <p class="caption"><?= $row['caption'];?></p>
                <img src="<?= $row['media'];?>" alt="Gambar postingan">
            </div>
            <div class="post-actions">
                <div class="left-post-action">
                    <button name="accept-button" class="accept-button" onclick="toggleAccept(<?php echo $row['id_postingan'];?>)">
                        <i class='bx bxs-check-square'></i>
                    </button>
                    <button name="reject-button" class="reject-button" onclick="toggleReject(this)">
                        <i class='bx bxs-x-square'></i>
                    </button>
                </div>
                <div class="right-post-action">
                    <button class="save-button" onclick="toggleSave(this)">
                        <i class='bx bx-bookmark'></i>Cetak
                    </button>
                </div>
            </div>
        </div>
        <?php
    }
}
?>
</div>