<?php
include 'xconfig.php';

if (isset($_GET['query'])) {
    $searchTerm = $_GET['query'];

    // Perform a database query to fetch search results
    $sql = "SELECT dname FROM pldiscs WHERE dname LIKE '%" . $searchTerm . "%'";

    if (isset($_GET['genre'])) {
        $searchGenre = $_GET['genre'];
        if ($searchGenre != 'All') {
            $sql = "SELECT dname FROM pldiscs WHERE dgenre='" . $searchGenre . "' AND dname LIKE '%" . $searchTerm . "%'";
        }
    }


    $result = $dconn->query($sql);

    if ($result->num_rows > 0) {
        $results = array();
        while ($row = $result->fetch_assoc()) {
            $results[] = $row;
        }
    } else {
        $results = array();
    }

    header('Content-Type: application/json');
    echo json_encode($results);
}

// Close the database connection
$dconn->close();
