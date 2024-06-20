<?php require './header.php'; ?>
<?php
try {
	$pdo=new PDO('mysql:host=localhost;dbname=shop;charset=utf8', 
	'staff', 'password');
	$sql=$pdo->prepare('insert into product values(null, ?, ?)');
	$ret = $sql->execute([$_POST['name'], $_REQUEST['price']]);
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
