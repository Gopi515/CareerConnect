//  array of domain elements 
const elementsArray = ['Web development', 'UI/UX design', 'Business Development', 'Digital marketing', 'Teaching'];

// Function to open the popup
document.getElementById('add-element-btn').addEventListener('click', openPopup);

function openPopup() {
  const popupContainer = document.getElementById('popup-container');
  const elementList = document.getElementById('element-list');
  const searchBar = document.getElementById('search-bar');

  // Reset the content
  elementList.innerHTML = '';

  // Populating the list dynamically
  elementsArray.forEach(element => {
    const listItem = document.createElement('li');
    listItem.className = 'element-item';

    const checkbox = document.createElement('input');
    checkbox.type = 'checkbox';
    checkbox.className = 'element-checkbox';

    const label = document.createElement('label');
    label.textContent = element;

    listItem.appendChild(checkbox);
    listItem.appendChild(label);

    elementList.appendChild(listItem);
  });

  // Show the add button
  document.getElementById('add-button').style.display = 'block';

  // Show the popup
  popupContainer.style.display = 'block';

  // event listener for search bar
  searchBar.addEventListener('input', filterElements);
}

// Function to close the popup
function closePopup() {
  document.getElementById('popup-container').style.display = 'none';
}

// Function to add selected elements to the page
function addElement() {
  const selectedElements = document.querySelectorAll('.element-item input:checked');
  const elementsToAdd = Array.from(selectedElements).map(element => element.nextElementSibling.textContent);

  // Adding the selected elements to the page
  const pageContainer = document.body;
  elementsToAdd.forEach(element => {
    const newElement = document.createElement('div');
    newElement.textContent = element;
    newElement.className = 'added-element';
    newElement.addEventListener('click', removeElement);
    pageContainer.appendChild(newElement);
  });

  // Close the popup
  closePopup();
}

// Function to filter elements based on search bar input
function filterElements() {
  const searchTerm = document.getElementById('search-bar').value.toLowerCase();
  const elementItems = document.querySelectorAll('.element-item');

  elementItems.forEach(item => {
    const label = item.querySelector('label');
    const isVisible = label.textContent.toLowerCase().includes(searchTerm);
    item.style.display = isVisible ? 'flex' : 'none';
  });
}

// Function to remove the clicked element
function removeElement() {
  this.remove();
}