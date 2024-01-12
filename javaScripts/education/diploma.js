function formatDate(completionYear) {
  let date = new Date(completionYear + "-01");
  let year = date.getFullYear();
  let month = getMonthName(date.getMonth() + 1);
  return year + ", " + month;
}

function getMonthName(monthValue) {
  let months = [
    "Jan",
    "Feb",
    "Mar",
    "Apr",
    "May",
    "Jun",
    "Jul",
    "Aug",
    "Sep",
    "Oct",
    "Nov",
    "Dec",
  ];
  return months[monthValue - 1];
}

function updatediplomaDetails() {
  let status = document.querySelector(
    'input[name="diplomastatus"]:checked'
  ).value;
  let completionYearInput = document.querySelector(
    '.diplomacompletionyear input[type="month"]'
  );
  let completionYear = formatDate(completionYearInput.value);
  let board = document.querySelector(".diplomaboard input").value;
  let school = document.querySelector(".diplomaschool input").value;
  let maxMarks = document.getElementById("diplomamaxMarks").value;
  let marksObtained = document.getElementById("diplomamarksObtained").value;
  let percentage = document.getElementById("diplomapercentage").innerText;

  let detailId = "diplomaDetails";

  let diplomaDetailsString =
    `<div id="${detailId}" class="diplomaeduDetailItem">` +
    "<strong>Diploma Details</strong><br>" +
    "Status: " +
    status +
    "<br>" +
    "Year of Completion: " +
    completionYear +
    "<br>" +
    "Board: " +
    board +
    "<br>" +
    "School: " +
    school +
    "<br>" +
    "Maximum Marks: " +
    maxMarks +
    "<br>" +
    "Marks Obtained: " +
    marksObtained +
    "<br>" +
    "Percentage: " +
    percentage +
    "<br>" +
    `<div class="edubtn" onclick="deletediplomaDetails('${detailId}')">Delete</div>` +
    "<br><br></div>";

  document.getElementById("diplomadetailsDisplay").innerHTML =
    diplomaDetailsString;

  closeDiplomaDetails();
}

function deletediplomaDetails(detailId) {
  let detailElement = document.getElementById(detailId);
  if (detailElement) {
    detailElement.remove();
    console.log("Deleted detail with ID:", detailId);
  }
}

function diplomacalculatePercentage() {
  let maxMarks = document.getElementById("diplomamaxMarks").value;
  let marksObtained = document.getElementById("diplomamarksObtained").value;

  let percentage = (marksObtained / maxMarks) * 100;
  document.getElementById("diplomapercentage").innerText =
    percentage.toFixed(2) + "%";
}
function diplomacalculatePercentage() {
  let maxMarksInput = document.getElementById("diplomamaxMarks");
  let marksObtainedInput = document.getElementById("diplomamarksObtained");
  let percentageDisplay = document.getElementById("diplomapercentage");

  let maxMarks = parseFloat(maxMarksInput.value);
  let marksObtained = parseFloat(marksObtainedInput.value);

  // Checking if obtained marks are greater than maximum marks
  if (marksObtained > maxMarks) {
    marksObtainedInput.value = maxMarks;
    marksObtained = maxMarks;
  }

  let percentage = (marksObtained / maxMarks) * 100;
  percentageDisplay.innerText = percentage.toFixed(2) + "%";
}
