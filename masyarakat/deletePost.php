<?php
require '../php/functions.php';
if (!isset($_SESSION["NIK"])) {
    header("Location: ../loginMasyarakat.php");
    exit();
}else{
    if(isset($_POST["id"])){
        $nik = $_SESSION["NIK"];
        deletePostingan($_POST["id"]);
    $histPost = findHistpost($nik);
    while ($post = mysqli_fetch_assoc($histPost)):?>
    <?php $saveornot = cekSave($post["id_postingan"], $nik) ? True : False;?>
    <div class="history-post">
        <div class="post-header">
            <img src="<?= $post['foto_profil_user'];?>" alt="Profil Picture">
            <div class="post-info">
                <h3><?= $post['nama_user'];?></h3>
                <p><?= $post['tgl_postingan'];?></p>
            </div>
        </div>
        <div class="post-content">
            <p class="caption"><?= $post['caption'];?></p>
            <img src="<?= $post['media'];?>" alt="Gambar postingan">
        </div>
        <div class="post-actions">
            <div class="left-post-action">
                <button type="submit" class="comment-button" name="comment-button" onclick="popupcomment(<?php echo $post['id_postingan'];?>)"><i class='bx bx-comment'></i></button>
                <button data-post-id="<?php echo $post['id_postingan']; ?>" name="savePost" class="<?php echo $saveornot ? 'saved' : 'save-button'; ?>" onclick="toggleSave(this, <?php echo $post['id_postingan']; ?>)">
                    <i class='<?php echo $saveornot ? 'bx bxs-bookmark' : 'bx bx-bookmark'; ?>'></i>
                </button>
            </div>
            <div class="right-post-action">
                <button type="button" class="btn del-btn" onclick="showDeleteModal(<?php echo $post['id_postingan'];?>)">
                    <i class='bx bx-trash icon'></i>
                </button>
            </div>
        </div>
        <div class="add-comment-form">
            <input type="text" name="comment" class="comment" id="comment-<?php echo $post['id_postingan'];?>" placeholder="Tambahkan komentar...">
            <button type="button" id="submitcomment" name="postComment" onclick="postComment(<?php echo $post['id_postingan'];?>)">Kirim</button>
        </div>
    <?php endwhile;
    }
}
?>