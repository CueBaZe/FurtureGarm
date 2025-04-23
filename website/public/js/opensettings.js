document.addEventListener("DOMContentLoaded", function() {
    window.openSettings = function () {
        document.getElementById('settings').style.width = "300px";
    };
    
    window.closeSettings = function () {
        document.getElementById('settings').style.width = "0px";
    };
});