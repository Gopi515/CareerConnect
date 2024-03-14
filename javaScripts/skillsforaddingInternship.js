const elements = [
  "Accounting",
  "Adobe Creative Suite",
  "Agile/Scrum",
  "Angular",
  "Animation",
  "AWS",
  "Blogging",
  "Budgeting",
  "C++",
  "Content Marketing",
  "Content Writing",
  "Copywriting",
  "Cryptography",
  "CSS",
  "Data Analysis",
  "Data Science",
  "Decision Making",
  "Django",
  "Docker",
  "Digital Marketing",
  "Editing",
  "Element 10",
  "Element 3",
  "Element 4",
  "Element 5",
  "Element 6",
  "Element 7",
  "Element 8",
  "Element 9",
  "Email Marketing",
  "Ethical Hacking",
  "Excel",
  "Figma",
  "Financial Analysis",
  "Financial Modeling",
  "Firewall Configuration",
  "Git",
  "Google Analytics",
  "Graphic Design",
  "HTML",
  "Illustration",
  "Investment Analysis",
  "Java",
  "JavaScript",
  "Jenkins",
  "Kubernetes",
  "Leadership",
  "Linux",
  "Machine Learning",
  "MongoDB",
  "Networking",
  "Node.js",
  "Penetration Testing",
  "Photography",
  "PPC",
  "Project Management",
  "Prototyping",
  "PyTorch",
  "Python",
  "React.js",
  "Risk Management",
  "Ruby on Rails",
  "Search Engine Optimization",
  "SEM",
  "SEO",
  "Sketch",
  "Social Media Marketing",
  "Software Development",
  "SQL",
  "Statistics",
  "Tableau",
  "Team Collaboration",
  "Technical Writing",
  "TensorFlow",
  "Time Management",
  "Typography",
  "UI/UX Design",
  "Video Editing",
  "Web Development",
];

let addedElements = [];

function openskillPopuptwo() {
  const popupContainer = document.getElementById("popupskillContainertwo");
  const elementsContainer = document.getElementById(
    "elementsskillContainertwo"
  );

  elementsContainer.innerHTML = "";

  elements.forEach((element) => {
    const elementDiv = document.createElement("div");
    elementDiv.classList.add("element");
    elementDiv.innerHTML = `
        <span>${element}</span>
        <div onclick="addElement('${element}')">+</div>
      `;
    elementsContainer.appendChild(elementDiv);
  });

  popupContainer.style.display = "block";
  popupContainer.classList.remove("hidden");
}

function closePopup() {
  const popupContainer = document.getElementById("popupskillContainertwo");
  popupContainer.style.display = "none";
}

function addElement(element) {
  if (!addedElements.includes(element)) {
    const addedElementsContainer = document.getElementById("addedElements");
    const elementDiv = document.createElement("div");
    elementDiv.classList.add("addedElement");
    elementDiv.innerHTML = `
      ${element}
      <span class="removeButton" onclick="removeElement(this)">×</span>
    `;
    addedElementsContainer.appendChild(elementDiv);
    addedElements.push(element);

    // Updating the value of the existing hidden input field
    document.getElementById("addedSkillsInput").value =
      JSON.stringify(addedElements);
  } else {
    alert("Element already added!");
  }
}

function removeElement(elementSpan) {
  const addedElementsContainer = document.getElementById("addedElements");
  const elementToRemove = elementSpan.parentNode.textContent.trim();
  addedElements = addedElements.filter(
    (element) => element !== elementToRemove
  );
  addedElementsContainer.removeChild(elementSpan.parentNode);
}

function filterElements() {
  const searchInput = document.getElementById("searchBar").value.toLowerCase();
  const elementsContainer = document.getElementById(
    "elementsskillContainertwo"
  );
  const elementsList = elementsContainer.getElementsByClassName("element");

  Array.from(elementsList).forEach((element) => {
    const text = element
      .getElementsByTagName("span")[0]
      .innerText.toLowerCase();
    const displayStyle = text.includes(searchInput) ? "flex" : "none";
    element.style.display = displayStyle;
  });
}