<?php require './header.php'; ?>
<?php
try {
	$pdo=new PDO('mysql:host=localhost;dbname=shop;charset=utf8', 
		'staff', 'password');
	$stmt = $pdo->query('select * from product');
} catch (PDOException $e) {
	exit('エラー：' . $e->getMessage());
}

while ($row = $stmt->fetch()) {
	echo '<p>';
	echo $row['id'], ':';
	echo $row['name'], ':';
	echo $row['price'];
	echo '</p>';
}
?>
<?php require './footer.php'; ?>
