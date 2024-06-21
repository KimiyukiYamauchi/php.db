<?php require './header.php'; ?>
<?php
try {
	$pdo=new PDO('mysql:host=localhost;dbname=shop;charset=utf8', 
		'staff', 'password');
	$sql=$pdo->prepare('insert into product values(null, ?, ?)');
	$ret = false;
	if (empty($_POST['name'])) {
		echo '<p>商品名を入力してください。</p>';
	} else if (!preg_match('/[0-9]+/', $_POST['price'])) {
		echo '<p>商品価格を整数で入力してください。</p>';
	} else {
		$ret = $sql->execute([htmlspecialchars($_POST['name']), $_POST['price']]);
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
