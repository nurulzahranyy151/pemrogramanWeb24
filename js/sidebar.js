// Selecting necessary elements from the DOM
const body = document.querySelector('body');
const sidebar = body.querySelector('nav');
const toggle = body.querySelector(".toggle");
const searchBtn = body.querySelector(".search-box");
const modeSwitch = body.querySelector(".toggle-switch");
const modeText = body.querySelector(".mode-text");

// Event listener for toggling the sidebar
toggle.addEventListener("click", () => {
    sidebar.classList.toggle("close");
});

// Event listener for showing the sidebar when the search button is clicked
searchBtn.addEventListener("click", () => {
    sidebar.classList.remove("close");
});

// Event listener for toggling between dark and light modes
modeSwitch.addEventListener("click", () => {
    body.classList.toggle("dark");
    modeText.innerText = body.classList.contains("dark") ? "Light mode" : "Dark mode";
});
