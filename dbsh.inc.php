<?php

$dbsServer = "localhost";
$dbsUsername = "root";
$dbsPassword = "";
$dbsName = "food-links";

$conn = mysqli_connect($dbsServer, $dbsUsername, $dbsPassword,$dbsName);
if (!$conn) {
    die("Error: " ) . mysqli_connect_error();
}

?>