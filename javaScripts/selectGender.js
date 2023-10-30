const genderButtons = document.querySelectorAll('.gender-button');

genderButtons.forEach(button => {
    button.addEventListener('click', () => {
        genderButtons.forEach(btn => {
            btn.classList.remove('selected');
        });
        button.classList.add('selected');
    });
});
