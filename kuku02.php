<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
      <title>Ninety nine</title>
  </head>
  <body>
    <h1>Ninety nine</h1>
    <p>むちょこ課題 初級</p>
    <table border="1" width="200">
      <?php

      //row行出力　横
      for($row = 0; $row < 10; $row ++) {
        echo "<tr>";
        //col列出力　縦
        for($col = 0; $col < 10; $col ++) {
          if($row == 0 && $col == 0) {
             echo "<td>&nbsp;</td>";
          }
          //一番左　行見出し
          else if($row!== 0 && $col == 0) {
              echo "<th>".$row."</th>";
          }
          //一番上　列見出し
          else if($row == 0 ) {
             echo "<th>".$col."</th>";
          }
          else if($row * $col % 2 == 0 ) {
            echo "<td bgcolor=#cccccc>" . $row * $col . "</td>";
          }
          else {
             echo "<td>" . $row * $col . "</td>";
          }
        }
        echo "</tr>";
      }
      ?>
    </table>
  </body>
</html>
