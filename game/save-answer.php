<?php
session_start();

// Initialize the array the first time
if (!isset($_SESSION["song-information"])) {
  $_SESSION["song-information"] = array();
}

if (isset($_POST["input"])) {
  // Add the information from AJAX request to session array
  array_push($_SESSION["song-information"], $_POST["input"]);
} else {
  // If something goes wrong, add an empty string
  array_push($_SESSION["song-information"], "");
}
?>