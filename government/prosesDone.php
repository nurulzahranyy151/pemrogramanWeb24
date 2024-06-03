<?php
require '../php/functions.php';
if (!isset($_SESSION["id_supervisor"])) {
    header("Location: ../loginAdminandGov.php");
    exit();
}else{
    $id = $_POST["id"];
    projectDone($id);
    $accPost = showProject();
    while ($post = mysqli_fetch_assoc($accPost)):?>
    <div class="saved-post" data-post-id="<?= $post['id_postingan']; ?>">
        <div class="saved-media">
            <img src="<?= $post["media"];?>" alt="">
        </div>
        <div class="saved-infomation">
            <div class="caption">
                <p><?= $post["caption"];?></p>
                <p class="saved-on">Image . accept on <?= $post["waktu_terima"];?></p>
            </div>
            <div class="uploader">
                <img src="<?= $post["foto_profil_user"];?>" alt="">
                <p class="posted-by">Posted by <b><?= $post["nama_user"];?></b></p>
            </div>
            <div class="unsave">
                <button type="submit" class="unsave-button" name="unsavePost" onclick="projectDone(<?php echo $post['id_postingan'];?>)">Projek Selesai</button>
            </div>
        </div>
    </div>
    <?php endwhile;
    }
    ?>