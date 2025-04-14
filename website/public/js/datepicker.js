
document.addEventListener("DOMContentLoaded", function () {
    // Set the minimum date to tomorrow
    const dateInput = document.getElementById('datePicker');
    if (dateInput) {
        const tomorrow = new Date();
        tomorrow.setDate(tomorrow.getDate() + 1);
        const year = tomorrow.getFullYear();
        const month = String(tomorrow.getMonth() + 1).padStart(2, '0');
        const day = String(tomorrow.getDate()).padStart(2, '0');
        dateInput.min = `${year}-${month}-${day}`;
    }

    // Reopen the modal if there are any errors
    if (window.showCreateModal) {
        const modal = new bootstrap.Modal(document.getElementById('createTimeCapsule'));
        modal.show();
    }
})
