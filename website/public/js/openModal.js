function openModal(capsule) {
    //changes the textcontent in the modal
    document.getElementById('modal-title-text').textContent = capsule.name;
    document.getElementById('capsuleText').value = capsule.text;
    document.getElementById('timeMade').textContent = capsule.created_at;
    document.getElementById('madeBy').textContent = capsule.madeBy;
    
    let mediaContainer = document.getElementById('modal-image');
    mediaContainer.innerHTML = '';

    let imgExtensions = ['png', 'jpg', 'jpeg', 'gif'];
    let videoExtension = ['mp4', 'ogg', 'webm'];

    let spinner = document.createElement('div'); //creates the spinner element
    spinner.className = 'spinner-border text-primary'; //adss class
    spinner.role = 'status';
    spinner.innerHTML = '<span class="visually-hidden">Loading image...</span>'
    mediaContainer.appendChild(spinner);

    fetch(`${mediaRoute}/${capsule.id}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Unauthorized or media not found!');
            }
            return response.json();
        })
        .then(data => {
            mediaContainer.innerHTML = '';
            if(data.path) {
                console.log(data.extension);
                if (imgExtensions.includes(data.extension)) {
                    
                    let img = document.createElement('img'); //creates a new img element
                    mediaContainer.appendChild(img); //puts the img into the imgContainer
                    img.src = data.path; //adds the src to the img
                    img.alt = 'Timecapsule Image'; //adds an alt to the img
                    img.className = 'img-fluid rounded'; //adds classname to img
                    img.addEventListener('click', function() {
                        window.open(img.src, '_blank');
                    })
                } else if (videoExtension.includes(data.extension)) {
                    let video = document.createElement('video');
                    mediaContainer.appendChild(video);
                    video.src = data.path;
                    video.setAttribute("controls", "true");
                    video.volume = 0.20; //sets the voulume of the video to 20%
                    video.innerHTML = "Your browser does not support the video tag."

                }
            } else{
                mediaContainer.innerHTML = 'No media attached';
            }
        })
        .catch(error => {
            console.log('Error fetching media;', error);
            mediaContainer.innerHTML = 'Error loading image';
        })

}

function closeModal() { 
    const mediaContainer = document.getElementById('modal-image');

    mediaContainer.innerHTML = ''; //removes the media
}

