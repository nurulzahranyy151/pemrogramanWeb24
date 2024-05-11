function validateComment() {
    // Mendapatkan referensi ke input komentar dan tombol kirim
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
