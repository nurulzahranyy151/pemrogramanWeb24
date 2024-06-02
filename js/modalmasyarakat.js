let idselected;
function showDeleteModal(nik) {
    document.getElementById('deleteModal').style.display = "block";
    idselected = nik;  
}

document.getElementById('deleteMasyarakat').addEventListener('click', function(event) {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'deleteMasyarakat.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (xhr.status === 200) {
            document.getElementById('table-data-masyarakat').innerHTML = xhr.responseText;
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


document.getElementById('cancelButton').addEventListener('click', function() { 
    document.getElementById('editModal').style.display = "none";
    document.getElementById('data-masarakat').style.display = "block";
});


function changeProfil() {
    document.getElementById('profile-masyarakat-input').click();
}

document.getElementById('profile-masyarakat-input').addEventListener('change', event => {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('profile-masyarakat').src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
});

function editMasyarakat(nik) {
    document.getElementById('editModal').style.display = "block";
    document.getElementById('data-masyarakat').style.display = "none";
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'editMasyarakat.php?nik=' + nik, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById('editModal').innerHTML = xhr.responseText;
            document.getElementById('cancelButton').addEventListener('click', function() {
                document.getElementById('editModal').style.display = "none";
                document.getElementById('data-masyarakat').style.display = "block";
            });
        }
    };
    xhr.send();
}
