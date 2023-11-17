function submitSelection() {
    const passwordInput = document.getElementById("password");

    if (!passwordInput.checkValidity()) {
        passwordInput.setCustomValidity("at least 8 characters, including one digit, one lowercase letter, and one uppercase letter");
    } else {
        passwordInput.setCustomValidity('');
    }
}