<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="partials/slick/slick.css">
    <link rel="stylesheet" href="partials/slick/slick-theme.css">
    <link rel="stylesheet" href="partials/css/dashb.css">
    <style>
        body {
            background-color: #1e1e1e;
        }
    </style>
    <title>Dashboard | PlayPal</title>
</head>

<body class="text-white">
    <div class="navbar bg-blue-500 p-4 flex items-center justify-center">
        <div class="logo">
            <img src="partials/img/playpal.png" alt="Disc Logo" class="spin w-12 h-12 mr-2">
        </div>
        <h1 class="title text-2xl"><span style="color:#2cd6ce;">Play</span>Pal</h1>
    </div>

    <main class="max-w-screen-xl mx-auto mt-30 p-4 shadow-lg rounded-lg">
        <h2 class="accent-text text-2xl text-blue-400">Trending Discs</h2>
        <div class="carousel">
            <!-- Slick Carousel for Trending Discs -->
            <div id="trendingCarousel" class="disc-carousel">
                <div class="disc">
                    <img src="partials/img/bcoldplay.png" alt="Sample Disc 1" class="w-64 h-64 object-cover rounded-md">
                    <h3 class="text-xl mt-2">Sample Disc 1</h3>
                </div>
                <div class="disc">
                    <img src="partials/img/bmeteora.jpg" alt="Sample Disc 2" class="w-64 h-64 object-cover rounded-md">
                    <h3 class="text-xl mt-2">Sample Disc 2</h3>
                </div>
                <div class="disc">
                    <img src="partials/img/bmaroon5.jpg" alt="Sample Disc 3" class="w-64 h-64 object-cover rounded-md">
                    <h3 class="text-xl mt-2">Sample Disc 3</h3>
                </div>
            </div>
        </div>

        <h2 class="accent-text text-2xl text-blue-400">Welcome, User</h2>
    </main>

    <footer class="accent-bg p-4 text-center">
        <p class="text-sm">&copy; 2023 PlayPal</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="partials/slick/slick.min.js"></script>
    <script src="scripts.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize the Trending Discs carousel
            $('#trendingCarousel').slick({
                slidesToShow: 1, // Display one slide at a time
                slidesToScroll: 1, // Scroll one slide at a time
                autoplay: true, // Enable autoplay
                autoplaySpeed: 3000, // Autoplay every 3 seconds (3000 milliseconds)
            });
        });
    </script>
</body>

</html>