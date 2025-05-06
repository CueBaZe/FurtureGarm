document.getElementById('mediaInput').addEventListener('change', function () {
    let label = document.getElementById('file-label');

    const file = this.files[0];
    const maxSize = 40 * 1024 * 1024; // 10MB in bytes

    if (file && file.size > maxSize) {
        document.getElementById('error').textContent = "File is too large. Max allowed size is 40MB";
        this.value = ''
        label.textContent = 'No file selected.'

    } else {
        document.getElementById('error').textContent = ''
    }
})