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
    document.getElementById('addName').value = "";
    document.getElementById('addEmail').value = "";
    document.getElementById('addPassword').value = "";
});

function addStaff() {
    document.getElementById('addName').value = "";
    document.getElementById('addEmail').value = "";
    document.getElementById('addPassword').value = "";
};

function addProfilStaf() {
    document.getElementById('addFoto').click();
}

document.getElementById('addFoto').addEventListener('change', event => {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('media-preview').src = e.target.result;
            document.getElementById('btn-hapus-preview').style.display = "block";
        };
        reader.readAsDataURL(file);
    }
});

function hapusPreview() {
    document.getElementById('media-preview').src = "";document.getElementById('btn-hapus-preview').style.display = "none";
}

document.getElementById('addForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Mencegah form untuk submit secara default

    // Mengambil nilai dari input
    const name = document.getElementById('addName').value.trim();
    const email = document.getElementById('addEmail').value.trim();
    const password = document.getElementById('addPassword').value.trim();

    // Mengambil elemen pesan error
    const nameError = document.getElementById('msg-error-name');
    const emailError = document.getElementById('msg-error-email');
    const passwordError = document.getElementById('msg-error-pass');

    // Reset pesan error
    nameError.textContent = '';
    emailError.textContent = '';
    passwordError.textContent = '';

    // Regex untuk validasi password
    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;

    let isValid = true;

    // Validasi nama
    if (name === '') {
        nameError.textContent = 'Nama harus diisi';
        isValid = false;
    }

    // Validasi email
    if (email === '') {
        emailError.textContent = 'Email harus diisi';
        isValid = false;
    } else if (!email.includes('@')) {
        emailError.textContent = 'Email harus mengandung @';
        isValid = false;
    }

    // Validasi password
    if (password === '') {
        passwordError.textContent = 'Password harus diisi';
        isValid = false;
    } else if (!passwordRegex.test(password)) {
        passwordError.textContent = 'Password harus terdiri dari minimal 8 karakter, mengandung huruf besar, huruf kecil, dan angka.';
        isValid = false;
    }

    // Jika valid, submit form
    if (isValid) {
        document.getElementById('addForm').submit();
    }
});
