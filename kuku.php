<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>九九表</title>
</head>
<body>
	<h1>九九表</h1>
	<table border=1 border=800>
    <?php
	for($row =0 ;$row <= 9; $row++){
		echo "<tr>";
		for($col=0; $col<=9; $col++) {
			if($col == 0 && $row==0) {
				echo "<th>&nbsp;</th>"; //一番左上のセル生成
			}
			else if($col == 0 && $row !== 0) { //行見出し生成（一番左上のセルを除く）
				echo "<th>".$row."</th>";
			} else if($row==0){
				echo "<th>".$col."</th>"; //列見出し生成（一番左上のセルを除く）
			} else {
				if(($col * $row) % 2 == 0 ) {
					echo "<td bgcolor=#cccccc>" . $col * $row . "</td>";
				} else {
					echo "<td>".$col*$row."</td>"; //その他のセル（行×列）
				}
			}
		}
				echo "</tr>";
	}
    ?>
    </table>
	<p>はじめてのHTMLを作りました</p>
</body>
</html>
