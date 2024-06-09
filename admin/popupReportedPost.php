<?php
require '../php/functions.php';
if(isset($_SESSION["id_admin"])){
    if(isset($_GET['idpost'])){
        $post = popupPost($_GET["idpost"]);?>
        <div class="popup-content">
            <span class="closepop">&times;</span>
            <div class="popup-left">
                <img src="<?= $post['media'];?>" alt="Post Image">
            </div>
            <div class="popup-right">
                <div class="post-header">
                    <img src="<?= $post['foto_profil_user'];?>" alt="Profile Picture" class="profile-picture-pop-up">
                    <div class="profile-info">
                        <h4><?= $post['nama_user'];?> | <?= $post['alamat_postingan'];?></h4>
                        <p><?= $post['tgl_postingan'];?></p>
                    </div>
                </div>
                <div class="caption-post">
                    <p><?= $post['caption'];?></p>
                </div>
            </div>
        </div>
    <?php
    }
}   
?>
