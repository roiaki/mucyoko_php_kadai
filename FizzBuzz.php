<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>FizzBuzz</title>
</head>
<body>
  <table>
  <?php
  for($int = 1; $int < 100; $int ++) {
    if(($int % 15) == 0 ) {
      echo "FizzBuzz";
    } else if(($int % 3) == 0) {
      echo "Fizz";
    } else if(($int % 5) == 0) {
      echo "Buzz";
    } else {
      echo $int;
    }
    echo "    ";
  }
  ?>
</body>
</html>
