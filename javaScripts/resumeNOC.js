function displayResumeName() {
  var input = document.getElementById("resume");
  var output = document.getElementById("file-resume");
  if (input.files.length > 0) {
    output.innerText = "Selected file: " + input.files[0].name;
  } else {
    output.innerText = "";
  }
}

function displayNocName() {
  var input = document.getElementById("noc");
  var output = document.getElementById("file-noc");
  if (input.files.length > 0) {
    output.innerText = "Selected file: " + input.files[0].name;
  } else {
    output.innerText = "";
  }
}
