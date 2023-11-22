const teacherButton = document.getElementById("teacherButton");
const studentButton = document.getElementById("studentButton");
const companyButton = document.getElementById("companyButton");
const submitButton = document.getElementById("submitButton");

// console.log (teacherButton.e.target.value)

let selectedOption = null;

teacherButton.addEventListener("click", function () {
  selectedOption = "../profiles/teacher/teacher.html";
});

studentButton.addEventListener("click", function () {
  selectedOption = "../profiles/student/student.html";
});

companyButton.addEventListener("click", function () {
  selectedOption = "../profiles/company/company.html";
});

submitButton.addEventListener("click", function () {
  if (selectedOption) {
    window.location.href = selectedOption;
  } else {
    alert("Please select one option.");
  }
});
