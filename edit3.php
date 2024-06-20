<?php require './header.php'; ?>
<div class="th0">商品番号</div>
<div class="th1">商品名</div>
<div class="th1">商品価格</div>
<br>
<?php
$pdo=new PDO('mysql:host=localhost;dbname=shop;charset=utf8', 
	'staff', 'password');
if (isset($_POST['command'])) {
	switch ($_POST['command']) {
	case 'insert':
		if (empty($_POST['name']) || 
			!preg_match('/[0-9]+/', $_POST['price'])) break;
		$sql=$pdo->prepare('insert into product values(null,?,?)');
		$sql->execute(
			[htmlspecialchars($_POST['name']), $_POST['price']]);
		break;
	case 'update':
		if (empty($_POST['name']) || 
			!preg_match('/[0-9]+/', $_POST['price'])) break;
		$sql=$pdo->prepare(
			'update product set name=?, price=? where id=?');
		$sql->execute(
			[htmlspecialchars($_POST['name']), $_POST['price'], 
			$_POST['id']]);
		break;
	case 'delete':
		$sql=$pdo->prepare('delete from product where id=?');
		$sql->execute([$_POST['id']]);
		break;
	}
	// 処理が完了したら、自分自身のページをリダイレクトする
	header("Location: " . $_SERVER['REQUEST_URI']);
	exit();
}
foreach ($pdo->query('select * from product') as $row) {
	echo '<form class="ib" action="edit3.php" method="post">';
	echo '<input type="hidden" name="command" value="update">';
	echo '<input type="hidden" name="id" value="', htmlspecialchars($row['id']), '">';
	echo '<div class="td0">';
	echo htmlspecialchars($row['id']);
	echo '</div> ';
	echo '<div class="td1">';
	echo '<input type="text" name="name" value="', htmlspecialchars($row['name']), '">';
	echo '</div> ';
	echo '<div class="td1">';
	echo '<input type="text" name="price" value="', htmlspecialchars($row['price']), '">';
	echo '</div> ';
	echo '<div class="td2">';
	echo '<input type="submit" value="更新">';
	echo '</div> ';
	echo '</form> ';
	echo '<form class="ib" action="edit3.php" method="post">';
	echo '<input type="hidden" name="command" value="delete">';
	echo '<input type="hidden" name="id" value="', htmlspecialchars($row['id']), '">';
	echo '<input class="deleteButton" type="submit" value="削除">';
	echo '</form>';
	echo "<br>\n";
}
?>
<form action="edit3.php" method="post">
<input type="hidden" name="command" value="insert">
<div class="td0"></div>
<div class="td1"><input type="text" name="name"></div>
<div class="td1"><input type="text" name="price"></div>
<div class="td2"><input type="submit" value="追加"></div>
</form>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const deleteButtons = document.querySelectorAll('.deleteButton');

    deleteButtons.forEach(function(button) {
        button.addEventListener('click', function(event) {
            const userConfirmed = confirm('本当に削除しますか？');

            if (!userConfirmed) {
                event.preventDefault(); // フォームの送信を中止
            }
        });
    });
});
</script>
<?php require './footer.php'; ?>
