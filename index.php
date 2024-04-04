<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="partials/css/styles.css">
    <link rel="icon" type="image/png" href="partials/favicon.png">
    <title>PlayPal - Disc Library</title>
    <script>
        function searchNames() {
            var inputText = document.getElementById("discInput").value;
            var resultsDiv = document.getElementById("searchResults");

            if (inputText.trim() === "") {
                resultsDiv.innerHTML = ""; // Clear the results if the input is empty
                return;
            }

            // Make an AJAX request to your PHP script
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    resultsDiv.innerHTML = xhr.responseText; // Update the results div with the search results
                }
            };

            xhr.open("GET", "searchforindex.php?q=" + inputText, true);
            xhr.send();
        }
    </script>


</head>

<body>
    <div id="myModal" class="modal">
        <div class="modal-overlay">
            <div class="modal-content">
                <span hidden class="close">&times;</span>
                <h2>PlayPal Accounts</h2>
                <!-- <br> -->
                <!-- <p>What do you want to do?</p> -->
                <div class="modal-buttons">
                    <button id="loginButton">Sign In</button>
                    <button id="registerButton">Sign Up</button>
                </div>
            </div>
        </div>
    </div>
    <div class="area">

        <div class="container">
            <div class="content">
                <h1 class="title"><span class="blood-red">Play</span>Pal</h1>
                <p class="description">Your own CD <span class="blood-red">x</span> DVD Library.
                </p>
                <div class="search-bar">
                    <div class="search">
                        <input type="text" id="discInput" class="placeholder-italic" placeholder="Neele Neele Amber..." onkeyup="searchNames()" />
                        <div class="symbol">
                            <svg class="disc">
                                <use xlink:href="#disc" />
                            </svg>
                            <svg class="lens">
                                <use xlink:href="#lens" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="search-results" id="searchResults"></div><br>
                <hr style="opacity: 50%;">
                <div class="icons">
                    <div class="icon" id="aboutIcon">
                        <img src="partials/img/about.gif" alt="About Icon" class="icon-image">
                    </div>
                    <div class="icon" id="accountsIcon">
                        <img src="partials/img/accounts.gif" alt="Account Icon" class="icon-image">
                    </div>
                </div>


                <!-- SVG -->
                <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                    <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 290 290" id="disc">
                        <path d="M145,0C64.978,0,0,64.978,0,145c0,80.022,64.978,145,145,145s145-64.978,145-145S225.022,0,145,0z
               M145,10c74.618,0,135,60.382,135,135s-60.382,135-135,135S10,219.618,10,145C10,70.382,70.382,10,145,10z
               M145,17.498c-70.566,0-127.5,56.934-127.5,127.5c-0.02,1.381,1.084,2.516,2.465,2.535s2.516-1.084,2.535-2.465
               c0-0.024,0-0.047,0-0.071c0-67.88,54.62-122.5,122.5-122.5c1.381,0.02,2.516-1.084,2.535-2.465s-1.084-2.516-2.465-2.535
               C145.047,17.498,145.024,17.498,145,17.498z M145,110c-19.271,0-35,15.729-35,35s15.729,35,35,35s35-15.729,35-35
               S164.271,110,145,110z M145,120c13.866,0,25,11.134,25,25s-11.134,25-25,25s-25-11.134-25-25S131.134,120,145,120z
               M145,127.5c-9.635,0-17.5,7.865-17.5,17.5c-0.02,1.381,1.084,2.516,2.465,2.535c1.381,0.02,2.516-1.084,2.535-2.465
               c0-0.024,0-0.047,0-0.071c0-6.933,5.567-12.5,12.5-12.5c1.381,0.02,2.516-1.084,2.535-2.465s-1.084-2.516-2.465-2.535
               C145.047,127.5,145.024,127.5,145,127.5z M269.963,142.463c-1.38,0.02-2.482,1.155-2.463,2.535c0,67.88-54.62,122.5-122.5,122.5
               c-1.381-0.02-2.516,1.084-2.535,2.465s1.084,2.516,2.465,2.535c0.024,0,0.047,0,0.071,0c70.566,0,127.5-56.934,127.5-127.5
               c0.019-1.381-1.084-2.516-2.465-2.535C270.011,142.463,269.987,142.463,269.963,142.463z" />
                    </symbol>
                    <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="lens">
                        <path d="M15.656,13.692l-3.257-3.229c2.087-3.079,1.261-7.252-1.845-9.321c-3.106-2.068-7.315-1.25-9.402,1.83
          s-1.261,7.252,1.845,9.32c1.123,0.748,2.446,1.146,3.799,1.142c1.273-0.016,2.515-0.39,3.583-1.076l3.257,3.229
          c0.531,0.541,1.404,0.553,1.95,0.025c0.009-0.008,0.018-0.017,0.026-0.025C16.112,15.059,16.131,14.242,15.656,13.692z M2.845,6.631
          c0.023-2.188,1.832-3.942,4.039-3.918c2.206,0.024,3.976,1.816,3.951,4.004c-0.023,2.171-1.805,3.918-3.995,3.918
          C4.622,10.623,2.833,8.831,2.845,6.631L2.845,6.631z" />
                    </symbol>
                </svg>
            </div>
            <br>
            <ul class="circles">
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </div>
    </div>

    <button id="darkModeBtn" class="dark-mode-btn">
        <img src="partials/img/dark-mode.gif" alt="Dark Mode" class="dark-mode-icon">
    </button>
    <script src="partials/js/script.js"></script>
    <script src="partials/js/myscript.js"></script>
</body>

</html>