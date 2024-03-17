function logOut() {
  // Send AJAX request to PHP script to end the session
  var xhr = new XMLHttpRequest(); // Create XMLHttpRequest object
  xhr.open("GET", "../profiles/admin/logOut.php", true); // Open the file
  xhr.onreadystatechange = function () {
    // When the request is completed
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      // Redirect user to main Landing Page after session is ended
      window.location.href = "../MainLanding/mainLanding.php";
    }
  };
  xhr.send(); // Send the request
}
