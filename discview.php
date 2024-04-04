<!DOCTYPE html>
<html lang="en">
<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: signin.php");
    exit;
}
$s_id = $_SESSION["id"];
?>
<?php
include('xconfig.php');
$discId = 0;
$dname = "";
$drelease = "";
$dduration = 0;
$dabout = "";
$dgenre = "";
$dstock = 0;
if (isset($_GET['disc'])) {
    $disc = "";
    if (isset($_GET['disc'])) {
        $disc = urldecode($_GET['disc']);
        $discId = substr($disc, 2);
        $sqlv = "SELECT * FROM pldiscs WHERE d_id = ?";
        $stmtv = mysqli_prepare($dconn, $sqlv);
        mysqli_stmt_bind_param($stmtv, "s", $discId);

        // ...

        if (mysqli_stmt_execute($stmtv)) {
            mysqli_stmt_store_result($stmtv);

            if (mysqli_stmt_num_rows($stmtv) == 1) {
                // Fetch data from the query and store it in a result array
                $result = array();
                mysqli_stmt_bind_result($stmtv, $result['d_id'], $result['dname'], $result['dauthor'], $result['dduration'], $result['drelease'],   $result['dabout'], $result['dgenre'], $result['dtype'], $result['dstock'], $result['dadded'],);

                if (mysqli_stmt_fetch($stmtv)) {

                    $discId = $result['d_id'];
                    $dname = $result['dname'];
                    $dauthor = $result['dauthor'];
                    $drelease = $result['drelease'];
                    $dduration = $result['dduration'];
                    $dabout = $result['dabout'];
                    $dgenre = $result['dgenre'];
                    $dstock = $result['dstock'];
                }
            } else {
                header("Location: dashboard.php?" . $discId);
                exit();
            }
        } else {
            header("Location: 404.html");
            exit();
        }
        // ...

        mysqli_stmt_close($stmtv);
        $issuedornot = 0;
        $qry = sprintf("SELECT * FROM issues WHERE disc_id = '%s' AND issued_by='$s_id'", mysqli_real_escape_string($dconn, $discId));
        $dissuedby = "";
        $dresult = mysqli_query($dconn, $qry);
        while ($row = mysqli_fetch_assoc($dresult)) {
            $dissuedby = $row["issued_by"];
        }
        if (!empty($dissuedby)) {
            $issuedornot = 1;
        }
    } else {
        header("Location: 404.html");
        exit();
    }
    // Close the database connection
    mysqli_close($dconn);
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.7/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="partials/css/discview.css">
    <link rel="icon" type="image/png" href="partials/favicon.png">
    <title><?php echo $result["dname"]; ?> - PlayPal</title>
</head>




<body class="text-white relative">
    <!-- Header -->
    <header class="p-4">
        <div class="navbar flex items-center justify-between">
            <a href="dashboard.php">
                <h1 class="text-2xl"><span style="color:#2cd6ce;">Play</span>Pal</h1>
            </a>
            <div class="logo">
                <a href="dashboard.php"><img src="partials/img/playpal.png" alt="Disc Logo" class="spin w-12 h-12 mr-2"></a>
            </div>
            <div class="account flex items-center">
                <span class="text-sm"><a href="signout.php">Sign Out</a></span>
                <span class="text-sm">|</span>
                <a href="accounts.php"><span class="text-sm">Hello, <?php echo $_SESSION["username"]; ?></span></a>
                <a href="accounts.php"><img src="partials/img/user.gif" alt="User Icon" class="w-8 h-8 mr-2"></a>
            </div>
        </div>
    </header>

    <!-- Background Blur -->
    <div class="bg-blur absolute top-0 left-0 h-full w-full"></div>

    <!-- Movie Details (Centered on Y-axis) -->
    <section class="container mx-auto mt-64 p-4 mvdetails">
        <div class="flex">
            <div class="w-1/4 pr-8">
                <img src="<?php echo 'partials/discs/PL' . $discId . '.png'; ?>" alt="Movie Poster" class="w-full h-auto rounded-lg shadow-lg">
                <?php
                if ($issuedornot == 0) {
                    echo '<a href="issue.php?disc_id=' . $discId . '" class="text-white py-2 px-4 mt-4 rounded transition w-full" style="background-color: #11aca4; text-align: center; display: block; text-decoration: none;">Issue</a>';
                } else {
                    echo '<a class="text-white py-2 px-4 mt-4 rounded transition w-full" style="background-color: #127a75; text-align: center; display: block; text-decoration: none;">Issued</a>';
                }
                ?>

            </div>

            <div class="w-3/4">
                <h1 class="text-2xl font-semibold mt-2"><?php echo $dname; ?></h1>
                <p><strong>Author:</strong> <?php echo $dauthor; ?></p>
                <p><strong>Release Date:</strong> <?php echo $drelease; ?></p>
                <p><strong>Genre:</strong> <?php echo $dgenre; ?></p>
                <p><strong>Duration:</strong> <?php echo $dduration; ?> minutes</p>
                <h2 class="text-2xl font-semibold mt-4">Synopsis</h2>
                <p><?php echo $dabout; ?></p>
            </div>
        </div>
    </section>

    <!-- Additional Details -->
    <section class="container mx-auto p-4 additional-details">
        <h2 class="text-xl font-semibold mt-8">Additional Details</h2>
        <p><strong>Amount of Stock Left:</strong> <?php echo $dstock; ?> copies</p>
        <h2 class="text-2xl font-semibold mt-4" style="padding-top:10px;">Terms and Conditions</h2>
        <p>By issuing this disc from our video library, PlayPal, you agree to the following terms and conditions:</p>
        <ul class="list-disc ml-8">
            <li>This disc must be returned within 7 days of issuance.</li>
            <li>Any damage to the disc will result in a replacement fee.</li>
            <li>Failure to return the disc on time may result in late fees.</li>
        </ul>
    </section>

    <!-- Footer (Absolute at the bottom) -->
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
            <a href="#">Privacy Policy</a>
            <a href="#">Terms of Service</a>
        </div>
    </footer>
</body>

</html>