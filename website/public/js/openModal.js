function openModal(capsule) {
    //changes the textcontent in the modal
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
                let img = document.createElement('img'); //creates a new img element
                img.src = data.path; //adds the src to the img
                img.alt = 'Timecapsule Image'; //adds an alt to the img
                img.className = 'img-fluid rounded'; //adds classname to img
                img.addEventListener('click', function() {
                    window.open(img.src, '_blank');
                })
                imgContainer.appendChild(img); //puts the img into the imgContainer
            } else{
                imgContainer.innerHTML = 'No media attached';
            }
        })
        .catch(error => {
            console.log('Error fetching media;', error);
            imgContainer.innerHTML = 'Error loading image';
        })

}

