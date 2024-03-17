const elements = [
  "AJAX",
  "ALOGORITHMS",
  "AMAZON WEB SERVICE",
  "ANDROID APP DEVELOPMENT",
  "ANGULAR",
  "ANIMATION",
  "APACHE",
  "APIs",
  "APIS",
  "ARTIFICIAL INTELLIGENCE",
  "AUTOCAD",
  "AUTOMOBILE ENGINEERING",
  "AWS",
  "BACKEND DEVELOPMENT",
  "BIOLOGY",
  "BLOCKCHAIN",
  "BLOGGING",
  "BOOTSTRAP",
  "BUSINESS DEVELOPMENT",
  "Budgeting",
  "C",
  "C#",
  "C++",
  "CANVA",
  "CIVIL ENGINEERING",
  "CLOUD COMPUTING",
  "COMPUTER NETWORKS",
  "CONTENT MARKETING",
  "CONTENT WRITING",
  "COPYWRITING",
  "CREATIVE DESIGN",
  "CSS",
  "CYBER SECURITY",
  "DATA ANALYSIS",
  "DATA ENTRY",
  "DATA SCIENCE",
  "DATA STRUCTURES",
  "DECISION MAKING",
  "DEEP LEARNING",
  "DESIGN THINKING",
  "DJANGO",
  "DART",
  "DOCKER",
  "DIGITAL ART",
  "DIGITAL MARKETING",
  "EDITING",
  "EMAIL MARKETING",
  "ETHICAL HACKING",
  "ECONOMICS",
  "ECLIPSE",
  "EFFECTIVE COMMUNICATION",
  "ELECTRICAL ENGINEERNING",
  "ENGINEERING DESIGN",
  "ENGINEERING DRAWING",
  "ETHEREUM",
  "EXPRESS.JS",
  "FACEBOOK ADS",
  "FACEBOOK MARKETING",
  "FASHION DESIGN",
  "FASHION STYLING",
  "FASTAPI",
  "FINAL CUT PRO",
  "FINANCE",
  "FINANCIAL ANALYSIS",
  "FINANCIAL MODELING",
  "FIREBASE",
  "FIREWALL CONFIGURATION",
  "FLASH",
  "FLUTTER",
  "FRONTEND DEVELOPMENT",
  "FULL STACK DEVELOPMENT",
  "FIGMA",
  "GIT",
  "GIT BASH",
  "GITHUB",
  "GITLAB",
  "GAME DESIGN",
  "GAME DEVELOPMENT",
  "GOOGLE ANALYTICS",
  "GOOGLE CLOUD COMPUTING",
  "GOOGLE SKETCHUP",
  "GOOGLE WORKSPACE",
  "GRAPHIC DESIGN",
  "HOTEL MANAGEMENT",
  "HUMAN RESOURCES",
  "HTML",
  "ILLUSTRATION",
  "IMAGE PROCESSING",
  "INFORMATION TECHNOLOGY",
  "INSTAGRAM MARKETING",
  "INVESTMENT ANALYSIS",
  "IOS",
  "JAVA",
  "JAVASCRIPT",
  "JENKINS",
  "JOURNALISM",
  "JSON",
  "JSP",
  "JQUERY",
  "KOTLIN",
  "KUBERNETES",
  "LEADERSHIP",
  "LARAVAl",
  "LEAGUE OF LEGENDS",
  "LINKDIN MARKETING",
  "LINEAR PROGRAMMING",
  "LINUX",
  "MACHINE LEARNING",
  "MATLAB",
  "MEAN STACK",
  "MERN STACK",
  "MICROSOFT VISUAL STUDIO",
  "MOBILE APP DEVELOPMENT",
  "MONGODB",
  "MS-EXCEL",
  "MS-OFFICE",
  "MS-POWERPOINT",
  "MS-WORD",
  "MYSQL",
  "Maya",
  "NETWORKING",
  "NEXT.JS",
  "NODE.JS",
  "NOSQL",
  "OBJECTIVE C",
  "ONLINE TEACHING",
  "OPENCV",
  "ORACLE",
  "PAYPAL API",
  "PENETRATION TESTING",
  "PHOTOGRAPHY",
  "PHOTOSHOP",
  "PHP",
  "PPC",
  "PRODUCT MANAGEMENT",
  "PROTOTYPING",
  "PSYCHOLOGY",
  "PYTHON",
  "PYTORCH",
  "PROJECT MANAGEMENT",
  "PROTOTYPING",
  "PPC",
  "PRODUCT MANAGEMENT",
  "PROTOTYPING",
  "PSYCHOLOGY",
  "PYTHON",
  "PYTORCH",
  "REACT.JS",
  "REACTJS",
  "REACT",
  "REST API",
  "REDUX",
  "RISK MANAGEMENT",
  "RUBY ON RAILS",
  "RUBY",
  "RUST",
  "SEARCH ENGINE OPTIMIZATION",
  "SEM",
  "SEO",
  "SKETCH",
  "SOCIAL MEDIA MARKETING",
  "SOCIAL WORK",
  "SOFTWARE DEVELOPMENT",
  "SQL",
  "STATISTICS",
  "STOCK MARKETING",
  "STOCK TRADING",
  "SWIFT",
  "TAILWIND CSS",
  "TALLY",
  "TEAM COLLABORATION",
  "TEACHING",
  "TECHNICAL WRITING",
  "TABLEAU",
  "TENSORFLOW",
  "TIME MANAGEMENT",
  "TRANSCRIPTION",
  "TRAINING AND DEVELOPMENT",
  "TRANSLATION",
  "TYPOGRAPHY",
  "UI & UX DESIGN",
  "UI/UX DESIGN",
  "UNITY 3D",
  "UNITY ENGINE",
  "UNITY",
  "UNREAL ENGINE",
  "VS CODE",
  "VUE JS",
  "VIDEOGRAPHY",
  "VIDEO EDITING",
  "WEB APPLICATION SECURITY",
  "WEB DESIGN",
  "WEB DEVELOPMENT",
  "WEBFLOW",
  "WINDOWS MOBILE APPLICATION DESIGN",
  "WORDPRESS",
  "WIREFRAMING",
  "XML",
  "XCODE",
  "YOUTUBE ADS",
  "ZBRUSH",
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
