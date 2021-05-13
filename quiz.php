<?php
var_dump($_POST);

// 変数の初期化
$page_flag = 0;
$clean = array();
$input = array();
//var_dump($page_flag);

// サニタイズ 無害化　$_POST : HTTP POST メソッドから現在のスクリプトに渡された変数の連想配列
if(!empty($_POST)) {
   
        foreach($_POST as $key => $value) {
            // 特殊文字を HTML エンティティに変換する。ENT_QUOTES:シングル、ダブルコーテションともに変換する
            $clean[$key] = htmlspecialchars($value, ENT_QUOTES);
        }
    
}


// 画面遷移
if( !empty($clean['btn_answer']) ) { 
    $page_flag = 1;  
}

var_dump($page_flag);

// 答え合わせクイズ１
if(isset($clean['quiz01'])) {
    
    if($clean['quiz01'] == "フライパン") {
        $ans01 = "正解";
    } else {
        $ans01 = "不正解";
    }
}

// 答え合わせクイズ２
if(isset($clean['quiz02']) ) {
        
    $quiz02 = implode(",", $clean['quiz02']);
    
    if(strstr($quiz02, '肉') && strstr($quiz02, '魚') ) {        
        $ans02 = "正解";
    } else {
        $ans02 = "不正解";
    }
}

// 答え合わせクイズ３
if(isset($clean['quiz03'])) {
    if($clean['quiz03'] == "1028" ) {
        $ans03 = "正解";
    } else {
        $ans03 = "不正解";
    } 
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>クイズ</title>

</head>
<body>
<!-- 問題ページ -->
<?php if($page_flag === 0): ?>
<div style="width: 300px; margin: auto;">
    <h1>クイズ</h1>
    <form action="" method="post">
        <P>Q.1 食べられないパンは？</P>
        <input type="text" name="quiz01" value="<?php if( !empty($clean['quiz01']) ){ echo $clean['quiz01']; } ?>">
    
        <br>

        <p>Q.2 タンパク質が多い食べ物は？</p>
        <label><input type="checkbox" name="quiz02[0]" value="米" >米</label>
        <br>
        <label><input type="checkbox" name="quiz02[1]" value="肉" >肉</label>
        <br>
        <label><input type="checkbox" name="quiz02[2]" value="魚" >魚</label>
        
        <br>
        <br>

        <p>Q.3 2の10乗は？</p>
        <label><input type="radio" name="quiz03" value="256" required>256</label>
        <label><input type="radio" name="quiz03" value="512" required>512</label>
        <label><input type="radio" name="quiz03" value="1028" required>1028</label>

        <br>
        <br>

        <input type="submit" name="btn_answer" value="回答する" >
    </form>
</div>
<?php endif; ?>


<!-- 答え合わせページ -->
<?php if($page_flag === 1): ?>
    <div style="width: 300px; margin: auto;">
        <h1>クイズ答え合わせ</h1>
    
        <P>Q.1 食べられないパンは？</P>
        <input type="text" name="quiz01" value="<?php if( !empty($clean['quiz01']) ){ echo $clean['quiz01']; } ?>">
        <br>
        <?php echo $ans01 ?>
        <br>

        <p>Q.2 タンパク質が多い食べ物は？</p>
        <label><input type="checkbox" name="quiz02[]" value="米" <?php if( !empty($clean['quiz02']) ){ echo 'checked'; } ?>>米</label>
        <br>
        <label><input type="checkbox" name="quiz02[]" value="肉" <?php if( !empty($clean['quiz02']) ){ echo 'checked'; } ?>>肉</label>
        <br>
        <label><input type="checkbox" name="quiz02[]" value="魚" <?php if( !empty($clean['quiz02']) ){ echo 'checked'; } ?>>魚</label>
        <br>
        <?php echo $ans02 ?>
        <br>
        <br>

        <p>Q.3 2の10乗は？</p>
        <input type="radio" name="quiz03" value="256" <?php if( !empty($clean['quiz03']) && $clean['quiz03'] === "256" ){ echo 'checked'; } ?> > 256
        <input type="radio" name="quiz03" value="512" <?php if( !empty($clean['quiz03']) && $clean['quiz03'] === "512" ){ echo 'checked'; } ?> > 512
        <input type="radio" name="quiz03" value="1028" <?php if( !empty($clean['quiz03']) && $clean['quiz03'] === "1028" ){ echo 'checked'; } ?> > 1028
        <br>
        <?php echo $ans03 ?>
        <br>
        <a href="quiz.php">戻る</a>
    </div>
<?php endif; ?>

</body>
</html>