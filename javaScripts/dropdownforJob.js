function showJobdropdown() {
  document.getElementById("dropdownoptionsJob").style.display = "block";
}

function selectJoboption(option) {
  document.getElementById("option4Inputjob").value = option;
  document.getElementById("dropdownoptionsJob").style.display = "none";
}

// Closing the job dropdown
window.onclick = function (event) {
  if (!event.target.matches("#option4Inputjob")) {
    var dropdown = document.getElementById("dropdownoptionsJob");
    if (dropdown.style.display === "block") {
      dropdown.style.display = "none";
    }
  }
};
