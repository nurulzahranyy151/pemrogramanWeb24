let idselected;
function showDeleteModal(id) {
    document.getElementById('deleteModal').style.display = "block";
    idselected = id;
}

document.getElementById('deleteStaf').addEventListener('click', function(event) {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'deleteStaf.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (xhr.status === 200) {
            document.getElementById('table-data-staf').innerHTML = xhr.responseText;
        }
        deleteModal.style.display = "none";
    }
    xhr.send('id=' + idselected);
});

document.getElementById('closeDelete').addEventListener('click', function() {
    deleteModal.style.display = "none";
});

document.getElementById('cancelDelete').addEventListener('click', function() {
    deleteModal.style.display = "none";
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
    event.preventDefault(); 
    const name = document.getElementById('addName').value.trim();
    const email = document.getElementById('addEmail').value.trim();
    const password = document.getElementById('addPassword').value.trim();
    const nameError = document.getElementById('msg-error-name');
    const emailError = document.getElementById('msg-error-email');
    const passwordError = document.getElementById('msg-error-pass');
    nameError.textContent = '';
    emailError.textContent = '';
    passwordError.textContent = '';
    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;

    let isValid = true;
    if (name === '') {
        nameError.textContent = 'Nama harus diisi';
        isValid = false;
    }

    if (email === '') {
        emailError.textContent = 'Email harus diisi';
        isValid = false;
    } else if (!email.includes('@')) {
        emailError.textContent = 'Email harus mengandung @';
        isValid = false;
    }

    if (password === '') {
        passwordError.textContent = 'Password harus diisi';
        isValid = false;
    } else if (!passwordRegex.test(password)) {
        passwordError.textContent = 'Password harus terdiri dari minimal 8 karakter, mengandung huruf besar, huruf kecil, dan angka.';
        isValid = false;
    }

    if (isValid) {
        document.getElementById('addForm').submit();
    }
});


document.getElementById('search-keyword').addEventListener('keyup', function() {
    const keyword = document.getElementById('search-keyword').value;
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'searchStaf.php?keyword=' + keyword, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById('table-data-staf').innerHTML = xhr.responseText;
        }
    };
    xhr.send();
});

function editStaf(id){
    document.getElementById('editModal').style.display = "block";
    document.getElementById('data-staf').style.display = "none";
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'editStaf.php?id=' + id, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById('editModal').innerHTML = xhr.responseText;
            document.getElementById('canceleditstaf').addEventListener('click', function() {
                document.getElementById('editModal').style.display = "none";
                document.getElementById('data-staf').style.display = "block";
            });
            document.getElementById('buttonchangeprofilstaf').addEventListener('click', function(event) {
                document.getElementById('profile-staf-input').click();
            });
            
            document.getElementById('profile-staf-input').addEventListener('change', event => {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('profile-staf-change').src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });
        }
    };
    xhr.send();
}
