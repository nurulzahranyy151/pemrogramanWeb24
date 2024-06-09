var caption = document.getElementById("caption-reported");
var media = document.getElementById("media-reported");
var tombolCaption = document.getElementById("cari-caption");
var tombolMedia = document.getElementById("cari-media");
var tableKelolaReport = document.getElementById("table-kelola-report");

tombolCaption.addEventListener('click', function(){
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
        if(xhr.readyState==4 && xhr.status==200){
            caption.innerHTML = xhr.responseText;
            
        }
    }
    xhr.open('GET', '../admin/captionLaporan.php?tombolCaption=' + tombolCaption.value, true);
    xhr.send();



});


tombolMedia.addEventListener('click', function(){
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
        if(xhr.readyState==4 && xhr.status==200){
            
        }
    }

    xhr.open('GET', '')

});