function toggleCard(cardToShow) {
    if (cardToShow === 1) {
      document.getElementById("card1").style.display = "block";
      document.getElementById("card2").style.display = "none";
    } else if (cardToShow === 2) {
      document.getElementById("card1").style.display = "none";
      document.getElementById("card2").style.display = "block";
    }
  }