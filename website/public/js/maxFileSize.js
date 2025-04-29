document.getElementById('mediaInput').addEventListener('change', function () {
    let label = document.getElementById('file-label');

    const file = this.files[0];
    const maxSize = 10 * 1024 * 1024; // 10MB in bytes
    console.log('test');

    if (file && file.size > maxSize) {
        document.getElementById('error').textContent = "File is too large. Max allowed size is 10MB";
        this.value = ''
        label.textContent = 'No file selected.'

        console.log('test1');
    } else {
        document.getElementById('error').textContent = ''
    }
})