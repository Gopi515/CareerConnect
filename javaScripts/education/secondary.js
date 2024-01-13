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

function updateSecondaryDetails() {
  let completionYearInput = document.querySelector(
    '.Xcompletionyear input[type="month"]'
  );
  let completionYear = formatDate(completionYearInput.value);
  let board = document.querySelector(".Xboard input").value;
  let school = document.querySelector(".Xschool input").value;
  let maxMarks = document.getElementById("XmaxMarks").value;
  let marksObtained = document.getElementById("XmarksObtained").value;
  let percentage = document.getElementById("Xpercentage").innerText;

  let detailId = "secondaryDetails";

  let secondaryDetailsString =
    `<div id="${detailId}" class="XeduDetailItem">` +
    "<strong>Secondary (X) Details</strong><br>" +
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
    `<div class="edubtn" onclick="deleteSecondaryDetails('${detailId}')">Delete</div>` +
    "<br><br></div>";

  document.getElementById("XdetailsDisplay").innerHTML = secondaryDetailsString;

  closeSecondaryDetails();
}

function deleteSecondaryDetails(detailId) {
  let detailElement = document.getElementById(detailId);
  if (detailElement) {
    detailElement.remove();
    console.log("Deleted detail with ID:", detailId);
  }
}

function XcalculatePercentage() {
  let maxMarks = document.getElementById("XmaxMarks").value;
  let marksObtained = document.getElementById("XmarksObtained").value;

  let percentage = (marksObtained / maxMarks) * 100;
  document.getElementById("Xpercentage").innerText =
    percentage.toFixed(2) + "%";
}
function XcalculatePercentage() {
  let maxMarksInput = document.getElementById("XmaxMarks");
  let marksObtainedInput = document.getElementById("XmarksObtained");
  let percentageDisplay = document.getElementById("Xpercentage");

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
