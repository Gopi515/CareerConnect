function togglePassword() {
    const passwordInput = document.getElementById("password");
    const eyeIcons = document.querySelectorAll(".eye-icon, .eye-iconl");

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        eyeIcons.forEach(icon => {
            icon.innerHTML = '<i class="far fa-eye-slash"></i>'; // Change to open eye
        });
    } else {
        passwordInput.type = "password";
        eyeIcons.forEach(icon => {
            icon.innerHTML = '<i class="far fa-eye"></i>'; // Change to closed eye
        });
    }
}