document.addEventListener("DOMContentLoaded", function() {
    window.openSettings = function () {
        document.getElementById('settings').style.width = "250px";
    };
    
    window.closeSettings = function () {
        document.getElementById('settings').style.width = "0px";
    };
});