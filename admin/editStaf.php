<?php
require '../php/functions.php';
if(!isset($_SESSION["id_admin"])){
    header("Location: ../loginAdmin.php");
    exit();
}
$id = $_GET["id"];
$edited = stafLogin($id);
?>
<form action="" method="post" enctype="multipart/form-data" class="edit-staf-form">
    <div class="edit-staf-container">
        <div class="profile-staf-container">
            <img id="profile-staf-change" src="<?= $edited["foto_profil_staff"];?>" class="profile-staf">
            <input type="file" id="profile-staf-input" name="profile-staf" style="display: none;">
            <button type="button" id="buttonchangeprofilstaf" class="edit-profil" ><i class='bx bx-pencil icon'></i></button>
        </div>                        
        <div class="form-container-edit">
            <div class="form-group-edit">
                <label for="editId">ID</label>
                <input type="text" id="editId" name="editId" value="<?= $edited["id_supervisor"];?>" readonly>
            </div>
            <div class="form-group-edit">
                <label for="editNama">Nama</label>
                <input type="text" id="editNama" name="editNama" value="<?= $edited["nama_supervisor"];?>">
            </div>
            <div class="form-group-edit">
                <label for="editEmail">Email</label>
                <input type="editEmail" id="editEmail" name="editEmail" value="<?= $edited["email_supervisor"];?>">
            </div>
            <div class="form-group-edit">
                <label for="editPassword">Password</label>
                <input type="password" id="editPassword" name="editPassword" value="<?= $edited["password_supervisor"];?>">
            </div>
            <div class="form-actions-edit">
                <button type="button" id="canceleditstaf" class="cancel-button">Batalkan</button>
                <button type="submit" id="saveeditstaf" class="save-button" name="submitChange">Simpan</button>
            </div>
        </div>
    </div>
</form>