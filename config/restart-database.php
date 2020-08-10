<?php
echo "RESTARTING DATABASE...\n";

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
$file = fopen(SONG_INFORMATION_FILENAME, "r");

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

echo "DATABASE RESTARTED SUCCESSFULLY";
?>
