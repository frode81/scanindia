<?php
define("HOST", "localhost");
define("USERNAME", "root");
define("PASSWORD", "");
define("DB_NAME", "scanindia");

// Create connection
$conn = mysqli_connect(HOST, USERNAME, PASSWORD, DB_NAME);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

