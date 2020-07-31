<?php
session_start();
if (isset($_SESSION["song-information"])) {
  $results = $_SESSION["song-information"];
} else {
  $results = array();
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
 <head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Results</title>
   <link rel="stylesheet" href="style.css">
 </head>
 <body>
   <h1>Results</h1>
   <div class="table-div">
     <table rules="none">
       <tr>
         <th>Artist</th>
         <th>Song</th>
         <th>Album</th>
         <th>Your Answer</th>
       </tr>
       <?php
       foreach ($results as $result):
         $result = json_decode($result, true);
         similar_text($result["Album"], $result["Input"], $percent);
         $correctness = $percent > 75 ? "correct" : "incorrect";
        ?>
       <tr class="<?php echo $correctness?>">
         <td><?php echo $result["Artist"]?></td>
         <td><?php echo $result["Title"]?></td>
         <td><?php echo $result["Album"]?></td>
         <td><?php echo $result["Input"]?></td>
       </tr>
       <?php endforeach ?>

       <?php
       unset($_SESSION["song-information"]);
       session_destroy();
       ?>
     </table>
   </div>
 </body>
</html>