const dropdownItems = [
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
let selectedItems = [];

const searchBars = document.querySelectorAll("#option1Input, #option1Inputjob");
const dropdown = document.getElementById("dropdownFilterprofile");
const tagContainer = document.getElementById("tag-container");

// Add event listeners to all search bars
searchBars.forEach((searchBar) => {
  searchBar.addEventListener("input", function () {
    const searchString = searchBar.value.toLowerCase();
    const filteredItems = dropdownItems.filter((item) =>
      item.toLowerCase().includes(searchString)
    );
    renderDropdown(filteredItems);
  });
});

// onclicking outside it disappears
document.body.addEventListener("click", function (event) {
  if (
    !dropdown.contains(event.target) &&
    !Array.from(searchBars).some((searchBar) =>
      searchBar.contains(event.target)
    )
  ) {
    dropdown.style.display = "none";
  }
});

function renderDropdown(items) {
  if (items.length === 0) {
    dropdown.style.display = "none";
    return;
  }

  // adding class to call it in css for dropdown items
  dropdown.innerHTML = "";
  items.forEach((item) => {
    const option = document.createElement("div");
    option.textContent = item;
    option.classList.add("dropdown-item");
    option.style.cursor = "pointer";
    option.addEventListener("click", () => selectItem(item));
    dropdown.appendChild(option);
  });
  dropdown.style.display = "block";
}

function selectItem(item) {
  if (!selectedItems.includes(item)) {
    selectedItems.push(item);
    renderTags();
  }
  searchBars.forEach((searchBar) => {
    searchBar.value = "";
  });
  dropdown.style.display = "none";
}

function renderTags() {
  tagContainer.innerHTML = "";
  selectedItems.forEach((item) => {
    const tag = document.createElement("div");
    tag.classList.add("tag");
    tag.innerHTML = `<span>${item}</span><button onclick="removeTag('${item}')">&#10005;</button>`;
    tagContainer.appendChild(tag);
  });
}

function removeTag(item) {
  selectedItems = selectedItems.filter((tag) => tag !== item);
  renderTags();
}
