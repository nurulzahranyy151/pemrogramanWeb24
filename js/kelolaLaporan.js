var caption = document.getElementById("caption-reported");
var media = document.getElementById("media-reported");
var tableKelolaReport = document.getElementById("table-kelola-report");

tombolCaption.addEventListener('click', function(){
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
        if(xhr.readyState==4 && xhr.status==200){
            caption.innerHTML = xhr.responseText;
            
        }
    }
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