function showDropdown() {
    document.getElementById("dropdownOptions").style.display = "block";
  }

  function selectOption(option) {
    document.getElementById("inputBox").value = option;
    document.getElementById("dropdownOptions").style.display = "none";
  }

  // Close the dropdown if the user clicks outside of it
  window.onclick = function (event) {
    if (!event.target.matches('#inputBox')) {
      var dropdown = document.getElementById("dropdownOptions");
      if (dropdown.style.display === 'block') {
        dropdown.style.display = 'none';
      }
    }
  }