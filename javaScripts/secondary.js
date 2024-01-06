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
  let status = document.querySelector('input[name="Xstatus"]:checked').value;
  let completionYearInput = document.querySelector(
    '.Xcompletionyear input[type="month"]'
  );
  let completionYear = formatDate(completionYearInput.value);
  let board = document.querySelector(".Xboard input").value;
  let school = document.querySelector(".Xschool input").value;
  let maxMarks = document.getElementById("maxMarks").value;
  let marksObtained = document.getElementById("marksObtained").value;
  let percentage = document.getElementById("Xpercentage").innerText;

  let detailId = "secondaryDetails";

  let secondaryDetailsString =
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

function calculatePercentage() {
  let maxMarks = document.getElementById("maxMarks").value;
  let marksObtained = document.getElementById("marksObtained").value;

  let percentage = (marksObtained / maxMarks) * 100;
  document.getElementById("Xpercentage").innerText =
    percentage.toFixed(2) + "%";
}
