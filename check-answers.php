<?php
include "song.php";

// Get information from database.php
session_start();
$answers = $_SESSION["answers"];

$inputs = json_decode($_REQUEST["inputs"]);
foreach($inputs as $in) {
  echo $in . "<br />";
}
echo "<br />";
echo "<br />";


// Display the title of every song that appeared
foreach($answers as $ans) {
  echo $ans->get_title() . "<br />";
}



session_unset();
?>