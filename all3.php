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
	echo "<p>$row[id]:$row[name]:$row[price]</p>";
}
?>
<?php require './footer.php'; ?>
