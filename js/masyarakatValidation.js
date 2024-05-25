function validateComment() {
    var commentInput = document.getElementById('comment');
    var submitBtn = document.getElementById('submit-comment');
    if (commentInput.value.trim() !== '') {
        submitBtn.style.display = 'block';
    } else {
        submitBtn.style.display = 'none';
    }
}
document.addEventListener('DOMContentLoaded', function() {
    validateComment();
    document.getElementById('comment').addEventListener('input', validateComment);
});

// Image upload
const imageIcon = document.querySelector('.bx-image-add');
const imageUpload = document.getElementById('imageUpload');
const mediaPreview = document.querySelector('.media-preview');
const footerReport = document.querySelector('.footer-report');

imageIcon.addEventListener('click', () => {
    imageUpload.click();
});

imageUpload.addEventListener('change', event => {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.alt = 'User Uploaded Image';

            const deleteIcon = document.createElement('i');
            deleteIcon.classList.add('bx', 'bx-x', 'delete-icon');
            deleteIcon.addEventListener('click', () => {
                mediaPreview.removeChild(img);
                mediaPreview.removeChild(deleteIcon);
                footerReport.style.marginTop = 0;
            });

            mediaPreview.innerHTML = ''; 
            mediaPreview.appendChild(img);
            mediaPreview.appendChild(deleteIcon);
            footerReport.style.marginTop = '10px';
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

function toggleLike(button) {
    const icon = button.querySelector('i');
    button.classList.toggle('liked');
    if (button.classList.contains('liked')) {
        icon.classList.replace('bx-heart', 'bxs-heart');
    } else {
        icon.classList.replace('bxs-heart', 'bx-heart'); 
    }
}

function toggleComment() {
    var postInfo = posts[postIndex];

        // Isi popup komentar dengan informasi postingan
        var popup = document.getElementById('commentPopup');
        var popupLeft = popup.querySelector('.popup-left');
        var popupRight = popup.querySelector('.popup-right');

        // Isi gambar postingan pada popup-left
        var image = document.createElement('img');
        image.src = postInfo.imageSrc;
        popupLeft.innerHTML = '';
        popupLeft.appendChild(image);

        // Isi informasi postingan pada popup-right
        var profilePicture = popupRight.querySelector('.profile-picture-pop-up');
        profilePicture.src = postInfo.profilePictureSrc;

        var username = popupRight.querySelector('h3');
        username.textContent = postInfo.username;

        var postDate = popupRight.querySelector('p');
        postDate.textContent = postInfo.postDate;

        // Tampilkan popup komentar
        popup.style.display = 'flex';
}

var closeBtn = document.querySelector(".popup .close");
closeBtn.onclick = function() {
    var popup = document.getElementById("commentPopup");
    popup.style.display = "none";
}

window.onclick = function(event) {
    var popup = document.getElementById("commentPopup");
    if (event.target == popup) {
        popup.style.display = "none";
    }
}


