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

function updateSeniorSecDetails() {
  let completionYearInput = document.querySelector(
    '.XIIcompletionyear input[type="month"]'
  );
  let completionYear = formatDate(completionYearInput.value);
  let board = document.querySelector(".XIIboard input").value;
  let school = document.querySelector(".XIIschool input").value;
  let maxMarks = document.getElementById("XIImaxMarks").value;
  let marksObtained = document.getElementById("XIImarksObtained").value;
  let percentage = document.getElementById("XIIpercentage").innerText;

  let detailId = "SeniorSecDetails";

  let seniorSecDetailsString =
    `<div id="${detailId}" class="XIIeduDetailItem">` +
    "<strong>Senior/Higher Secondary (XII) Details</strong><br>" +
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
    `<div class="edubtn" onclick="deleteSeniorSecDetails('${detailId}')">Delete</div>` +
    "<br><br></div>";

  document.getElementById("XIIdetailsDisplay").innerHTML =
    seniorSecDetailsString;

  closeSeniorSecDetails();
}

function deleteSeniorSecDetails(detailId) {
  let detailElement = document.getElementById(detailId);
  if (detailElement) {
    detailElement.remove();
    console.log("Deleted detail with ID:", detailId);
  }
}

function XIIcalculatePercentage() {
  let maxMarksInput = document.getElementById("XIImaxMarks");
  let marksObtainedInput = document.getElementById("XIImarksObtained");
  let percentageDisplay = document.getElementById("XIIpercentage");

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
