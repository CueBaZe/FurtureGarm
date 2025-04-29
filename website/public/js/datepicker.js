
document.addEventListener("DOMContentLoaded", function () {
    // Set the minimum date to tomorrow
    const dateInput = document.getElementById('datePicker');
    if (dateInput) {
        const tomorrow = new Date(); //gets the date today
        tomorrow.setDate(tomorrow.getDate() + 1); //makes it + 1 so its tomorrow
        const year = tomorrow.getFullYear(); //gets the year
        const month = String(tomorrow.getMonth() + 1).padStart(2, '0'); //gets the month
        const day = String(tomorrow.getDate()).padStart(2, '0'); //gets the day
        dateInput.min = `${year}-${month}-${day}`; //sets the minimum to tomorrow
    }

    // Reopen the modal if there are any errors
    if (window.showCreateModal) {
        const modal = new bootstrap.Modal(document.getElementById('createTimeCapsule'));
        modal.show();
    }
})
