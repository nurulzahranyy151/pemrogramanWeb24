document.addEventListener("DOMContentLoaded", function() {
    const body = document.querySelector('body');
    const sidebar = body.querySelector('nav');
    const toggle = body.querySelector(".toggle");
    const modeSwitch = body.querySelector(".toggle-switch");
    
    const modeText = body.querySelector(".mode-text");
  
    toggle.addEventListener("click", () => {
      sidebar.classList.toggle("close");
    });
  
    modeSwitch.addEventListener("click", () => {
      console.log("Toggle clicked");
      body.classList.toggle("dark");
      modeText.innerText = body.classList.contains("dark")? "Light mode" : "Dark mode";
    });
  });