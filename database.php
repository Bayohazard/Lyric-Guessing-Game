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

?>