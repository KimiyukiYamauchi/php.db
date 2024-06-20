<?php require './header.php'; ?>
<table>
<tr><th>商品番号</th><th>商品名</th><th>価格</th></tr>
<?php
try {
	$pdo=new PDO('mysql:host=localhost;dbname=shop;charset=utf8', 
		'staff', 'password');
	$stmt = $pdo->query('select * from product');
} catch (PDOException $e) {
	exit('エラー：' . $e->getMessage());
}

while ($row = $stmt->fetch()) {
	echo '<tr>';
	echo '<td>', $row['id'], '</td>';
	echo '<td>', $row['name'], '</td>';
	echo '<td>', $row['price'], '</td>';
	echo '</tr>';
	echo "\n";
}
?>
</table>
<?php require './footer.php'; ?>
