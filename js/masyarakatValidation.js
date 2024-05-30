function updateSaveStatus(postId, isSaved) {
    var saveButton = document.querySelector(`button[data-post-id='${postId}']`);
    if (saveButton) {
        if (isSaved) {
            saveButton.classList.add('saved');
            saveButton.classList.remove('save-button');
            saveButton.innerHTML = "<i class='bx bxs-bookmark'></i>";
        } else {
            saveButton.classList.remove('saved');
            saveButton.classList.add('save-button');
            saveButton.innerHTML = "<i class='bx bx-bookmark'></i>";
        }
    }
}

function popupcomment(id) {
    document.querySelector('.popup').style.display = "flex";
    let idpost = id;
    fetchPostData(idpost);
}

function fetchPostData(id) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "popupComment.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onload = function () {
        if (xhr.status === 200) {
            console.log(id);
            document.getElementById('commentPopup').innerHTML = xhr.responseText;
            document.querySelector('.popup .closepop').addEventListener('click', function () {
                document.querySelector('.popup').style.display = "none";
                var postId = document.querySelector('.popup-content').dataset.postId;
                var isSaved = document.querySelector('.popup-content .save-button') === null;
                updateSaveStatus(postId, isSaved);
            });
            document.getElementById('submitcommentpop').addEventListener('click', function () {
                postCommentPopup(id);
            });
        }
    };
    xhr.send("id=" + id);
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

function toggleSave(button, id) {
    const icon = button.querySelector('i');
    button.classList.toggle('saved');
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "saveHandler.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    let status = button.classList.contains('saved');
    let requestData = "status=" + encodeURIComponent(status) + "&id=" + encodeURIComponent(id);

    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status !== 200) {
                console.error("Failed to save data.");
                button.classList.toggle
                icon.classList.toggle('bxs-bookmark');
                icon.classList.toggle('bx-bookmark');
            }else{
                console.log("Post saved successfully.");
            }
        }
    };

    if (status) {
        icon.classList.replace('bx-bookmark', 'bxs-bookmark');
    } else {
        icon.classList.replace('bxs-bookmark', 'bx-bookmark');
    }

    xhr.send(requestData);
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

document.querySelector('.make-report').onsubmit = function() {
    const mediaPreview = document.querySelector('.media-preview');
    if (!mediaPreview.querySelector('img')) {
        e.preventDefault();
        alert('Silakan unggah gambar sebelum membuat postingan.');
        }
}

function postComment(postId) {
    const commentInputId = 'comment-' + postId;
    const commentInput = document.getElementById(commentInputId);
    const commentText = commentInput.value.trim();

    if (commentText === "") {
        commentInput.placeholder = "Tulis komentar Anda";
        commentInput.classList.add('error');
        return;
    }

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "commentHandler.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    let requestData = "idpost=" + encodeURIComponent(postId) + "&comment=" + encodeURIComponent(commentText);

    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                console.log(postId);
                console.log("Comment posted successfully.");
                commentInput.value = ""; 
                commentInput.placeholder = "Tambahkan komentar...";
            } else {
                console.error("Failed to post comment.");
            }
        }
    };

    xhr.send(requestData);
}

function postCommentPopup(postId) {
    const commentInputId = 'commentpop-' + postId;
    const commentInput = document.getElementById(commentInputId);
    const commentText = commentInput.value.trim();

    if (commentText === "") {
        commentInput.placeholder = "Tulis komentar Anda";
        commentInput.classList.add('error');
        return;
    }

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "commentHandler.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    let requestData = "idpost=" + encodeURIComponent(postId) + "&comment=" + encodeURIComponent(commentText);

    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                console.log(postId);
                console.log("Comment posted successfully.");
                commentInput.value = ""; 
                commentInput.placeholder = "Tambahkan komentar...";
                fetchPostData(postId);
            } else {
                console.error("Failed to post comment.");
            }
        }
    };

    xhr.send(requestData);
}

function unsavePost(id) {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "saveHandler.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");


    let requestData = "id=" + encodeURIComponent(id) + "&status=false";

    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                console.log("Post unsaved successfully.");
                document.querySelector(`.saved-post[data-post-id='${id}']`).remove();
            } else {
                console.error("Failed to unsave post.");
            }
        }
    };
    xhr.send(requestData);
}

function cancelEdit(){
    history.back();
}
