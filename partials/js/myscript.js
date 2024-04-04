// Get the modal element
var modal = document.getElementById('myModal');
var modalOverlay = modal.querySelector('.modal-overlay');

// Get the buttons that open the modal
var loginButton = document.getElementById('loginButton');
var registerButton = document.getElementById('registerButton');

// Get the close button element
var closeBtn = document.getElementsByClassName('close')[0];

// Function to open the modal
function openModal() {
    modal.style.display = 'block';
    setTimeout(function () {
        modal.classList.add('show');
        modal.classList.remove('hide');
    }, 10); // Add a small delay for the transition to work
}

// Function to close the modal
function closeModal() {
    modal.classList.add('hide');
    modal.classList.remove('show');
    setTimeout(function () {
        modal.style.display = 'none';
    }, 300); // Wait for the transition to complete before hiding
}


modalOverlay.addEventListener('click', function (event) {
    if (event.target === modalOverlay) {
        closeModal(); // Call your closeModal function
    }
});
// Event listeners
loginButton.addEventListener('click', function () {
    // Redirect to the login page
    window.location.href = 'signin.php';
});

registerButton.addEventListener('click', function () {
    // Redirect to the register page
    window.location.href = 'signup.php';
});

closeBtn.addEventListener('click', closeModal);

// Get the "About" icon element by its ID
const aboutIcon = document.getElementById('aboutIcon');

// Add a click event listener to navigate to "about.html" when clicked
aboutIcon.addEventListener('click', function () {
    window.location.href = 'about.html';
});

// Get the "Accounts" icon element by its ID
const accountsIcon = document.getElementById('accountsIcon');

// Add a click event listener to open the modal when clicked
accountsIcon.addEventListener('click', openModal);
