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

function updatePhDDetails() {
  let status = document.querySelector('input[name="PhDstatus"]:checked').value;
  let startingYearInput = document.querySelector(
    '.PhDstartyear input[type="month"]'
  );
  let completionYearInput = document.querySelector(
    '.PhDcompletionyear input[type="month"]'
  );
  let startingYear = formatDate(startingYearInput.value);
  let completionYear = formatDate(completionYearInput.value);
  let school = document.querySelector(".PhDschool input").value;
  let stream = document.querySelector(".PhDstream input").value;
  let maxMarks = document.getElementById("PhDmaxMarks").value;
  let marksObtained = document.getElementById("PhDmarksObtained").value;
  let percentage = document.getElementById("PhDpercentage").innerText;

  let detailId = "PhDDetails";

  let PhDDetailsString =
    `<div id="${detailId}" class="PhDeduDetailItem">` +
    "<strong>PhD Details</strong><br>" +
    "Status: " +
    status +
    "<br>" +
    "Starting Year: " +
    startingYear +
    "<br>" +
    "Year of Completion: " +
    completionYear +
    "<br>" +
    "College: " +
    school +
    "<br>" +
    "Stream: " +
    stream +
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
    `<div class="edubtn" onclick="deletePhDDetails('${detailId}')">Delete</div>` +
    "<br><br></div>";

  document.getElementById("PhDdetailsDisplay").innerHTML = PhDDetailsString;

  closePhDDetails();
}

function deletePhDDetails(detailId) {
  let detailElement = document.getElementById(detailId);
  if (detailElement) {
    detailElement.remove();
    console.log("Deleted detail with ID:", detailId);
  }
}

function PhDcalculatePercentage() {
  let maxMarks = document.getElementById("PhDmaxMarks").value;
  let marksObtained = document.getElementById("PhDmarksObtained").value;

  let percentage = (marksObtained / maxMarks) * 100;
  document.getElementById("PhDpercentage").innerText =
    percentage.toFixed(2) + "%";
}
function PhDcalculatePercentage() {
  let maxMarksInput = document.getElementById("PhDmaxMarks");
  let marksObtainedInput = document.getElementById("PhDmarksObtained");
  let percentageDisplay = document.getElementById("PhDpercentage");

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
