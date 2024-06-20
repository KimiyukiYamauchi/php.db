php<?php require './header.php'; ?>
<?php
try {
	$pdo=new PDO('mysql:host=localhost;dbname=shop;charset=utf8', 
		'staff', 'password');
	$sql=$pdo->prepare('update product set name=?, price=? where id=?');
	$ret = false;
	if (empty($_POST['name'])) {
		echo '商品名を入力してください。';
	} else
	if (!preg_match('/[0-9]+/', $_POST['price'])) {
		echo '商品価格を整数で入力してください。';
	} else {
		$ret = $sql->execute(
			[htmlspecialchars($_POST['name']), $_POST['price'], $_POST['id']]
		);
	}
} catch (PDOException $e) {
	exit('エラー：' . $e->getMessage());
}

if ($ret) {
	echo '更新に成功しました。';
} else {
	echo '更新に失敗しました。';
}
?>
<?php require './footer.php'; ?>
