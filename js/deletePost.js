
let idselected;
function showDeleteModal(nik) {
    document.getElementById('deleteModal').style.display = "block";
    idselected = nik;  
}

document.getElementById('deletePost').addEventListener('click', function(event) {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'deletePost.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (xhr.status === 200) {
            document.getElementById('hist-post').innerHTML = xhr.responseText;
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