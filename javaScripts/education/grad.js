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

function updategradDetails() {
  let status = document.querySelector('input[name="gradstatus"]:checked').value;
  let startingYearInput = document.querySelector(
    '.gradstartyear input[type="month"]'
  );
  let completionYearInput = document.querySelector(
    '.gradcompletionyear input[type="month"]'
  );
  let startingYear = formatDate(startingYearInput.value);
  let completionYear = formatDate(completionYearInput.value);
  let school = document.querySelector(".gradschool input").value;
  let degree = document.querySelector(".gradDegree input").value;
  let stream = document.querySelector(".gradStream input").value;
  let maxMarks = document.getElementById("gradmaxMarks").value;
  let marksObtained = document.getElementById("gradmarksObtained").value;
  let percentage = document.getElementById("gradpercentage").innerText;

  let detailId = "gradDetails";

  let gradDetailsString =
    `<div id="${detailId}" class="gradeduDetailItem">` +
    "<strong>graduation/Post Graduation Details</strong><br>" +
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
    "Degree: " +
    degree +
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
    `<div class="edubtn" onclick="deletegradDetails('${detailId}')">Delete</div>` +
    "<br><br></div>";

  document.getElementById("graddetailsDisplay").innerHTML = gradDetailsString;

  closeGradPgradDetails();
}

function deletegradDetails(detailId) {
  let detailElement = document.getElementById(detailId);
  if (detailElement) {
    detailElement.remove();
    console.log("Deleted detail with ID:", detailId);
  }
}

function gradcalculatePercentage() {
  let maxMarks = document.getElementById("gradmaxMarks").value;
  let marksObtained = document.getElementById("gradmarksObtained").value;

  let percentage = (marksObtained / maxMarks) * 100;
  document.getElementById("gradpercentage").innerText =
    percentage.toFixed(2) + "%";
}
function gradcalculatePercentage() {
  let maxMarksInput = document.getElementById("gradmaxMarks");
  let marksObtainedInput = document.getElementById("gradmarksObtained");
  let percentageDisplay = document.getElementById("gradpercentage");

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
