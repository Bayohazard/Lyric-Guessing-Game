<?php
session_start();
if (isset($_SESSION["song-information"])) {
  $results = $_SESSION["song-information"];
}
?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>Results</title>
   </head>
   <body>
     <table>
       <tr>
         <th>Artist</th>
         <th>Song</th>
         <th>Album</th>
         <th>Your Answer</th>
       </tr>
       <?php
       foreach ($results as $result):
         $result = json_decode($result, true);
        ?>
         <tr>
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
       <tr>

       </tr>
     </table>
   </body>
 </html>