let idreported;
function showDelete(idpost){
    document.getElementById('deleteModal').style.display = 'block';
    idreported = idpost;
}
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
                document.getElementById('table-kelola-report').innerHTML = xhr.responseText;
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
    xhr.send();
}