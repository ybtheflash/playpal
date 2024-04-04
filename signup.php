<!DOCTYPE html>
<html lang="en">
<?php
session_start();


if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("location: dashboard.php");
    exit;
} ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="partials/css/accounts.css">
    <link rel="icon" type="image/png" href="partials/favicon.png">
    <title>Sign-Up | PlayPal</title>
</head>
<style>
    body {
        background-repeat: no-repeat;
        background-size: cover;
        background-color: rgba(0, 0, 0, 0.6);
        background-image: url('partials/img/signup-bg.jpg');
    }
</style>

<body>
    <div class="min-h-screen flex items-center justify-center">
        <div class="p-8 rounded-lg shadow-md w-96" style="background-color: rgba(0, 0, 0, 0.6); backdrop-filter: blur(10px);">
            <h1 class="text-2xl font-bold text-white mb-4">Sign-Up @ PlayPal</h1>
            <form method="post" class="w-full max-w-lg">
                <div class="flex flex-wrap -mx-3 mb-2">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <div class="mb-4">
                            <label for="username" class="block tracking-wide font-bold text-white">Username:</label>
                            <input type="text" id="username" name="username" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="iamflash" required>
                        </div>
                    </div>
                    <div class="w-full md:w-1/2 px-3">
                        <div class="mb-4">
                            <label for="password" class="block text-white">Password:</label>
                            <input type="password" id="password" name="password" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="******" required>
                            <p class="text-gray-400 text-xs italic">Don't Forget.</p>
                        </div>
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3 mb-2">
                    <div class="w-full px-3">
                        <div class="mb-4">
                            <label for="name" class="block text-white">Name:</label>
                            <input type="text" id="name" name="name" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-16 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Sandeep Maheshwari" required>
                        </div>
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3 mb-2">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <div class="mb-4">
                            <label for="email" class="block text-white">E-mail:</label>
                            <input type="email" id="email" name="email" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="kms@gmail.com" required>
                        </div>
                    </div>
                    <div class="w-full md:w-1/2 px-3">
                        <div class="mb-4">
                            <label for="mobile" class="block text-white">Mobile Number:</label>
                            <input type="tel" id="mobile" name="mobile" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="82XXXXXXXX" required>
                        </div>
                    </div>
                </div>
                <div class="flex items-start mb-2">
                    <div class="flex items-center h-5">
                        <input id="remember" type="checkbox" id="remember" name="remember" type="checkbox" value="" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800">
                    </div>
                    <label for="remember" class="ml-2 text-sm font-medium text-white dark:text-gray-300">Remember me</label>
                </div>
                <div class="flex items-center justify-between">
                    <button class="text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" name="signup">
                        Sign Up
                    </button>
                </div>
            </form>
            <div class="mt-4">
                <a href="index.php" class="ppcolor">Go Home</a>
            </div>
            <p class="mt-4 text-sm text-white">
                Already have an account? <a href="signin.php" class="ppcolor">Sign In Here</a>
            </p>

            <?php
            include 'xconfig.php';

            if (isset($_POST["signup"])) {
                $username = $_POST["username"];
                $password = $_POST["password"];
                $name = $_POST["name"];
                $email = $_POST["email"];
                $mobile = $_POST["mobile"];

                // Check for blank fields
                if (empty($username) || empty($password) || empty($name) || empty($email) || empty($mobile)) {
                    header("Location: signup.php?error=Please fill in all fields");
                    exit();
                }

                // Use prepared statements to prevent SQL injection
                $checkUsernameSql = "SELECT username FROM accounts WHERE username = ?";
                $checkUsernameStmt = $dconn->prepare($checkUsernameSql);
                $checkUsernameStmt->bind_param("s", $username);
                $checkUsernameStmt->execute();
                $checkUsernameResult = $checkUsernameStmt->get_result();

                if ($checkUsernameResult->num_rows > 0) {
                    // Username already exists, show an alert
                    echo '<div class="text-center py-4 lg:px-4">
            <div class="p-2 items-center text-red-100 leading-none lg:rounded-full flex lg:inline-flex" role="alert" style="background-color: #f56565;">
              <span class="flex rounded-full uppercase px-2 py-1 text-xs font-bold mr-3" style="background-color: #e53e3e;">Error</span>
              <span class="font-semibold mr-2 text-left flex-auto">Username already exists. Please choose a different username.</span>
              <svg class="fill-current h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M18.293 1.293a1 1 0 010 1.414L11.414 10l6.879 6.879a1 1 0 01-1.414 1.414L10 11.414l-6.879 6.879a1 1 0 01-1.414-1.414L8.586 10 1.707 3.121a1 1 0 111.414-1.414L10 8.586l6.879-6.879a1 1 0 011.414 0z"/></svg>
            </div>
          </div>';
                } else {
                    // Username is unique, proceed with registration
                    $sql = "INSERT INTO accounts (username, password, name, email, mob) VALUES (?, ?, ?, ?, ?)";
                    $stmt = $dconn->prepare($sql);

                    // Hash the password securely
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                    // Bind parameters to the statement
                    $stmt->bind_param("sssss", $username, $hashedPassword, $name, $email, $mobile);

                    if ($stmt->execute()) {
                        // User successfully registered
                        echo '<div class="text-center py-4 lg:px-4">
                <div class="p-2 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex" role="alert" style="background-color: #0c8379;">
                  <span class="flex rounded-full uppercase px-2 py-1 text-xs font-bold mr-3" style="background-color: #11bbad;">Success</span>
                  <span class="font-semibold mr-2 text-left flex-auto">Sign-Up Successful! Kindly Sign In.</span>
                  <svg class="fill-current opacity-75 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z"/></svg>
                </div>
              </div>';
                    } else {
                        echo '<div role="alert">
                <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
                  Error!
                </div>
                <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
                  <p>Something not ideal might be happening. Try Again Later?</p>
                </div>
              </div>';
                    }
                }
            }

            // Close the database connection
            $dconn->close();
            ?>



        </div>
    </div>
</body>

</html>