function isFooterApproaching(el) {
  const rect = el.getBoundingClientRect();
  return rect.top < window.innerHeight;
}

function checkFooterVisibility() {
  const footer = document.querySelector(".footerMainlanding");
  const navbar = document.querySelector(".navbar");

  if (isFooterApproaching(footer)) {
    // If the footer starts entering the viewport, hide the navbar
    navbar.style.display = "none";
  } else {
    // Otherwise, show the navbar
    navbar.style.display = "flex";
  }
}
