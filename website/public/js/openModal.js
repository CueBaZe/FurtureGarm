function openModal(capsule) {
    document.getElementById('modal-title-text').textContent = capsule.name;
    document.getElementById('capsuleText').value = capsule.text;
    document.getElementById('timeMade').textContent = capsule.created_at;
}