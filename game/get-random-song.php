<?php
include '../config/connect-database.php';

// Get information for a random song
$sql = "SELECT Title, Artist, Album FROM songs ORDER BY RAND() LIMIT 1";

$result = mysqli_query($conn, $sql);

// Loop over the result and diplay it
if(mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_assoc($result)) {

    removeUnnecessaryWords($row);

    // Creates an array with the song information, turns it into JSON, and returns it
    $result_array = array("Title" => $row["Title"], "Album" => $row["Album"],
    "Artist" => $row["Artist"]);
    $result_json = json_encode($result_array);
    echo $result_json;
  }
}

function removeUnnecessaryWords($row) {
  $unnecessary_words = array("(Bonus Track)", "(Demo)", "(2018 Mix)",
                "(2019 Mix)", "(Deluxe)", "(Deluxe Edition)",
                "(Bonus Version)", "(Remastered)", "(Bonus Track Version)",
                "[Super Deluxe]", "(Esher Demo)", "(Remix)");

  // Removes any unnecessary words from the title
  foreach($unnecessary_words as $uw) {
    if(strpos($row["Title"], $uw)) {
      $row["Title"] = str_replace($uw, "", $row["Title"]);
    }
    if(strpos($row["Artist"], $uw)) {
      $row["Artist"] = str_replace($uw, "", $row["Artist"]);
    }
    if(strpos($row["Album"], $uw)) {
      $row["Album"] = str_replace($uw, "", $row["Album"]);
    }
  }
}
 ?>