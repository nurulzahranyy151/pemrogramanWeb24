function toggleSave(button, postId) {
    const isSaved = button.classList.toggle('saved');
    const icon = button.querySelector('i');
    icon.classList.toggle('bxs-bookmark', isSaved);
    icon.classList.toggle('bx-bookmark', !isSaved);

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "saveHandler.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    const requestData = `id=${postId}&status=${isSaved}`;
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                sinkronSave(postId, isSaved);
            } else {
                button.classList.toggle('saved');
                icon.classList.toggle('bxs-bookmark', !isSaved);
                icon.classList.toggle('bx-bookmark', isSaved);
            }
        }
    };
    xhr.send(requestData);
}

function sinkronSave(postId, isSaved) {
    const mainMenuButton = document.querySelector(`button[data-post-id='${postId}']`);
    if (mainMenuButton) {
        const icon = mainMenuButton.querySelector('i');
        mainMenuButton.classList.toggle('saved', isSaved);
        icon.classList.toggle('bxs-bookmark', isSaved);
        icon.classList.toggle('bx-bookmark', !isSaved);
    }
}

function popupcomment(id) {
    document.querySelector('.popup').style.display = "flex";
    fetchPostData(id);
}

function fetchPostData(id) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "popupComment.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onload = function () {
        if (xhr.status === 200) {
            document.getElementById('commentPopup').innerHTML = xhr.responseText;
            document.querySelector('.popup .closepop').addEventListener('click', function () {
                document.querySelector('.popup').style.display = "none";
                const popupButton = document.querySelector('.popup-content button[data-post-id]');
                const postId = popupButton.getAttribute('data-post-id');
                const isSaved = popupButton.classList.contains('saved');
                sinkronSave(postId, isSaved);
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

document.getElementById('imageUpload').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.alt = 'Media Preview';
            const close = document.createElement('i');
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

    let requestData = `idpost=${postId}&comment=${commentText}`;

    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
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

    let requestData = `idpost=${postId}&comment=${commentText}`;

    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
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

    const requestData = `id=${id}&status=false`;

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

function cancelEdit() {
    history.back();
}

function saveProfile() {
    setTimeout(() => {
        alert("Data berhasil disimpan!");
    }, 1000);
}

document.querySelector('.make-report').onsubmit = function(event) {
    const mediaPreview = document.querySelector('.media-preview');
    if (!mediaPreview.querySelector('img')) {
        event.preventDefault();
        alert('Silakan unggah gambar sebelum membuat postingan.');
    }
};

function showReportOptions(postId) {
    var modal = document.getElementById('reportModal');
    modal.style.display = "block";
}

function closeReportOptions() {
    var modal = document.getElementById('reportModal');
    modal.style.display = "none";
}

function reportPost() {
    var reportForm = document.getElementById('report-form');
    var formData = new FormData(reportForm);
    var selectedCategory = formData.get('report_category');
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "reportPostHandler.php", true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                console.log(selectedCategory);
            } else {
                console.error("Failed to submit report.");
            }
        }
    };
    xhr.send(selectedCategory);
}
