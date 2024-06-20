<?php require './header.php'; ?>
<?php
try {
	$pdo=new PDO('mysql:host=localhost;dbname=shop;charset=utf8', 
		'staff', 'password');
	
	$sql=$pdo->prepare('select * from product where name like ?');
	$ret = $sql->execute(['%' . $_REQUEST['keyword'] . '%']);
} catch (PDOException $e) {
	exit('エラー' . $e->getMessage());
}
if ($ret) {
	if ($sql->rowCount() > 0) {
		echo '<table>' . PHP_EOL;
		echo '<tr><th>商品番号</th><th>商品名</th><th>商品価格</th></tr>' . PHP_EOL;
		while ($row = $sql->fetch()) {
			echo '<tr>';
			echo '<td>', $row['id'], '</td>';
			echo '<td>', $row['name'], '</td>';
			echo '<td>', $row['price'], '</td>';
			echo '</tr>';
			echo "\n";
		}
	} else {
		echo "<p>データが見つかりませんでした。</p>";
	}
} else {
	echo "<p>検索に失敗しました。</p>";
}
?>
</table>
<?php require './footer.php'; ?>
