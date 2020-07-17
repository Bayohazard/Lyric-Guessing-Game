<html>

<h1>
  <?php
  $answers = [1, 0, 1, 0, 1, 0];

$username = 'bayop2020';

  echo 'Bayo';
?>
</h1>

<h3>Username: <?= $username; ?></h3>

<table>
  <?php foreach ($answers as $answer):
  echo '<tr>
    <td>
    answer

    </td>
    <td>';
    echo $answer == 1 ? 'Correct' : 'Wrong';
echo '
    </td>
  </tr>';
  endforeach;
?>
</table>

</html>
<?php
 ?>