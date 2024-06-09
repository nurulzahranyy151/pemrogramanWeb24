<?php
require '../php/functions.php';

$idcomment = $_POST['id'];
$nik = $_SESSION['NIK'];
$post = popupPost($idcomment);
$saveornotpopup = cekSave($post['NIK'], $nik);
?>
<div class="popup-content">
    <span class="closepop">&times;</span>
    <div class="popup-left">
        <img src="<?= $post['media'];?>" alt="Post Image">
    </div>
    <div class="popup-right">
        <div class="post-header">
            <img src="<?= $post['foto_profil_user'];?>" alt="Profile Picture" class="profile-picture-pop-up">
            <div class="profile-info">
                <h3><?= $post['nama_user'];?></h3>
                <p><?= $post['alamat_postingan'];?></p>
            </div>
        </div>
        <div class="previous-comments">
            <div class="comments">
                <div class="image-user-comment">
                    <img src="<?= $post['foto_profil_user'];?>" alt="">
                </div>
                <div class="uploader-info">
                    <p class="isi-komentar"><b><?= $post['nama_user'];?></b> <?= $post['caption'];?></p>
                    <p class="tanggal-komen"><?= $post['tgl_postingan'];?></p>
                </div>
            </div>
            <?php
            $comments = showComment($idcomment);
            while ($comment = mysqli_fetch_assoc($comments)):?>
            <?php $mycomment = cekMycomment($comment['NIK'],$nik)?>
            <div class="comments">
                <div class="image-user-comment">
                    <img src="<?= $comment['foto_profil_user'];?>" alt="">
                </div>
                <div class="comment-info">
                    <p class="isi-komentar"><b><?= $comment['nama_user'];?></b> <?= $comment['isi_komentar'];?></p>
                    <div class="info-komentar">
                        <p class="tanggal-komen"><?= $comment['waktu_komentar'];?></p>
                        <?php if($mycomment):?>
                            <i class='bx bx-trash' onclick="deleteComment(<?php echo $comment['id_komentar'];?>, <?php echo $idcomment;?>)"></i>
                        <?php endif;?>
                    </div>
                    
                </div>
            </div>
            <?php endwhile;?>
        </div>
        <div class="post-actions">
            <div class="left-post-action">
                <button class="comment-button" ><label for="comment">
                <i class='bx bx-comment'></i>
                </label></button>
            </div>
            <div class="right-post-action">
                <button data-post-id="<?php echo $post['id_postingan']; ?>" name="savePost" class="<?php echo $saveornotpopup ? 'saved' : 'save-button'; ?>" onclick="toggleSave(this, <?php echo $post['id_postingan']; ?>)">
                    <i class='<?php echo $saveornotpopup ? 'bx bxs-bookmark' : 'bx bx-bookmark'; ?>'></i>
                </button>
            </div>
        </div>
        <div class="add-comment-form">
            <input type="text" class="comment" name="comment" id="commentpop-<?php echo $idcomment;?>" placeholder="Tambahkan komentar...">
            <button id="submitcommentpop">Kirim</button>
        </div>
    </div>
</div>