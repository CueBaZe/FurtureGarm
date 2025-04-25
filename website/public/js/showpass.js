let buttton = document.getElementById('showpass');
let passInput = document.getElementById('password');

buttton.addEventListener('click', function () {
    if (buttton.classList.contains('bxs-hide')) {
        buttton.classList.remove('bxs-hide');
        buttton.classList.add('bxs-show');
        passInput.type = "text";
    } else {
        buttton.classList.remove('bxs-show');
        buttton.classList.add('bxs-hide');
        passInput.type = "password";
    }
});