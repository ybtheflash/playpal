<!DOCTYPE html>
<html lang="en">
<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: signin.php");
    exit;
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="partials/slick/slick.css">
    <link rel="stylesheet" href="partials/slick/slick-theme.css">
    <link rel="stylesheet" href="partials/css/dashb.css">
    <link rel="icon" type="image/png" href="partials/favicon.png">
    <style>
        /* Additional custom styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #1b1b1b;
            /* Dark gray background */
            color: white;
        }
    </style>
    <title>Dashboard | PlayPal</title>
</head>

<body class="text-white flex flex-col min-h-screen">
    <div class="navbar p-4 flex items-center justify-between">
        <h1 class="text-2xl"><span style="color:#2cd6ce;">Play</span>Pal</h1>
        <div class="logo">
            <a href="index.php"><img src="partials/img/playpal.png" alt="Disc Logo" class="spin w-12 h-12 mr-2"></a>
        </div>
        <div class="account flex items-center">
            <span class="text-sm"><a href="signout.php">Sign Out</a></span>
            <span class="text-sm">|</span>
            <a href="accounts.php"><span class="text-sm">Hello, <?php echo $_SESSION["username"]; ?></span></a>
            <a href="accounts.php"><img src="partials/img/user.gif" alt="User Icon" class="w-8 h-8 mr-2"></a>
        </div>
    </div>
    <div class="container mx-auto mt-10">
        <div class="header__search-dropdown js-search-dropdown p-4 rounded shadow-lg text-center">
            <form action="" id="search-form" class="header__search-form flex items-center justify-center">
                <input type="text" name="query" id="search-query" placeholder="Search for a disc..." class="header__mobile-search text-gray-500 bg-gray-700 rounded p-2 mr-2" required>
                <button type="submit" class="header__submit text-white rounded p-2" style="background-color:#11aca4;">Search</button>
            </form>
            <div class="selects-container flex justify-center mt-4">
                <div class="mr-4">
                    <p class="inline">Genre:</p>
                    <select name="genre" id="search-genre" class="bg-gray-700 rounded p-2 ml-2">
                        <option value="All">All</option>
                        <option value="Education">Education</option>
                        <option value="Music">Music</option>
                        <option value="Documentary">Documentary</option>
                        <option value="Movie">Movie</option>
                    </select>
                </div>
            </div>
        </div>
        <div id="search-results" class="search-results mt-4" hidden>
            <h2 class="text-2xl">Search Results</h2>
            <ul id="search-results-list"></ul>
        </div>

    </div>
    </div>
    <main class="flex-grow max-w-screen-xl mx-auto p-4 shadow-lg rounded-lg">
        <h2 class="accent-text text-2xl">Trending Now</h2>
        <div class="carousel">
            <!-- Slick Carousel for Trending Discs -->
            <div id="trendingCarousel" class="disc-carousel">
                <div class="disc">
                    <img src="partials/img/bcoldplay.png" alt="Sample Disc 1" class="w-64 h-64 object-cover rounded-md">
                </div>
                <div class="disc">
                    <a href="discview.php?disc=PL2"><img src="partials/img/barticmonkeys.png" alt="Sample Disc 2" class="w-64 h-64 object-cover rounded-md"></a>
                </div>
                <div class="disc">
                    <img src="partials/img/bmaroon5.jpg" alt="Sample Disc 3" class="w-64 h-64 object-cover rounded-md">
                </div>
                <div class="disc">
                    <img src="partials/img/byoasobi.jpg" alt="Sample Disc 3" class="w-64 h-64 object-cover rounded-md">
                </div>
            </div>
        </div>
        <!-- Slick Carousel for Latest Additions -->
        <h2 class="accent-text text-2xl">Our Latest Additions</h2>
        <div id="latestCarousel" class="latest-carousel">
            <div class="latest-disc">
                <a href="discview.php?disc=PL1"><img src="partials/discs/PL1.png" alt="Latest Disc 1" class="w-64 h-64 object-cover rounded-md"></a>
            </div>
            <div class="latest-disc">
                <a href="discview.php?disc=PL2"><img src="partials/discs/PL2.png" alt="Latest Disc 2" class="w-64 h-64 object-cover rounded-md"></a>
            </div>
            <div class="latest-disc">
                <a href="discview.php?disc=PL13"><img src="partials/discs/PL13.png" alt="Latest Disc 4" class="w-64 h-64 object-cover rounded-md"></a>
            </div>
            <div class="latest-disc">
                <a href="discview.php?disc=PL5"><img src="partials/discs/PL5.png" alt="Latest Disc 5" class="w-64 h-64 object-cover rounded-md"></a>
            </div>
            <div class="latest-disc">
                <a href="discview.php?disc=PL14"><img src="partials/discs/PL14.png" alt="Latest Disc 6" class="w-64 h-64 object-cover rounded-md"></a>
            </div>
            <div class="latest-disc">
                <a href="discview.php?disc=PL7"><img src="partials/discs/PL7.png" alt="Latest Disc 7" class="w-64 h-64 object-cover rounded-md"></a>
            </div>
            <div class="latest-disc">
                <a href="discview.php?disc=PL8"><img src="partials/discs/PL8.png" alt="Latest Disc 8" class="w-64 h-64 object-cover rounded-md"></a>
            </div>
            <div class="latest-disc">
                <a href="discview.php?disc=PL9"><img src="partials/discs/PL9.png" alt="Latest Disc 9" class="w-64 h-64 object-cover rounded-md"></a>
            </div>
            <div class="latest-disc">
                <a href="discview.php?disc=PL10"><img src="partials/discs/PL10.png" alt="Latest Disc 10" class="w-64 h-64 object-cover rounded-md"></a>
            </div>
            <div class="latest-disc">
                <a href="discview.php?disc=PL11"><img src="partials/discs/PL11.png" alt="Latest Disc 11" class="w-64 h-64 object-cover rounded-md"></a>
            </div>
            <div class="latest-disc">
                <a href="discview.php?disc=PL12"><img src="partials/discs/PL12.png" alt="Latest Disc 12" class="w-64 h-64 object-cover rounded-md"></a>
            </div>
        </div>
    </main>
    <footer class="accent-bg p-4">
        <div class="footer-left">
            <p>&copy; 2023 <span style="color:#2cd6ce;">Play</span>Pal</p>
        </div>
        <div class="footer-social">
            <a href="#" class="social-icon"><i class="fab fa-facebook"></i></a>
            <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
            <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
            <a href="#" class="social-icon"><i class="fab fa-linkedin"></i></a>
        </div>
        <div class="footer-right">
            <a href="privacy_policy.html">Privacy Policy</a>
            <a href="terms_of_service.html">Terms of Service</a>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="partials/slick/slick.min.js"></script>
    <script src="partials/js/search.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize the Trending Discs carousel
            $('#trendingCarousel').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 3000,
            });
            // Initialize the Latest Additions carousel
            $('#latestCarousel').slick({
                slidesToShow: 5, // Display 5 slides at once
                slidesToScroll: 1, // Scroll one slide at a time
                autoplay: true, // Enable autoplay
                autoplaySpeed: 3000, // Autoplay every 3 seconds (3000 milliseconds)
                infinite: true, // Infinite scrolling
            });
        });
    </script>
</body>

</html>