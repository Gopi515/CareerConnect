function startTimer() {
  const timerElement = document.getElementById("timer");
  const examForm = document.getElementById("examForm");

  let endTime = localStorage.getItem("endTime");

  if (!endTime) {
    endTime = Date.now() + 15 * 60 * 1000;
    localStorage.setItem("endTime", endTime);
  }

  const interval = setInterval(() => {
    const now = Date.now();
    const timeLeft = Math.floor((endTime - now) / 1000);

    if (timeLeft <= 0) {
      clearInterval(interval);
      localStorage.removeItem("endTime");
      document.getElementById("autoSubmit").value = "1";
      examForm.submit();
      return;
    }

    const minutes = Math.floor(timeLeft / 60);
    const seconds = timeLeft % 60;

    timerElement.textContent = `${minutes}:${
      seconds < 10 ? "0" : ""
    }${seconds}`;
  }, 1000);
}

window.onload = startTimer;

let formSubmitted = false;

document.getElementById("examForm").addEventListener("submit", function () {
  formSubmitted = true;
  localStorage.removeItem("endTime");
});

window.addEventListener("beforeunload", function (e) {
  if (formSubmitted) {
    return undefined;
  }

  const message =
    "Are you sure you want to refresh the page or go back and restart the test? All the saved data will be lost.";
  e.returnValue = message;
  return message;
});
