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
  "AJAX",
  "APIs",
  "Adobe After Effects",
  "Adobe Illustrator",
  "Adobe Photoshop",
  "Adobe XD",
  "Adobe Premiere Pro",
  "Advanced Excel",
  "Alogorithms",
  "Amazon Web Service",
  "Android App Development",
  "Apache",
  "Artificial Intelligence",
  "AutoCAD",
  "Automobile Engineering",
  "Backend Development",
  "Biology",
  "Blender 3D",
  "Blockchain",
  "Bootstrap",
  "Business Development",
  "C Programming",
  "C#",
  "Canva",
  "Cloud Computing",
  "Civil Engineering",
  "Computer Networks",
  "Cyber Security",
  "Creative Design",
  "Dart",
  "Data Entry",
  "Data Structures",
  "Deep Learning",
  "Design Thinking",
  "Digital Art",
  "Economics",
  "Eclipse",
  "Electrical Engineerning",
  "Engineering Design",
  "Engineering Drawing",
  "Express.js",
  "Effective Communication",
  "Ethereum",
  "Facebook Marketing",
  "Facebook Ads",
  "Fashion Design",
  "Fashion Styling",
  "FastAPI",
  "Final Cut Pro",
  "Finance",
  "Firebase",
  "Flutter",
  "Frontend Development",
  "Full Stack Development",
  "Flash",
  "Game Design",
  "Game Development",
  "Git Bash",
  "GitHub",
  "Gitlab",
  "Google Cloud Computing",
  "Google Workspace",
  "Google Sketchup",
  "Human Resources",
  "Hotel Management",
  "Image Processing",
  "Industrial Design",
  "Instagram Marketing",
  "Information Technology",
  "Interior Design",
  "Internet of Things",
  "JSON",
  "JSP",
  "Journalism",
  "Kotlin",
  "LARAVAl",
  "League of Legends",
  "linkdin Marketing",
  "Linear Programming",
  "MATLAB",
  "MEAN Stack",
  "MERN Stack",
  "MySQL",
  "MS-Excel",
  "MS-Office",
  "Maya",
  "MS-PowerPoint",
  "MS-Word",
  "Mobile App Development",
  "Microsoft Visual Studio",
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
  "Psychology",
  "Rest API",
  "ReactJS",
  "React",
  "Redux",
  "Ruby",
  "Rust",
  "Search Engine Optimization",
  "Social Work",
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
  "Unity",
  "Unity 3D",
  "Unity Engine",
  "Unreal Engine",
  "VS Code",
  "Vue Js",
  "Videography",
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
  "jQuery",
  "JS",
  "ZBrush",
];

let addedElements = [];

function openskillPopup() {
  const popupContainer = document.getElementById("popupskillContainer");
  const elementsContainer = document.getElementById("elementsskillContainer");

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
  const popupContainer = document.getElementById("popupskillContainer");
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
  const elementsContainer = document.getElementById("elementsskillContainer");
  const elementsList = elementsContainer.getElementsByClassName("element");

  Array.from(elementsList).forEach((element) => {
    const text = element
      .getElementsByTagName("span")[0]
      .innerText.toLowerCase();
    const displayStyle = text.includes(searchInput) ? "flex" : "none";
    element.style.display = displayStyle;
  });
}
