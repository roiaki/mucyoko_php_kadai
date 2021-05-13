<?php
var_dump($_POST);

/* 
 * page_flag == 0 入力ページ
 * page_flag == 1 確認ページ
 * page_flag == 2 完了ページ
 */

 // 変数初期化
$page_flag = 0;
$clean = array();
$error = array();

// サニタイズ 無害化　$_POST : HTTP POST メソッドから現在のスクリプトに渡された変数の連想配列
if(!empty($_POST)) {
	foreach($_POST as $key => $value) {
		// 特殊文字を HTML エンティティに変換する。ENT_QUOTES:シングル、ダブルコーテションともに変換する
		$clean[$key] = htmlspecialchars($value, ENT_QUOTES);
	}
}

// empty：null, 0, falseも空と判断される。isset：null はfalse
if( !empty($clean['btn_confirm'])) {

	$error = validation($clean);

	//　バリデーションエラーがなかったら確認画面へ、エラーがあったら入力画面のまま page_flag = 0
	if( empty($error) ) {
		$page_flag =1;

		// 確認ページでセッションの書き込み
		session_start();
		$_SESSION['page'] = true;
	}

} elseif( !empty($clean['btn_submit']) ) {

	session_start();
	if( !empty($_SESSION['page']) && $_SESSION['page'] === true ) {

		// セッションの削除
		unset($_SESSION['page']);
	
		$page_flag = 2;

	// メール送信機能

	// 変数とタイムゾーンを初期化
	$auto_reply_subject = null;
	$auto_reply_text = null;
	date_default_timezone_set('Asia/Tokyo');

	// 件名を設定
	$auto_reply_subject = 'お問い合わせありがとうございます。';

	// 本文を設定
	$auto_reply_text = "この度は、お問い合わせ頂き誠にありがとうございます。下記の内容でお問い合わせを受け付けました。\n\n";
	$auto_reply_text .= "お問い合わせ日時：" . date("Y-m-d H:i") . "\n";
	$auto_reply_text .= "氏名：" . $_POST['your_name'] . "\n";
	$auto_reply_text .= "メールアドレス：" . $_POST['email'] . "\n\n";
	$auto_reply_text .= "hoge 事務局";

	// メール送信
	mb_send_mail( $_POST['email'], $auto_reply_subject, $auto_reply_text);

	} else {
		$page_flag = 0;
	}
}		


	// バリデーション用関数
	function validation($data) {

		$error = array();

		// 氏名のバリデーション
		if(empty($data['your_name']) ) {	
			$error[] = "名前を入力してください。";
		} elseif( 20 < mb_strlen($data['your_name']) ) {
			$error[] = "「氏名」は20文字以内で入力してください。";
		}

		// メールアドレスのバリデーション
		if( empty($data['email']) ) {
			$error[] = "「メールアドレス」は必ず入力してください。";
		} elseif( !preg_match( '/^[0-9a-z_.\/?-]+@([0-9a-z-]+\.)+[0-9a-z-]+$/', $data['email']) ) {
			$error[] = "「メールアドレス」は正しい形式で入力してください。";
		}

		// 性別のバリデーション
		if( empty($data['gender']) ) {
			$error[] = "「性別」は必ず入力してください。";
		} elseif( $data['gender'] !== 'male' && $data['gender'] !== 'female' ) {
			$error[] = "「性別」は必ず入力してください。";
		}

		// 年齢のバリデーション
		if( empty($data['age']) ) {
			$error[] = "「年齢」は必ず入力してください。";
		} elseif( (int)$data['age'] < 1 || 6 < (int)$data['age'] ) {
			$error[] = "「年齢」は必ず入力してください。";
		}

		// お問い合わせ内容のバリデーション
		if( empty($data['contact']) ) {
			$error[] = "「お問い合わせ内容」は必ず入力してください。";
		}

		// プライバシーポリシー同意のバリデーション
		if( empty($data['agreement']) ) {
			$error[] = "プライバシーポリシーをご確認ください。";
		} elseif( (int)$data['agreement'] !== 1 ) {
			$error[] = "プライバシーポリシーをご確認ください。";
		}

		return $error;
	}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<link rel="stylesheet" href="sample.css">
	<title>お問い合わせフォーム</title>

