// Handle file upload and submit form on button click
const fileInput = document.getElementById("fileInput");
const form = document.forms.company_excel;

fileInput.addEventListener("change", function () {
  const files = this.files;
  handleFiles(files);

  // Display the name of the selected file
  if (files.length > 0) {
    document.getElementById("fileName").innerText =
      "Selected File: " + files[0].name;
  } else {
    document.getElementById("fileName").innerText = "";
  }
});

function handleFiles(files) {
  [...files].forEach(uploadFile);
}

function uploadFile(file) {
  const uploadResult = document.getElementById("uploadResult");
  uploadResult.innerHTML = `<p>File ${file.name} uploaded successfully!</p>`;
  // Optionally, you can submit the form here after file upload
  // form.submit();
}

// Submit form on button click
document.getElementById("submitBtn").addEventListener("click", function () {
  form.submit();
});
