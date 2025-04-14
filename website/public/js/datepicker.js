document.addEventListener("DOMContentLoaded", function () {
    const dateInput = document.getElementById('datePicker');
    const tomorrow = new Date();
    tomorrow.setDate(tomorrow.getDate() + 1);

    const year = tomorrow.getFullYear();
    const month = String(tomorrow.getMonth() + 1).padStart(2, '0');
    const day = String(tomorrow.getDate()).padStart(2, '0');

    const minDate = `${year}-${month}-${day}`;
    dateInput.min = minDate;
});