</head>
<body>
<h1>お問い合わせフォーム</h1>

<?php if( $page_flag === 1 ): ?>

<!-- page_flag === 1 の場合　確認ページが入る -->
<form method="post" action="">
	<div class="element_wrap">
		<label>氏名</label>
		<p><?php echo $_POST['your_name']; ?></p>
	</div>
	<div class="element_wrap">
		<label>メールアドレス</label>
		<p><?php echo $_POST['email']; ?></p>
	</div>
	<input type="submit" name="btn_back" value="戻る">
	<input type="submit" name="btn_submit" value="送信">
	<input type="hidden" name="your_name" value="<?php echo $_POST['your_name']; ?>">
	<input type="hidden" name="email" value="<?php echo $_POST['email']; ?>">
</form>

<?php elseif( $page_flag === 2 ): ?>

<!-- page_flag === 2 の場合、送信完了ページ -->
<p>送信が完了しました。</p>

<!-- action属性が空の場合はindex.php自身に送信される
  page_flage === 0 の場合　入力フォーム
-->
<?php else: ?>

	<!-- バリデーションエラーメッセージを表示 -->
	<?php if( !empty($error) ): ?>
		<ul class="error_list">
		<?php foreach( $error as $value ): ?>
			<li><?php echo $value; ?></li>
		<?php endforeach; ?>
		</ul>
	<?php endif; ?>

<form method="post" action="">
	<div class="element_wrap">
		<label>氏名</label>
		<!-- value 入力値を引き継ぐ -->
		<input type="text" name="your_name" value="<?php if( !empty($_POST['your_name']) ){ echo $_POST['your_name']; } ?>">
	</div>
	<div class="element_wrap">
		<label>メールアドレス</label>
		<!-- value 入力値を引き継ぐ -->
		<input type="text" name="email" value="<?php if( !empty($_POST['email']) ){ echo $_POST['email']; } ?>">
	</div>
	<div class="element_wrap">
		<label>性別</label>
		<label for="gender_male"><input id="gender_male" type="radio" name="gender" value="male" 
		<?php if( !empty($clean['gender']) && $clean['gender'] === "male" ){ echo 'checked'; } ?>>男性</label>
		<label for="gender_female"><input id="gender_female" type="radio" name="gender" value="female" 
		<?php if( !empty($clean['gender']) && $clean['gender'] === "female" ){ echo 'checked'; } ?>>女性</label>
	</div>
	<div class="element_wrap">
		<label>年齢</label>
		<select name="age">
			<option value="">選択してください</option>
			<option value="1" <?php if( !empty($clean['age']) && $clean['age'] === "1" ){ echo 'selected'; } ?>>〜19歳</option>
			<option value="2" <?php if( !empty($clean['age']) && $clean['age'] === "2" ){ echo 'selected'; } ?>>20歳〜29歳</option>
			<option value="3" <?php if( !empty($clean['age']) && $clean['age'] === "3" ){ echo 'selected'; } ?>>30歳〜39歳</option>
			<option value="4" <?php if( !empty($clean['age']) && $clean['age'] === "4" ){ echo 'selected'; } ?>>40歳〜49歳</option>
			<option value="5" <?php if( !empty($clean['age']) && $clean['age'] === "5" ){ echo 'selected'; } ?>>50歳〜59歳</option>
			<option value="6" <?php if( !empty($clean['age']) && $clean['age'] === "6" ){ echo 'selected'; } ?>>60歳〜</option>
		</select>
	</div>
	
	<div class="element_wrap">
		<label>お問い合わせ内容</label>
		<textarea name="contact"><?php if( !empty($clean['contact']) ){ echo $clean['contact']; } ?></textarea>
	</div>
	<div class="element_wrap">
		<label for="agreement"><input id="agreement" type="checkbox" name="agreement" value="1">プライバシーポリシーに同意する</label>
	</div>
	<input type="submit" name="btn_confirm" value="入力内容を確認する">
</form>

<?php endif; ?>
</body>
</html>