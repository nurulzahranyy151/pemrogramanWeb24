document.addEventListener("DOMContentLoaded", function() {
    if (sessionStorage.scrollTop !== undefined) {
        window.scrollTo(0, sessionStorage.scrollTop);
        sessionStorage.removeItem('scrollTop');
    }
    document.querySelectorAll("form").forEach(form => {
        form.addEventListener("submit", function() {
            sessionStorage.scrollTop = window.pageYOffset;
        });
    });
});

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
            img.alt = 'Media Preview';
            const close = document.createElement('bx');
            close.classList.add('bx', 'bx-x');
            close.style.cursor = 'pointer';
            close.addEventListener('click', () => {
                mediaPreview.removeChild(img);
                mediaPreview.removeChild(close);
                footerReport.style.display = 'none';
            });
            mediaPreview.appendChild(img);
            mediaPreview.appendChild(close);
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
    var popup = document.getElementById("commentPopup");
    popup.style.display = "none";
}

window.onclick = function(event) {
    var popup = document.getElementById("commentPopup");
    if (event.target == popup) {
        popup.style.display = "none";
    }
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

