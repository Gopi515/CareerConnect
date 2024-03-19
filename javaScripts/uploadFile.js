// Handle file upload
const dropArea = document.getElementById("dropArea");
const fileInput = document.getElementById("fileInput");
const form = document.forms.company_excel;

["dragenter", "dragover", "dragleave", "drop"].forEach((eventName) => {
  dropArea.addEventListener(eventName, preventDefaults, false);
});

function preventDefaults(e) {
  e.preventDefault();
  e.stopPropagation();
}

["dragenter", "dragover"].forEach((eventName) => {
  dropArea.addEventListener(eventName, highlight, false);
});

["dragleave", "drop"].forEach((eventName) => {
  dropArea.addEventListener(eventName, unhighlight, false);
});

function highlight() {
  dropArea.classList.add("highlight");
}

function unhighlight() {
  dropArea.classList.remove("highlight");
}

dropArea.addEventListener("drop", handleDrop, false);

function handleDrop(e) {
  const dt = e.dataTransfer;
  const files = dt.files;

  handleFiles(files);
}

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

// Close modal function
function closexlsxC() {
  document.getElementById("uploadModal").style.display = "none";
}
