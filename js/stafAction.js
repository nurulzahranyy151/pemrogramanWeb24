function toggleAcceptReject(id, kondisi){
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'actionPost.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onload = function(){
        if(xhr.status === 200){
            document.getElementById('dash-staf').innerHTML = xhr.responseText;
        }
    }
    xhr.send('id='+id + '&kondisi=' + kondisi);
}