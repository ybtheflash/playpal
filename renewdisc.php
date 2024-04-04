<?php
session_start();
$s_id = $_SESSION["id"];
include("xconfig.php");

if (isset($_GET['disc_id'])) {
    // Get the disc_id from the GET request
    $disc_id = $_GET['disc_id'];

    // Sanitize and validate the disc_id (you should improve validation as needed)
    $disc_id = filter_var($disc_id, FILTER_SANITIZE_NUMBER_INT);

    // Get the current date and time
    $currentDateTime = date("Y-m-d H:i:s");

    // Update the 'issuedon' field with the current date and time
    $stmt = mysqli_prepare($dconn, "UPDATE issues SET issued_on = ? WHERE disc_id = ? AND issued_by = ?");

    if ($stmt) {
        // Bind the parameters
        mysqli_stmt_bind_param($stmt, "sii", $currentDateTime, $disc_id, $s_id);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            header('Location: renewreturn.php?rdone');
            exit;
        } else {
            // Error occurred during the update
            echo '<script>alert("Update Failed!");</script>';
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        // Error in preparing the statement
        echo '<script>alert("Update Failed!");</script>';
    }
} else {
    header('signin.php');
    exit;
}
