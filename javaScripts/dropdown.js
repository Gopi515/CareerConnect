function showDropdown() {
    document.getElementById("dropdownOptions").style.display = "block";
  }

  function selectOption(option) {
    document.getElementById("option4Input").value = option;
    document.getElementById("dropdownOptions").style.display = "none";
  }

  // Closing the dropdown
  window.onclick = function (event) {
    if (!event.target.matches('#option4Input')) {
      var dropdown = document.getElementById("dropdownOptions");
      if (dropdown.style.display === 'block') {
        dropdown.style.display = 'none';
      }
    }
  }