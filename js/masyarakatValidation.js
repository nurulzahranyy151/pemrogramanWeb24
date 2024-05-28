function validateComment() {
    var commentInput = document.getElementById('comment');
    var submitBtn = document.getElementById('submit-comment');
    if (commentInput.value.trim() !== '') {
        submitBtn.style.display = 'block';
    } else {
        submitBtn.style.display = 'none';
    }
}

function chooseFile() {
    document.getElementById('imageUpload').click();
}

document.getElementById('imageUpload').addEventListener('change', event => {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.alt = 'Media Preview';
            const close = document.createElement('bx');
            close.classList.add('bx', 'bx-x');
            close.style.cursor = 'pointer';
            close.addEventListener('click', () => {
                document.querySelector('.media-preview').removeChild(img);
                document.querySelector('.media-preview').removeChild(close);
            });
            document.querySelector('.media-preview').appendChild(img);
            document.querySelector('.media-preview').appendChild(close);
        };
        reader.readAsDataURL(file);
    }
});

function toggleSave(button) {
    const icon = button.querySelector('i');
    button.classList.toggle('saved');
    if (button.classList.contains('saved')) {
        icon.classList.replace('bx-bookmark', 'bxs-bookmark');
    } else {
        icon.classList.replace('bxs-bookmark', 'bx-bookmark'); 
    }
}

var closeBtn = document.querySelector(".popup .close");
closeBtn.onclick = function() {
    document.getElementById("commentPopup").style.display = "none";
}

function changeProfilUser(){
    document.getElementById('profile-pict-input').click();
}

document.getElementById('profile-pict-input').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('profile-pict').src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
});

function showDelete(id) {
    document.getElementById('deleteModal').style.display = "block";
    document.getElementById('deleteId').value = id;
}

function closeDelete() {
    document.getElementById('deleteModal').style.display = "none";
}

