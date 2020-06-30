<?php
$servername = "localhost";
$username = "root";
$password = "";
$database_name = "song_information";

// Set to true to clear and refill the databse
$should_restart_database = False;

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database_name);

// Check connection
if(!$conn) {
  die('Could not connect: ' . mysqli_error($conn));
}

echo "Success";

?>