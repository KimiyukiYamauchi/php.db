<?php require './header.php'; ?>
<?php
try {
	// PDOインスタンスの作成(DBへの接続)
	$pdo=new PDO('mysql:host=localhost;dbname=shop;charset=utf8', 
		'staff', 'password');
	// プリペアードステートメントを作成
	$stmt = $pdo->prepare('insert into product values(null, :name, :price)');
	$ret = false;
	if (empty($_POST['name'])) {
		echo '<p>商品名を入力してください。</p>';
	} else if (!preg_match('/[0-9]+/', $_POST['price'])) {
		echo '<p>商品価格を整数で入力してください。</p>';
	} else {
		// プリペアードステートメントにパラメータを割り当てる
		$stmt->bindParam(':name', $_POST['name'], PDO::PARAM_STR);
		$stmt->bindParam(':price', $_POST['price'], PDO::PARAM_INT);
		// SQLを実行
		$ret = $stmt->execute();
	}
} catch (PDOException $e) {
	exit('エラー：' . $e->getMessage());
}

if ($ret) {
	echo '追加に成功しました。';
} else {
	echo '追加に失敗しました。';
}
?>
<?php require './footer.php'; ?>
