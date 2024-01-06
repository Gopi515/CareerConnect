const languages = document.getElementById("languages");
const selectedItems = document.getElementById("selected-items");
const selectItemsButton = document.getElementById("select-items-button");
const selectedItemsList = document.getElementById("selected-items-list");

function showMenu() {
  languages.style.display = "block";
  selectItemsButton.style.display = "none";
  selectedItems.style.display = "none";
  selectedItemsList.innerHTML = [];
}

function addToSelected() {
  const checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');
  if (checkboxes.length > 0) {
    selectedItemsList.innerHTML = [];

    for (const checkbox of checkboxes) {
      const selectedItem = document.createElement("div");
      selectedItem.className = "selected-item";
      selectedItem.textContent = checkbox.parentElement.textContent;
      selectedItem.onclick = () => removeSelectedItem(selectedItem, checkbox);
      selectedItemsList.appendChild(selectedItem);
    }

    languages.style.display = "none";
    selectedItems.style.display = "block";
    selectItemsButton.style.display = "block";
  }
}

function removeSelectedItem(item, checkbox) {
  item.remove();
  checkbox.checked = false;
}