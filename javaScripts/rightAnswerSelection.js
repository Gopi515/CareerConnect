// JavaScript code for handling right answer selection

let selectedAnswer = null; // Variable to store the selected answer

// Function to handle right answer selection
function handleRightAnswerSelection() {
  const rightAnswerSelect = document.getElementById("rightAnswer");
  rightAnswerSelect.addEventListener("change", function () {
    selectedAnswer = rightAnswerSelect.value;
  });
}

// Call the function to initialize right answer selection
handleRightAnswerSelection();
