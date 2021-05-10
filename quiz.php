<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>クイズ</title>
    <style>
        p.true {color: red; }
    </style>
</head>
<body>


<br/>
<div style="width: 300px; margin: auto;">
<h1>クイズ</h1>
<form action="answer.php" method="post">
    <P>Q.1 食べられないパンは？</P>
    <input type="text" name="quiz01" required/>
 
    <br>

    <p>Q.2 タンパク質が多い食べ物は？</p>
    <input type="checkbox" name="quiz02[]" value="米" >米
    <br>
    <input type="checkbox" name="quiz02[]" value="肉" >肉
    <br>
    <input type="checkbox" name="quiz02[]" value="魚" >魚
    
    <br>
    <br>

    <p>Q.3 2の10乗は？</p>
    <input type="radio" name="quiz03" value="256" required>256
    <input type="radio" name="quiz03" value="512" required>512
    <input type="radio" name="quiz03" value="1028" required>1028

    <br>
    <br>

    <input type="submit"/>
</form>
</div>
<?php //echo $_POST['quiz01'] ?> </P>

</body>
</html>

