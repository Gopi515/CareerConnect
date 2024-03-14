document.addEventListener("DOMContentLoaded", function () {
  var inputFields = document.querySelectorAll(
    "#option1Input, #option1Inputjob"
  );

  inputFields.forEach(function (inputField) {
    inputField.addEventListener("input", function (event) {
      var inputValue = event.target.value;
      var sanitizedValue = sanitizeInput(inputValue);
      event.target.value = sanitizedValue;
    });
  });

  function sanitizeInput(input) {
    // Removing any non-alphabetic characters
    var cleanedInput = input.replace(/[^a-zA-Z.\/\-+!# ]/g, "");

    // Converting mixed case letters to uppercase
    var uppercaseInput = cleanedInput.toUpperCase();

    return uppercaseInput;
  }
});
