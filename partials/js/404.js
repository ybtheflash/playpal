document.getElementById("goHomeButton").addEventListener("click", function(event) {
    event.preventDefault(); // Prevent the default behavior of the link
    // You can add any additional actions here before navigating
    window.location.href = this.getAttribute("href"); // Navigate to the link's href attribute
});
