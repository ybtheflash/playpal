<!DOCTYPE html>
<html lang="en">
<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: signin.php");
    exit;
}
$userType = $_SESSION["usertype"];

include("xconfig.php");

$qry = sprintf("SELECT name, email, mob FROM accounts WHERE username = '%s'", mysqli_real_escape_string($dconn, $_SESSION["username"]));
$email = $mob = $name = "";
$dresult = mysqli_query($dconn, $qry);
while ($row = mysqli_fetch_assoc($dresult)) {
    $email = $row["email"];
    $accname = $row["name"];
    $mob = $row["mob"];
}

if (isset($_POST['repgen'])) {
    echo '<script>alert("Report Generated.");</script>';
}
if (isset($_POST['update'])) {
    // Get user input
    $nemail = $_POST['newemail'];
    $nmob = $_POST['newmob'];
    $nm = $_POST['newname'];

    // Sanitize and escape HTML characters in user input
    $nm = htmlspecialchars($nm, ENT_QUOTES, 'UTF-8');
    $nmob = htmlspecialchars($nmob, ENT_QUOTES, 'UTF-8');

    if (empty($nm) || empty($nmob) || empty($nemail)) {
        header('Location: accounts.php');
        exit();
    }

    // Update user data using prepared statements
    $stmt = mysqli_prepare($dconn, "UPDATE accounts SET name=?, email=?, mob=? WHERE username=?");

    if ($stmt) {
        // Bind parameters
        mysqli_stmt_bind_param($stmt, "ssss", $nm, $nemail, $nmob, $_SESSION["username"]);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            echo '<script>alert("Update Successful!");</script>';
        } else {
            header("Location: accounts.php");
            exit;
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        header("Location: accounts.php");
        exit;
    }
}
?>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.7/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js" integrity="sha512-qZvrmS2ekKPF2mSznTQsxqPgnpkI4DNTlrdUmTzrDgektczlKNRRhy5X5AAOnx5S09ydFYWWNSfcEqDTTHgtNA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="partials/css/account-styles.css">
    <link rel="icon" type="image/png" href="partials/favicon.png">
    <title>Accounts - PlayPal</title>
    <style>
        /* Add your custom styles here */
        /* Style for the active link in the navigation panel */
        .nav-link.active {
            background-color: #2cd6ce;
            color: #121212;
        }
    </style>
</head>

