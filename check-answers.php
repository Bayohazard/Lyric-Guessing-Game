<?php
include "song.php";

// Get information from database.php
session_start();
$answers = $_SESSION["answers"];

if(isset($_GET["input"])) {
  $name = $_GET["input"];
  echo "<br /> Inside GET";
  echo $name;
  echo "<br />";
}

// Display the title of every song that appeared
foreach($answers as $ans) {
  echo $ans->get_title() . "<br />";
}



session_unset();
?>