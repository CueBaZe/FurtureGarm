document.addEventListener("DOMContentLoaded", function() {
    window.openSettings = function () {
        //shows the setting menu
        document.getElementById('settings').style.width = "300px";
    };
    
    window.closeSettings = function () {
        //hides the setting menu
        document.getElementById('settings').style.width = "0px";
    };
});