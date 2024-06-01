<?php
require '../php/functions.php';
$nik = $_GET["nik"];
$edited = userLogin($nik);
?>

<form action="" method="post" class="edit-masyarakat-form">
    <div class="edit-masyarakat-container">
        <div class="profile-masyarakat-container">
            <img id="profile-masyarakat" src="<?= $edited["foto_profil_user"];?>" class="profile-masyarakat">
        </div>                        
        <div class="form-container-edit">
            <div class="form-group-edit">
                <label for="editNik">NIK</label>
                <input type="text" id="editNik" name="editNik" value="<?= $edited["NIK"];?>" readonly>
            </div>
            <div class="form-group-edit">
                <label for="editNama">Nama</label>
                <input type="text" id="editNama" name="editNama" value="<?= $edited["nama_user"];?>">
            </div>
            <div class="form-group-edit">
                <label for="editEmail">Email</label>
                <input type="editEmail" id="editEmail" name="editEmail" value="<?= $edited["email_user"];?>">
            </div>
            <div class="form-group-edit">
                <label for="editPassword">Password</label>
                <input type="password" id="editPassword" name="editPassword" value="<?= $edited["password_user"];?>">
            </div>
            <div class="form-actions-edit">
                <button type="button" id="cancelButton" class="cancel-button">Batalkan</button>
                <button type="submit" class="save-button" name="saveChange">Simpan</button>
            </div>
        </div>
    </div>
</form>