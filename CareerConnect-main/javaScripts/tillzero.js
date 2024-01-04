document.getElementById("vacancyInput").addEventListener("input", function () {
  var inputElement = this;
  var value = parseInt(inputElement.value);

  if (isNaN(value) || value < 1) {
    inputElement.value = 1;
    document.querySelector(".error-message").textContent = "Value must be at least 1.";
  } else {
    document.querySelector(".error-message").textContent = "";
  }
});