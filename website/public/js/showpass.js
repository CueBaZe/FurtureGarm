let buttton = document.getElementById('showpass');
let passInput = document.getElementById('password');

buttton.addEventListener('click', function () {
    if (buttton.classList.contains('bxs-hide')) {
        //show the "show button"
        buttton.classList.remove('bxs-hide');
        buttton.classList.add('bxs-show');
        passInput.type = "text";
    } else {
        //show the "hide button"
        buttton.classList.remove('bxs-show');
        buttton.classList.add('bxs-hide');
        passInput.type = "password";
    }
});