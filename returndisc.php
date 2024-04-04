<?php
session_start();
$s_id = $_SESSION["id"];
include("xconfig.php");
if (isset($_GET['disc_id'])) {
    // Get the disc_id from the GET request
    $disc_id = $_GET['disc_id'];

    // Sanitize and validate the disc_id (you should improve validation as needed)
    $disc_id = filter_var($disc_id, FILTER_SANITIZE_NUMBER_INT);

    // Perform the deletion operation
    $stmt = mysqli_prepare($dconn, "DELETE FROM issues WHERE disc_id = ? AND issued_by = ?");

    if ($stmt) {
        // Bind the parameter
        mysqli_stmt_bind_param($stmt, "ii", $disc_id, $s_id);
        if (mysqli_stmt_execute($stmt)) {
            header('Location: renewreturn.php?returned'); //
            exit;
        } else {
            // Error occurred during deletion
            echo '<script>alert("Deletion Failed!");</script>';
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        // Error in preparing the statement
        echo '<script>alert("Deletion Failed!");</script>';
    }
} else {
    header('signin.php');
    exit;
}
