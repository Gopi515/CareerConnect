// Function to toggle the input field based on dropdown selection
function toggleInput() {
  var dropdown = document.getElementById("skill_select");
  var inputField = document.getElementById("skill_input");

  if (dropdown.value !== "") {
    inputField.disabled = true;
  } else {
    inputField.disabled = false;
  }
}

// Event listener for dropdown change
document.getElementById("skill_select").addEventListener("change", toggleInput);
