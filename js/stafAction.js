let actionId, actionCondition;

function toggleAcceptReject(id, kondisi) {
    actionId = id;
    actionCondition = kondisi;
    document.getElementById('confirmationMessage').innerText = `Are you sure you want to ${kondisi === 'accept' ? 'accept' : 'reject'} this post?`;
    document.getElementById('confirmationModal').style.display = 'block';
}

function confirmAction() {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'actionPost.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (xhr.status === 200) {
            document.getElementById('dash-staf').innerHTML = xhr.responseText;
        }
        closeModal();
    }
    xhr.send('id=' + actionId + '&kondisi=' + actionCondition);
}

function closeModal() {
    document.getElementById('confirmationModal').style.display = 'none';
}
