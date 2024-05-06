// Function to close all other dropdowns except the current one
function closeOtherDropdowns(currentArrowParent) {
  document.querySelectorAll(".arrow").forEach((arrow) => {
    let arrowParent = arrow.parentElement.parentElement;
    if (
      arrowParent !== currentArrowParent &&
      arrowParent.classList.contains("showMenu")
    ) {
      arrowParent.classList.remove("showMenu");
    }
  });
}

// Function to toggle the dropdown menu
function toggleDropdown(arrowParent) {
  arrowParent.classList.toggle("showMenu");
}

// Event listener for dropdown menu
document.addEventListener("click", (e) => {
  if (e.target.classList.contains("arrow")) {
    let arrowParent = e.target.parentElement.parentElement; // Selecting main parent of arrow
    closeOtherDropdowns(arrowParent);
    toggleDropdown(arrowParent);
  }
});

// Sidebar Toggle
let sidebar = document.querySelector(".sidebar");
sidebar.addEventListener("mouseover", () => {
  sidebar.classList.remove("close");
});

sidebar.addEventListener("mouseleave", () => {
  sidebar.classList.add("close");
});
