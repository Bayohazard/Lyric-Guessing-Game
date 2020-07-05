<?php
include "song.php";
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database_name = "song_information";
// Makes sure the array is only initialised the first time
if(!isset($_SESSION["answers"])) {
  $_SESSION["answers"] = array();
}

// Set to true to clear and refill the databse
$should_restart_database = False;

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database_name);

// Check connection
if(!$conn) {
  die('Could not connect: ' . mysqli_error($conn));
}

function restart_database($connection) {
  // Clears the table
  $sql = "DROP TABLE songs";
  mysqli_query($connection, $sql);

  // Creates new table
  $sql = "CREATE TABLE Songs (
    id int NOT NULL AUTO_INCREMENT,
    Title varchar(255) NOT NULL,
    Length varchar(6) NOT NULL,
    Artist varchar(255) NOT NULL,
    Album varchar(255) NOT NULL,
    Genre varchar(255) NOT NULL,
    Is_Loved int NOT NULL,
    Plays int NOT NULL,
    PRIMARY KEY (id)
  );";

  mysqli_query($connection, $sql);

  // Preparing statement
  $statement = mysqli_prepare($connection, "INSERT INTO songs
          (Title, Length, Artist, Album, Genre, Is_Loved, Plays)
          VALUES (?, ?, ?, ?, ?, ?, ?)");

  // Binding values to prepared statement(Prevents SQL injection attacks)
  mysqli_stmt_bind_param($statement, "sssssii", $title, $length,
                        $artist, $album, $genre, $is_loved, $plays);

  // Open file in "read" mode
  $file = fopen("song-information.txt", "r");

  // Parses each line and assigns variables
  while(!feof($file)) {
    $line = fgets($file);
    $arr = explode("\t", $line);
    $title = $arr[0];
    $length = $arr[2];
    $artist = $arr[3];
    $album = $arr[4];
    $genre = $arr[5];
    $is_loved = $arr[6] == 0 ? 0 : 1;
    $plays = isset($arr[7]) ? intval($arr[7]) : 0;

    // Execute the prepared statement after updating the variables
    mysqli_stmt_execute($statement);
  }
}

if($should_restart_database) {
  restart_database($conn);
}

// Get information for a random song
$sql = "SELECT Title, Artist, Album FROM songs ORDER BY RAND() LIMIT 1";

$result = mysqli_query($conn, $sql);

// Loop over the result and diplay it
if(mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_assoc($result)) {

    $unnecessary_words = array("(Bonus Track)", "(Demo)", "(2018 Mix)",
                  "(2019 Mix)", "(Deluxe)", "(Deluxe Edition)",
                  "(Bonus Version)", "(Remastered)", "(Bonus Track Version)",
                  "[Super Deluxe]", "(Esher Demo)", "(Remix)");

    // Removes any unnecessary words from the title
    foreach($unnecessary_words as $uw) {
      if(strpos($row["Title"], $uw)) {
        str_replace($uw, "", $row["Title"]);
      }
      if(strpos($row["Artist"], $uw)) {
        str_replace($uw, "", $row["Artist"]);
      }
      if(strpos($row["Album"], $uw)) {
        str_replace($uw, "", $row["Album"]);
      }
    }

    // Creates a Song object and add it to the session array
    $song = new Song($row["Album"], $row["Title"], $row["Artist"]);
    array_push($_SESSION["answers"], $song);

    echo "<div id='title'>
            <h2>Title: </h2>
            <p>" . $row["Title"] . "</p>
          </div>";
    echo "<div id='artist'>
            <h2>Artist: </h2>
            <p>" . $row["Artist"] . "</p>
          </div>";
  }
}

mysqli_close($conn);

?>