// Initialize an array to store selected languages
const selectedLanguages = [];

function showMenu() {
  const languages = document.getElementById("languages");
  const selectItemsButton = document.getElementById("select-items-button");
  const selectedItems = document.getElementById("selected-items");

  languages.style.display = "block";
  selectItemsButton.style.display = "none";
  selectedItems.style.display = "none";
}

function addToSelected() {
  const languageDropdown = document.querySelector('.language-dropdown');
  const selectedLanguage = languageDropdown.value;

  const writingDropdown = document.querySelector('.writingDropdown');
  const readingDropdown = document.querySelector('.readingDropdown');
  const listeningDropdown = document.querySelector('.listeningDropdown');
  const speakingDropdown = document.querySelector('.speakingDropdown');

  const writingProficiency = writingDropdown.value;
  const readingProficiency = readingDropdown.value;
  const listeningProficiency = listeningDropdown.value;
  const speakingProficiency = speakingDropdown.value;

  // Check if the language is already selected
  const existingLanguageIndex = selectedLanguages.findIndex(item => item.language === selectedLanguage);

  if (existingLanguageIndex !== -1) {
    // Update proficiency levels for the existing language
    selectedLanguages[existingLanguageIndex] = {
      language: selectedLanguage,
      proficiency: {
        writing: writingProficiency,
        reading: readingProficiency,
        listening: listeningProficiency,
        speaking: speakingProficiency
      }
    };
  } else {
    // Add the new language with proficiency levels to the array
    selectedLanguages.push({
      language: selectedLanguage,
      proficiency: {
        writing: writingProficiency,
        reading: readingProficiency,
        listening: listeningProficiency,
        speaking: speakingProficiency
      }
    });
  }

  updateSelectedItems();
}

function removeSelectedItem(index) {
  // Remove the selected language at the specified index
  selectedLanguages.splice(index, 1);
  updateSelectedItems();
}

function updateSelectedItems() {
  const selectedItemsList = document.getElementById("selected-items-list");
  selectedItemsList.innerHTML = "";

  // Display each selected language with proficiency levels
  selectedLanguages.forEach((item, index) => {
    const selectedItem = document.createElement("div");
    selectedItem.className = "selected-item";
    selectedItem.textContent = `${item.language}, 
      Writing: ${item.proficiency.writing},
      Reading: ${item.proficiency.reading},
      listening: ${item.proficiency.listening},
      speaking: ${item.proficiency.speaking}`;
    selectedItem.onclick = () => removeSelectedItem(index);
    selectedItemsList.appendChild(selectedItem);
  });

  const languages = document.getElementById("languages");
  const selectItemsButton = document.getElementById("select-items-button");
  const selectedItems = document.getElementById("selected-items");

  languages.style.display = "none";
  selectedItems.style.display = "block";
  selectItemsButton.style.display = "block";
}
