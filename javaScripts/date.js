function getTomorrowDate() {
    const tomorrow = new Date();
    tomorrow.setDate(tomorrow.getDate() + 1);

    const year = tomorrow.getFullYear();
    let month = tomorrow.getMonth() + 1;
    let day = tomorrow.getDate();

    month = month < 10 ? '0' + month : month;
    day = day < 10 ? '0' + day : day;

    return `${year}-${month}-${day}`;
}

const dateInput = document.querySelector('.date');
dateInput.setAttribute('min', getTomorrowDate());