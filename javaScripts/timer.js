// Function to start the timer
function startTimer() {
  const timerElement = document.getElementById("timer");
  const examForm = document.getElementById("examForm");

  let endTime = sessionStorage.getItem("endTime");

  if (!endTime) {
    endTime = Date.now() + 15 * 60 * 1000; // Set the end time to 15 minutes from now
    sessionStorage.setItem("endTime", endTime); // Save the end time in sessionStorage
  }

  // Calculate and display the time remaining
  const interval = setInterval(() => {
    const now = Date.now();
    const timeLeft = Math.floor((endTime - now) / 1000);

    if (timeLeft <= 0) {
      clearInterval(interval); // Stop the timer if time is up
      sessionStorage.removeItem("endTime"); // Remove the end time from sessionStorage
      document.getElementById("autoSubmit").value = "1"; // Auto-submit the form
      examForm.submit(); // Submit the form
      return;
    }

    const minutes = Math.floor(timeLeft / 60);
    const seconds = timeLeft % 60;

    timerElement.textContent = `${minutes}:${
      seconds < 10 ? "0" : ""
    }${seconds}`; // Display the time remaining
  }, 1000); // Update the timer every second
}

// Event listener to start the timer when the window loads
window.onload = startTimer;

// Variable to track if the form is submitted
let formSubmitted = false;

// Event listener to mark the form as submitted
document.getElementById("examForm").addEventListener("submit", function () {
  formSubmitted = true;
  sessionStorage.removeItem("endTime"); // Remove the end time from sessionStorage when the form is submitted
});

// Function to reset the timer
function resetTimer() {
  sessionStorage.removeItem("endTime"); // Remove the end time from sessionStorage
}

// Event listener for the "go back" button
document.querySelector(".goBack").addEventListener("click", function () {
  resetTimer(); // Reset the timer when the user clicks the "go back" button
});

// Event listener for the popstate event (back/forward button of the browser)
window.addEventListener("popstate", function () {
  if (!formSubmitted) {
    resetTimer(); // Reset the timer when the user navigates back/forward
  }
});

// Event listener for the beforeunload event to warn the user about leaving the page
window.addEventListener("beforeunload", function (e) {
  if (!formSubmitted) {
    const confirmationMessage =
      "Are you sure you want to leave? Your exam progress will be lost.";
    e.returnValue = confirmationMessage; // Gecko, Trident, Chrome 34+
    return confirmationMessage; // Gecko, WebKit, Chrome <34
  }
});
