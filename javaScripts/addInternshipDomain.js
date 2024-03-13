const elements = [
  "AJAX",
  "APIs",
  "Adobe After Effects",
  "Adobe Creative Suite",
  "Adobe Illustrator",
  "Adobe Photoshop",
  "Adobe XD",
  "Adobe Premiere Pro",
  "Advanced Excel",
  "Alogorithms",
  "Amazon Web Service",
  "Android App Development",
  "Apache",
  "Animation",
  "Artificial Intelligence",
  "AutoCAD",
  "Automobile Engineering",
  "Backend Development",
  "Biology",
  "Blender 3D",
  "Blockchain",
  "Bootstrap",
  "Business Development",
  "Blogging",
  "C Programming",
  "C#",
  "C++",
  "CSS",
  "Canva",
  "Cloud Computing",
  "Civil Engineering",
  "Computer Networks",
  "Cyber Security",
  "Creative Design",
  "Dart",
  "Data Analysis",
  "Data Entry",
  "Data Structures",
  "Deep Learning",
  "Design Thinking",
  "Digital Art",
  "Digital Marketing",
  "Django",
  "Docker",
  "Effective Communication",
  "Economics",
  "Eclipse",
  "Electrical Engineerning",
  "Email Marketing",
  "Engineering Design",
  "Engineering Drawing",
  "Express.js",
  "Ethical Hacking",
  "English Proficiency",
  "Ethereum",
  "Facebook Marketing",
  "Facebook Ads",
  "Fashion Design",
  "Fashion Styling",
  "Figma",
  "FastAPI",
  "Final Cut Pro",
  "Finance",
  "Firebase",
  "Flutter",
  "Flutter Development",
  "Frontend Development",
  "Full Stack Development",
  "Flash",
  "Game Design",
  "Game Development",
  "Git",
  "Git Bash",
  "GitHub",
  "Gitlab",
  "Graphic Design",
  "Google Cloud Computing",
  "Google Workspace",
  "Google Sketchup",
  "HTML",
  "HTML&CSS",
  "Human Resources",
  "Hotel Management",
  "Image Processing",
  "Industrial & Production Engineering",
  "Industrial Design",
  "Instagram Marketing",
  "Information Technology",
  "Interior Design",
  "Internet of Things",
  "JSON",
  "Java",
  "JavaScript",
  "JSP",
  "Journalism",
  "Kotlin",
  "LARAVAl",
  "League of Legends",
  "linkdin Marketing",
  "Linear Programming",
  "Linux",
  "MATLAB",
  "MEAN Stack",
  "MERN Stack",
  "MySQL",
  "MS-Excel",
  "MS-Office",
  "Maya",
  "MS-PowerPoint",
  "MS-Word",
  "Machine Learning",
  "MongoDB",
  "Mobile App Development",
  "Microsoft Visual Studio",
  "Node.js",
  "NoSQL",
  "Next.js",
  "Objective C",
  "Online Teaching",
  "Oracle",
  "OpenCV",
  "PHP",
  "PayPal API",
  "Photoshop",
  "Product Management",
  "Python",
  "Psychology",
  "Python/Django Development",
  "Rest API",
  "ReactJS",
  "React",
  "Redux",
  "Ruby",
  "Ruby on Rails",
  "Rust",
  "SQL",
  "Search Engine Optimization",
  "Sketch",
  "Social Media Marketing",
  "Social Work",
  "Software Development",
  "Sports",
  "Stock Marketing",
  "Stock Trading",
  "Swift",
  "Tailwind CSS",
  "Tally",
  "Teaching",
  "TypeScript",
  "Transcription",
  "Training and Development",
  "Translation",
  "UI & UX Design",
  "UI/UX Design",
  "Unity",
  "Unity 3D",
  "Unity Engine",
  "Unreal Engine",
  "VS Code",
  "Vue Js",
  "Videography",
  "Video Editing",
  "Web Development",
  "Web Application Security",
  "Web Design",
  "WordPress",
  "Webflow",
  "Wireframing",
  "Windows Mobile Application Design",
  "XML",
  "Xcode",
  "YouTube Ads",
  "iOS",
  "iOS App Development",
  "jQuery",
  "JavaScript",
  "JS",
  "ZBrush",
];

let addedElements = [];

function openPopup() {
  const popupContainer = document.getElementById("popupContainer");
  const elementsContainer = document.getElementById("elementsContainer");

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
  const popupContainer = document.getElementById("popupContainer");
  popupContainer.style.display = "none";
}

function addElement(element) {
  if (!addedElements.includes(element)) {
    const addedElementsContainer = document.getElementById("addedElements");
    const elementDiv = document.createElement("div");
    elementDiv.classList.add("addedElement");
    elementDiv.innerHTML = `
      ${element}
      <span class="removeButton" onclick="removeElement(this)">X</span>
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
  const elementsContainer = document.getElementById("elementsContainer");
  const elementsList = elementsContainer.getElementsByClassName("element");

  Array.from(elementsList).forEach((element) => {
    const text = element
      .getElementsByTagName("span")[0]
      .innerText.toLowerCase();
    const displayStyle = text.includes(searchInput) ? "flex" : "none";
    element.style.display = displayStyle;
  });
}
