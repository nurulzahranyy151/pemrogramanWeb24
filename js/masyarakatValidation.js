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
