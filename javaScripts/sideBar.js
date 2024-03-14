// for the dropdown menu
let arrow = document.querySelectorAll(".arrow");
for (var i = 0; i < arrow.length; i++) {
  arrow[i].addEventListener("click", (e) => {
    let arrowParent = e.target.parentElement.parentElement; //selecting main parent of arrow
    arrowParent.classList.toggle("showMenu");
  });
}

let sidebar = document.querySelector(".sidebar");
sidebar.addEventListener("mouseover", () => {
  sidebar.classList.remove("close");
});

sidebar.addEventListener("mouseleave", () => {
  sidebar.classList.add("close");
});
