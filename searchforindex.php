<?php
include 'xconfig.php';

// Get the user input
$q = $_GET["q"];

// Perform a database query
$sql = "SELECT dname FROM pldiscs WHERE dname LIKE '%$q%'";
$result = $dconn->query($sql);

if ($result->num_rows > 0) {
    // Display the matching names
    while ($row = $result->fetch_assoc()) {
        echo $row["dname"] . "<br>";
    }
} else {
    echo "No Results Found.";
}

$dconn->close();
