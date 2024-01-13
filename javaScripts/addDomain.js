//  array of domain elements 
const elementsArray = ['AJAX', 'APIs', 'Adobe After Effects', 'Adobe Creative Suite', 'Adobe Illustrator', 'Adobe Photoshop', 'Adobe XD', 'Adobe Premiere Pro', 'Advanced Excel', 'Alogorithms', 'Amazon Web Service', 'Android App Development', 'Apache', 'Animation', 'Artificial Intelligence', 'AutoCAD', 'Automobile Engineering', 'Backend Development', 'Biology', 'Blender 3D', 'Blockchain', 'Bootstrap', 'Business Development', 'Blogging', 'C Programming', 'C#', 'C++', 'CSS', 'Canva', 'Cloud Computing', 'Civil Engineering', 'Computer Networks', 'Cyber Security', 'Creative Design', 'Dart', 'Data Analysis', 'Data Entry', 'Data Structures', 'Deep Learning', 'Design Thinking', 'Digital Art', 'Digital Marketing', 'Django', 'Docker', 'Effective Communication', 'Economics', 'Eclipse', 'Electrical Engineerning', 'Email Marketing', 'Engineering Design', 'Engineering Drawing', 'Express.js', 'Ethical Hacking', 'English Proficiency', 'Ethereum', 'Facebook Marketing', 'Facebook Ads', 'Fashion Design', 'Fashion Styling', 'Figma', 'FastAPI', 'Final Cut Pro', 'Finance', 'Firebase', 'Flutter', 'Flutter Development', 'Frontend Development', 'Full Stack Development', 'Flash', 'Game Design', 'Game Development', 'Git', 'Git Bash', 'GitHub', 'Gitlab', 'Graphic Design', 'Google Cloud Computing', 'Google Workspace', 'Google Sketchup', 'HTML', 'HTML&CSS', 'Human Resources', 'Hotel Management', 'Image Processing', 'Industrial & Production Engineering', 'Industrial Design', 'Instagram Marketing', 'Information Technology', 'Interior Design', 'Internet of Things', 'JSON', 'Java', 'JavaScript', 'JSP', 'Journalism', 'Kotlin', 'LARAVAl', 'League of Legends', 'linkdin Marketing', 'Linear Programming', 'Linux', 'MATLAB', 'MEAN Stack', 'MERN Stack', 'MySQL', 'MS-Excel', 'MS-Office', 'Maya', 'MS-PowerPoint', 'MS-Word', 'Machine Learning', 'MongoDB', 'Mobile App Development', 'Microsoft Visual Studio', 'Node.js', 'NoSQL', 'Next.js', 'Objective C', 'Online Teaching', 'Oracle', 'OpenCV', 'PHP', 'PayPal API', 'Photoshop', 'Product Management', 'Python', 'Psychology', 'Python/Django Development', 'Rest API', 'ReactJS', 'React', 'Redux', 'Ruby', 'Ruby on Rails', 'Rust', 'SQL', 'Search Engine Optimization', 'Sketch', 'Social Media Marketing', 'Social Work', 'Software Development', 'Sports', 'Stock Marketing', 'Stock Trading', 'Swift', 'Tailwind CSS', 'Tally', 'Teaching', 'TypeScript', 'Transcription', 'Training and Development', 'Translation', 'UI & UX Design', 'UI/UX Design', 'Unity', 'Unity 3D', 'Unity Engine', 'Unreal Engine', 'VS Code', 'Vue Js', 'Videography', 'Video Editing', 'Web Development', 'Web Application Security', 'Web Design', 'WordPress', 'Webflow', 'Wireframing', 'Windows Mobile Application Design', 'XML', 'Xcode', 'YouTube Ads', 'iOS', 'iOS App Development', 'jQuery', 'JavaScript', 'JS', 'ZBrush'];

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