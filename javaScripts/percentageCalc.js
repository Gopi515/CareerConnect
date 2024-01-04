let detailCounter = 1;

function updateSecondaryDetails() {
  var status = document.querySelector('input[name="Xstatus"]:checked').value;
  var completionYearInput = document.querySelector(
    '.Xcompletionyear input[type="month"]'
  );
  var completionYear = formatDate(completionYearInput.value);
  var board = document.querySelector(".Xboard input").value;
  var school = document.querySelector(".Xschool input").value;
  var maxMarks = document.getElementById("maxMarks").value;
  var marksObtained = document.getElementById("marksObtained").value;
  var percentage = document.getElementById("Xpercentage").innerText;

  // Generating a unique identifier
  let detailId = "detail_" + detailCounter++;

  var secondaryDetailsString =
    `<div id="${detailId}" class="eduDetailItem">` +
    "<strong>Secondary (X) Details</strong><br>" +
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
    `<button onclick="deleteSecondaryDetails('${detailId}')">Delete</button>` +
    "<br><br></div>";

  document.getElementById("XdetailsDisplay").innerHTML +=
    secondaryDetailsString;

  closeSecondaryDetails();
}

function formatDate(completionYear) {
  var date = new Date(completionYear + "-01");
  var year = date.getFullYear();
  var month = getMonthName(date.getMonth() + 1);
  return year + ", " + month;
}

// Function to get the month name
function getMonthName(monthValue) {
  var months = [
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

function deleteSecondaryDetails(detailId) {
  let detailElement = document.getElementById(detailId);
  if (detailElement) {
    detailElement.remove();
    console.log("Deleted detail with ID:", detailId);
  }
}

function calculatePercentage() {
  var maxMarks = document.getElementById("maxMarks").value;
  var marksObtained = document.getElementById("marksObtained").value;

  var percentage = (marksObtained / maxMarks) * 100;
  document.getElementById("Xpercentage").innerText =
    percentage.toFixed(2) + "%";
}
