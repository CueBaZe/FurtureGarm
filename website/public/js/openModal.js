function openModal(capsule) {
    //changes the textcontent in the modal
    document.getElementById('modal-title-text').textContent = capsule.name;
    document.getElementById('capsuleText').value = capsule.text;
    document.getElementById('timeMade').textContent = capsule.created_at;
    document.getElementById('madeBy').textContent = capsule.madeBy;
    
    let imgContainer = document.getElementById('modal-image');
    imgContainer.innerHTML = '';

    let imgExtensions = ['png', 'jpg', 'jpeg', 'gif'];
    let videoExtension = ['mp4', 'ogg', 'webm'];

    let spinner = document.createElement('div'); //creates the spinner element
    spinner.className = 'spinner-border text-primary'; //adss class
    spinner.role = 'status';
    spinner.innerHTML = '<span class="visually-hidden">Loading image...</span>'
    imgContainer.appendChild(spinner);

    fetch(`${mediaRoute}/${capsule.id}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Unauthorized or media not found!');
            }
            return response.json();
        })
        .then(data => {
            imgContainer.innerHTML = '';
            if(data.path) {
                let img = document.createElement('img'); //creates a new img element
                imgContainer.appendChild(img); //puts the img into the imgContainer
                img.src = data.path; //adds the src to the img
                img.alt = 'Timecapsule Image'; //adds an alt to the img
                img.className = 'img-fluid rounded'; //adds classname to img
                img.addEventListener('click', function() {
                    window.open(img.src, '_blank');
                })
            } else{
                imgContainer.innerHTML = 'No media attached';
            }
        })
        .catch(error => {
            console.log('Error fetching media;', error);
            imgContainer.innerHTML = 'Error loading image';
        })

}

