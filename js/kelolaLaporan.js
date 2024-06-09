<<<<<<< HEAD
let idreported;
function showDelete(idpost){
    document.getElementById('deleteModal').style.display = 'block';
    idreported = idpost;
}
=======
var caption = document.getElementById("caption-reported");
var media = document.getElementById("media-reported");
var tableKelolaReport = document.getElementById("table-kelola-report");
>>>>>>> 1f64c3edbe2cc6ca38e89bd9ba582bebc72e0ff0

function closeDelete(){
    document.getElementById('deleteModal').style.display = 'none';
}

function deletePost(){
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "deleteReportedPost.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function (){
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                console.log("Post deleted successfully.");
                closeDelete();
            } else {
                console.error("Failed to delete post.");
            }
        }
    }
    xhr.send("idpost="+idreported);
}

function showPopupReport(idpost){
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "popupReportedPost.php?idpost="+idpost, true);
    xhr.onreadystatechange = function(){
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                document.getElementById('popup-report').innerHTML = xhr.responseText;
                document.getElementById('popup-report').style.display = 'flex';
                document.querySelector('.closepop').addEventListener('click', function(){
                    document.getElementById('popup-report').style.display = 'none';
                });
            } else {
                console.error("Failed to load popup.");
            }
        }
    }
<<<<<<< HEAD
    xhr.send();
}
=======
    xhr.open('GET', '../admin/captionLaporan.php?caption=' + caption.value, true);
    xhr.send();



});


tombolMedia.addEventListener('click', function(){
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
        if(xhr.readyState==4 && xhr.status==200){
            
        }
    }
    xhr.open('GET', '../admin/captionLaporan.php?media=' + media.value, true);
    xhr.send();

});
>>>>>>> 1f64c3edbe2cc6ca38e89bd9ba582bebc72e0ff0
