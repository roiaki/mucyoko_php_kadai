<?php
// クイズ１
$question01 = $_POST['quiz01'];

if(isset($question01)) {
    
    if($question01 == "フライパン") {
        $ans01 = "正解";
    } else {
        $ans01 = "不正解";
    }
}

// クイズ２
if(isset($_POST['quiz02']) ) {
        
    $quiz02 = implode(",", $_POST['quiz02']);
    
    if(strstr($quiz02, '肉') && strstr($quiz02, '魚') ) {
        
        $ans02 = "正解";

    } else {
        $ans02 = "不正解";
    }
    
} else {
    $error02 = "入力してください。";
}

// クイズ３
if(isset($_POST['quiz03'])) {
    if($_POST['quiz03'] == "1028" ) {
        $ans03 = "正解";
    } else {
        $ans03 = "不正解";
    } 
} else {
    $error03 = "入力してください。";
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>クイズ</title>
    <style>
        p.ans {color: red; }
    </style>
</head>
<body>
<div style="width: 300px; margin: auto;">
    <h1>クイズ</h1>
    <P>Q.1 食べられないパンは？</P>
    <p>あなたの答え：<?php print $_POST['quiz01']; ?></p>
    <p class="ans"><?php print $ans01;?></p>

    <p>Q.2 タンパク質が多い食べ物は？</p>
    <p>あなたの答え：<?php print $quiz02 = implode(",", $_POST['quiz02']); ?></p>
    <p class="ans"><?php print $ans02;?></p>

    <p>Q.3 2の10乗は？</p>
    <p>あなたの答え：<?php print $_POST['quiz03']; ?></p>
    <p class="ans"><?php print $ans03;?></p>

    <br>

    <a href="quiz.php">問題へ</a>
</div>
</body>
</html>