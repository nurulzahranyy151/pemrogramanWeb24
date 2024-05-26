function showDeleteModal(id) {
    document.getElementById('deleteModal').style.display = "block";
    document.getElementById('deleteId').value = id;
}

document.getElementById('closeDelete').addEventListener('click', function() {
    deleteModal.style.display = "none";
});

document.getElementById('cancelDelete').addEventListener('click', function() {
    deleteModal.style.display = "none";
});

document.getElementById('closeEdit').addEventListener('click', function() {
    document.getElementById('editModal').style.display = "none";
    document.getElementById('data-staf').style.display = "block";
});


function changeProfil() {
    document.getElementById('profile-staf-input').click();
}

document.getElementById('profile-staf-input').addEventListener('change', event => {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('profile-staf').src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
});

document.getElementById('openAddModal').addEventListener('click', function() {
    document.getElementById('addModal').style.display = "block";
});

document.getElementById('closeAdd').addEventListener('click', function() {
    document.getElementById('addModal').style.display = "none";
});

document.getElementById('btn.add-staf').addEventListener('click', function() {
    document.getElementById('addName').value = "";
    document.getElementById('addEmail').value = "";
    document.getElementById('addPassword').value = "";
});