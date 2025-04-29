function openModal(capsule) {
    document.getElementById('modal-title-text').textContent = capsule.name;
    document.getElementById('capsuleText').value = capsule.text;
    document.getElementById('timeMade').textContent = capsule.created_at;
    document.getElementById('madeBy').textContent = capsule.madeBy;
    
    let imgContainer = document.getElementById('modal-image');
    imgContainer.innerHTML = '';

    fetch(`${mediaRoute}/${capsule.id}`)
        .then(response => response.json())
        .then(data => {
            if(data.path) {
                let img = document.createElement('img');
                img.src = data.path;
                img.alt = 'Timecapsule Image';
                img.className = 'img-fluid rounded';
                imgContainer.appendChild(img);
            } else{
                imgContainer.innerHTML = 'No media attached';
            }
        })
        .catch(error => {
            console.log('Error fetching media;', error);
            imgContainer.innerHTML = 'Error loading image';
        })

}