<body class="text-white">
    <!-- Header -->
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
    <span style="padding-bottom:50px;"></span>
    <!-- Navigation Panel -->
    <div aria-label="toggler" class="flex justify-center items-center">
        <button aria-label="open" id="open" onclick="showNav(true)" class="hidden focus:outline-none focus:ring-2">
            <svg class="" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 6H20" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M4 12H20" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M4 18H20" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </button>
        <button aria-label="close" id="close" onclick="showNav(true)" class=" focus:outline-none focus:ring-2">
            <svg class="" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M18 6L6 18" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M6 6L18 18" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </button>
    </div>

    <div class="bg-blur absolute top-0 left-0 h-full w-full"></div>

    <div id="Main" class="xl:rounded-r transform  xl:translate-x-0  ease-in-out transition duration-500 flex justify-start items-start h-full  w-full sm:w-64 flex-col">
        <div class="flex flex-col justify-start items-center px-6 w-full  ">
            <button onclick="showMenu1(true)" class="focus:outline-none focus:text-indigo-400 text-left  text-white flex justify-between items-center w-full py-5 space-x-14  ">
                <p class="text-sm leading-5  uppercase">Account Section</p>
                <svg id="icon1" class="transform" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18 15L12 9L6 15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
            <div id="menu1" class="flex justify-start  flex-col w-full md:w-auto items-start pb-1 ">
                <p class="text-base leading-5 uppercase text-indigo-400" style="padding-bottom: 10px;">Member ID: PLX<?php echo $_SESSION["id"]; ?></p>
                <a href="accounts.php"><button class="flex justify-start items-center space-x-6 hover:text-white focus:bg-gray-700 focus:text-white hover:bg-gray-700 text-gray-400 rounded px-3 py-2 w-full md:w-52">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14 8.00002C15.1046 8.00002 16 7.10459 16 6.00002C16 4.89545 15.1046 4.00002 14 4.00002C12.8954 4.00002 12 4.89545 12 6.00002C12 7.10459 12.8954 8.00002 14 8.00002Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M4 6H12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M16 6H20" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M8 14C9.10457 14 10 13.1046 10 12C10 10.8954 9.10457 10 8 10C6.89543 10 6 10.8954 6 12C6 13.1046 6.89543 14 8 14Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M4 12H6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M10 12H20" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M17 20C18.1046 20 19 19.1046 19 18C19 16.8955 18.1046 16 17 16C15.8954 16 15 16.8955 15 18C15 19.1046 15.8954 20 17 20Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M4 18H15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M19 18H20" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <p class="text-base leading-4  ">Edit Details</p>
                    </button></a>

                <?php
                if ($userType == 0) {
                    echo '<button class="flex justify-start items-center space-x-6 hover:text-white focus:bg-gray-700 focus:text-white hover:bg-gray-700 text-gray-400 rounded px-3 py-2  w-full md:w-52">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 6H7C6.46957 6 5.96086 6.21071 5.58579 6.58579C5.21071 6.96086 5 7.46957 5 8V17C5 17.5304 5.21071 18.0391 5.58579 18.4142C5.96086 18.7893 6.46957 19 7 19H16C16.5304 19 17.0391 18.7893 17.4142 18.4142C17.7893 18.0391 18 17.5304 18 17V14" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M17 10C18.6569 10 20 8.65685 20 7C20 5.34314 18.6569 4 17 4C15.3431 4 14 5.34314 14 7C14 8.65685 15.3431 10 17 10Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <p class="text-base leading-4  ">Renew/Return</p>
                </button>';
                }
                if ($userType == 1) {
                    echo '<a href="manage.php"><button class="flex justify-start items-center space-x-6 hover:text-white focus:bg-gray-700 focus:text-white hover:bg-gray-700 text-gray-400 rounded px-3 py-2  w-full md:w-52">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 6H7C6.46957 6 5.96086 6.21071 5.58579 6.58579C5.21071 6.96086 5 7.46957 5 8V17C5 17.5304 5.21071 18.0391 5.58579 18.4142C5.96086 18.7893 6.46957 19 7 19H16C16.5304 19 17.0391 18.7893 17.4142 18.4142C17.7893 18.0391 18 17.5304 18 17V14" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M17 10C18.6569 10 20 8.65685 20 7C20 5.34314 18.6569 4 17 4C15.3431 4 14 5.34314 14 7C14 8.65685 15.3431 10 17 10Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <p class="text-base leading-4  ">Manage</p>
                </button></a>';
                }
                ?>
                <a href="change_password.php"><button class="flex justify-start items-center space-x-6 hover:text-white focus:bg-gray-700 focus:text-white hover:bg-gray-700 text-gray-400 rounded px-3 py-2  w-full md:w-52">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17 11H7C5.89543 11 5 11.8955 5 13V19C5 20.1046 5.89543 21 7 21H17C18.1046 21 19 20.1046 19 19V13C19 11.8955 18.1046 11 17 11Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M12 17C12.5523 17 13 16.5523 13 16C13 15.4477 12.5523 15 12 15C11.4477 15 11 15.4477 11 16C11 16.5523 11.4477 17 12 17Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M8 11V7C8 5.93913 8.42143 4.92172 9.17157 4.17157C9.92172 3.42143 10.9391 3 12 3C13.0609 3 14.0783 3.42143 14.8284 4.17157C15.5786 4.92172 16 5.93913 16 7V11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <p class="text-base leading-4  ">Change Password</p>
                    </button></a>
                <?php
                if ($userType == 2) {
                    echo '<a href="reportview.php"><button class="flex justify-start items-center space-x-6 hover:text-white focus:bg-gray-700 focus:text-white hover:bg-gray-700 text-gray-400 rounded px-3 py-2  w-full md:w-52">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M8 21H12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M10 21V3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M10 4L19 8L10 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <p class="text-base leading-4  ">Report Viewer</p>
                </button></a>';
                }
                ?>

                <?php
                if ($userType == 1) {
                    echo '<a href="reportgen.php"><button class="flex justify-start items-center space-x-6 hover:text-white focus:bg-gray-700 focus:text-white hover:bg-gray-700 text-gray-400 rounded px-3 py-2  w-full md:w-52">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M8 21H12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M10 21V3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M10 4L19 8L10 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <p class="text-base leading-4">Report Generator</p>
                </button></a>';
                }
                ?>
                <?php
                if ($userType == 2) {
                    echo '<a href="orderdisc.php"><button class="flex justify-start items-center space-x-6 hover:text-white focus:bg-gray-700 focus:text-white hover:bg-gray-700 text-gray-400 rounded px-3 py-2  w-full md:w-52">
                    <img src="partials/img/rupee.png" alt="Order" width="24px" height="24px">
                    <p class="text-base leading-4  ">Order</p>
                </button></a>';
                }
                ?>
            </div>
        </div>
    </div>

    <!-- Edit Account Details Panel -->
    <div class="fixed top-0 left-0 flex items-center justify-center h-full w-full bg-blur" style="z-index: 50;">
        <div class="w-full max-w-lg p-8">
            <h2 class="text-2xl font-semibold mb-4 text-center">Generate Report</h2>
            <form action="" method="post">
                <!-- <div class="mb-4">
                    <label for="username" class="text-sm block font-medium">Username</label>
                    <input type="text" value="<?php echo $_SESSION["username"]; ?>" id="username" class="w-full p-2 border rounded-md" placeholder="Your username" disabled>
                </div>
                <div class="mb-4">
                    <label for="email" class="text-sm block font-medium">Email</label>
                    <input type="email" id="email" name="newemail" value="<?php echo $email; ?>" class="w-full p-2 border rounded-md text-black" placeholder="Enter your email">
                </div>
                <div class="mb-4">
                    <label for="firstName" class="text-sm block font-medium">Name</label>
                    <input type="text" id="firstName" name="newname" value="<?php echo $accname; ?>" class="w-full p-2 border rounded-md text-black" placeholder="Enter your name">
                </div> -->
                <?php
                // Database connection (adjust these parameters as needed)
                // SQL query to retrieve data
                $sql = "SELECT * FROM pldiscs";
                $result = $dconn->query($sql);

                // Begin HTML for the report
                echo '<h1>Report</h1>';

                // Display data in a table
                if ($result->num_rows > 0) {
                    echo '<table id="pdfTable">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Author</th>
                <th>Genre</th>
                <th>Stock</th>
                <th>Added</th>
            </tr>';
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>
                <td style="padding-right:10px;">' . $row['d_id'] . '</td>
                <td>' . $row['dname'] . '</td>
                <td>' . $row['dauthor'] . '</td>
                <td>' . $row['dgenre'] . '</td>
                <td>' . $row['dstock'] . '</td>
                <td>' . $row['dadded'] . '</td>
            </tr>';
                    }
                    echo '</table>';
                } else {
                    echo 'No data available.';
                }

                // Close the database connection
                $dconn->close();
                ?>

                <!-- <div class="mb-4">
                    <label for="lastName" class="text-sm block font-medium">Mobile</label>
                    <input type="tel" id="lastName" name="newmob" value="<?php echo $mob; ?>" class="w-full p-2 border rounded-md text-black" placeholder="Enter your mobile">
                </div> -->
                <br>
                <button type="button" id="generatePdfButton" class="bg-indigo-600 text-white text-sm font-semibold py-2 px-4 rounded-md hover:bg-indigo-700 transition duration-200">Generate</button>
            </form>
        </div>
    </div>



    <!-- Footer -->
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


    <script src="partials/js/accounting.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.es.min.js" integrity="sha512-3chOMtjYaSa9m2bCC8qGxmEcX449u63D1fMXMQdueS3/XgE12iHQdmZVXVVbhBLc9i7h9WUuuM15B0CCE6Jtvg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.7.1/jspdf.plugin.autotable.min.js" integrity="sha512-jLgOBQkUaRRXfpwIEGE5jlCPSxMiQSFm0/cdzP/KuiECIx5x0ucr5enJrjtQJt+Y8vpIpOroYhsfsRLoDWO26Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        window.jsPDF = window.jspdf.jsPDF;
        document.getElementById('generatePdfButton').addEventListener('click', function(event) {
            // Prevent the default form submission behavior
            event.preventDefault();

            // Initialize jsPDF
            var doc = new jsPDF();

            // Get the HTML table element
            var table = document.getElementById('pdfTable');

            // Generate the PDF from the table using autoTable
            doc.autoTable({
                html: table,
                theme: 'grid',
                startY: 20
            });

            // Save the PDF or open it in a new tab
            doc.save('report.pdf');
        });
    </script>



</body>

</html>