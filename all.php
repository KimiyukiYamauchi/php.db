<?php require './header.php'; ?>
<?php
try {
	$pdo=new PDO('mysql:host=localhost;dbname=shop;charset=utf8', 
		'staff', 'password');

} catch (PDOException $e) {
	exit('エラー：' . $e->getMessage());
}
?>
<?php require './footer.php'; ?>
