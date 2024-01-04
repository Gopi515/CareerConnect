function showDropdown() {
    document.getElementById("dropdownOptions").style.display = "block";
    document.getElementById("dropdownoptionsJob").style.display = "block";
    document.getElementById("dropdownOptionsPost").style.display = "block";
  }

  function selectOption(option) {
    document.getElementById("option4Input").value = option;
    document.getElementById("joboption4input").value = option;
    document.getElementById("postOptions").value = option;
    document.getElementById("option4Inputjob").style.display = "none";
    document.getElementById("dropdownoptionsJob").style.display = "none";
    document.getElementById("dropdownOptionsPost").style.display = "none";
  }

  // Closing the dropdown
  window.onclick = function (event) {
    if (!event.target.matches('#option4Input')) {
      var dropdown = document.getElementById("dropdownOptions");
      if (dropdown.style.display === 'block') {
        dropdown.style.display = 'none';
      }
    }
    if (!event.target.matches('#option4Inputjob')) {
      var dropdown = document.getElementById("dropdownoptionsJob");
      if (dropdown.style.display === 'block') {
        dropdown.style.display = 'none';
      }
    }
    if (!event.target.matches('#postOptions')) {
      var dropdown = document.getElementById("dropdownOptionsPost");
      if (dropdown.style.display === 'block') {
        dropdown.style.display = 'none';
      }
    }
  }
  