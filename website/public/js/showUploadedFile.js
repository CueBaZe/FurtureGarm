const fileInput = document.getElementById('mediaInput');
const fileLabel = document.getElementById('file-label');

fileInput.addEventListener('change', function() {
    if(fileInput.files.length > 0) {
        fileLabel.textContent = fileInput.files[0].name;
    } else {
        fileLabel.textContent = "Upload Media";
    }
});