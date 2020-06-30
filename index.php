<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finish The Lyric</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>

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



    function restart_database($connection) {
      // Clears the table
      $sql = "DELETE FROM songs";
      mysqli_query($connection, $sql);

      // Preparing statement
      $statement = mysqli_prepare($connection, "INSERT INTO songs
              (Title, Length, Artist, Album, Genre, Is_Loved, Plays)
              VALUES (?, ?, ?, ?, ?, ?, ?)");

      // Binding values to prepared statement(Prevents SQL injection attacks)
      $statement->bind_param("sssssii", $title, $length, $artist, $album,
              $genre, $is_loved, $plays);

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
        $statement->execute();
      }
    }

    if($should_restart_database) {
      restart_database($conn);
    }

    mysqli_close($conn);
    ?>

    <h1 id="title">Song Quiz</h1>
    <div class="start-btn">
      <a href="game.html">Start</a>
    </div>
  </body>
</html>
