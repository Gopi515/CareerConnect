function submitAndAddAnother() {
  document.getElementById("questionForm").action = "questionUpload.php";
}

function submitAndExit() {
  document.getElementById("questionForm").action =
    "../html/landingPage/landingTeacher.php";
}
