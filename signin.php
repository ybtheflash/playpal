<!DOCTYPE html>
<html lang="en">
<?php
session_start();

// check if the user is already logged in
if (isset($_SESSION['username'])) {
    header("location: dashboard.php");
    exit;
} ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="partials/css/accounts.css">
    <link rel="icon" type="image/png" href="partials/favicon.png">
    <title>Sign In | PlayPal</title>
</head>
<style>
    body {
        background-repeat: no-repeat;
        background-size: cover;
        background-color: rgba(0, 0, 0, 0.6);
        background-image: url('partials/img/login-bg.jpg');
    }
</style>

<body>
    <div class="min-h-screen flex items-center justify-center">
        <div class="p-8 rounded-lg shadow-md w-96" style="background-color: rgba(0, 0, 0, 0.6); backdrop-filter: blur(10px);">
            <h1 class="text-2xl font-bold text-white mb-4">Sign In @ PlayPal</h1>
            <form method="post" class="w-full max-w-lg">
                <div class="mb-4">
                    <label for="username" class="block text-white">Username:</label>
                    <input type="text" id="username" name="username" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Username">
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-white">Password:</label>
                    <input type="password" id="password" name="password" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="*********">
                </div>
                <div class="flex items-start mb-6">
                    <div class="flex items-center h-5">
                        <input id="remember" type="checkbox" id="remember" name="remember" type="checkbox" value="" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800">
                    </div>
                    <label for="remember" class="ml-2 text-sm font-medium text-white dark:text-gray-300">Remember me</label>
                </div>
                <div class="flex items-center justify-between">
                    <button class="text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" name="signin">
                        Sign In</button>
                </div>
            </form>
            <div class="mt-4">
                <a href="index.php" class="ppcolor">Go Home</a>
            </div>
            <p class="mt-4 text-sm text-white">
                New? <a href="signup.php" class="ppcolor">Sign-Up Here</a>
            </p>

            <?php
            include 'xconfig.php';

            if (isset($_POST["signin"])) {
                $username = $_POST["username"];
                $password = $_POST["password"];
                if (empty($username) || empty($password)) {
                    // Handle validation errors or display an error message
                    header("Location: signin.php?error=Please fill in both fields");
                    exit();
                }
                $sql = "SELECT * FROM accounts WHERE username = ?";
                $stmt = $dconn->prepare($sql);
                $stmt->bind_param("s", $username);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows === 1) {
                    $row = $result->fetch_assoc();

                    if (password_verify($password, $row["password"])) {
                        session_start();
                        $_SESSION["username"] = $row["username"];
                        $_SESSION["id"] = $row["id"];
                        $_SESSION["loggedin"] = true;
                        $_SESSION["usertype"] = $row["usertype"];
                        // You can also set other user information in the session
                        header("Location: dashboard.php");
                        exit();
                    } else {
                        // Password is incorrect
                        echo '<div class="text-center py-4 lg:px-4">
            <div class="p-2 items-center text-red-100 leading-none lg:rounded-full flex lg:inline-flex" role="alert" style="background-color: #f56565;">
              <span class="flex rounded-full uppercase px-2 py-1 text-xs font-bold mr-3" style="background-color: #e53e3e;">Error</span>
              <span class="font-semibold mr-2 text-left flex-auto">Wrong Username or Password. Try Again?</span>
            </div>
          </div>';
                    }
                } else {
                    echo '<div class="text-center py-4 lg:px-4">
            <div class="p-2 items-center text-red-100 leading-none lg:rounded-full flex lg:inline-flex" role="alert" style="background-color: #f56565;">
              <span class="flex rounded-full uppercase px-2 py-1 text-xs font-bold mr-3" style="background-color: #e53e3e;">Error</span>
              <span class="font-semibold mr-2 text-left flex-auto">User Not Found.</span>
            </div>
          </div>';
                }
            }

            // Close the database connection
            $dconn->close();
            ?>

        </div>
    </div>
</body>

</html>