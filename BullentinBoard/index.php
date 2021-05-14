<?php
var_dump($_POST);
// メッセージを保存するファイルのパス設定
define( 'FILENAME', './message.txt');

?>





<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="css/main.css">
<title>ひと言掲示板</title>

</head>
<body>
<h1>ひと言掲示板</h1>
<!-- ここにメッセージの入力フォームを設置 -->
<form method="post">
	<div>
		<label for="view_name">表示名</label>
		<input id="view_name" type="text" name="view_name" value="">
	</div>
	<div>
		<label for="message">ひと言メッセージ</label>
		<textarea id="message" name="message"></textarea>
	</div>
	<input type="submit" name="btn_submit" value="書き込む">
</form>
<hr>
<section>
<!-- ここに投稿されたメッセージを表示 -->
</section>
</body>
</html>
