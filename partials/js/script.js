const darkModeBtn = document.getElementById("darkModeBtn");
const darkModeIcon = darkModeBtn.querySelector(".dark-mode-icon");
const body = document.body;

let darkMode = true; // Set default mode to dark mode

toggleTheme(); // Apply the default theme

darkModeBtn.addEventListener("click", function () {
  darkMode = !darkMode;
  body.classList.toggle("dark-mode");
  toggleTheme();
});

function toggleTheme() {
  if (darkMode) {
    body.style.backgroundColor = "#121212"; // Dark mode background color
    body.style.color = "#ffffff"; // Dark mode text color
    darkModeIcon.src = "partials/img/dark-mode.gif";

    const liElements = document.querySelectorAll('.circles li');
    liElements.forEach(li => {
      li.classList.remove("dark-li"); // Add a class to target these li elements in dark mode
    });
  } else {
    body.style.backgroundColor = "#ffffff"; // Light mode background color
    body.style.color = "#000000"; // Light mode text color
    darkModeIcon.src = "partials/img/light-mode.gif";

    const liElements = document.querySelectorAll('.circles li');
    liElements.forEach(li => {
      li.classList.add("dark-li"); // Remove the class to revert the background color in light mode
    });
  }
}
