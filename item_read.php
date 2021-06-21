<?php
// var_dump($_GET);
// exit();

session_start();
include("functions.php");
// check_session_id();

$id = $_GET["id"];

$pdo = connect_to_db();

$sql = "SELECT * FROM item_table WHERE id=:id";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  $record = $stmt->fetch(PDO::FETCH_ASSOC);
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>アイテム（詳細画面）</title>
</head>

<body>
  <fieldset>
    <legend>アイテム（詳細画面）</legend>
    <a href="list_read.php">戻る</a>
    <!-- <a href="todo_logout.php">logout</a> -->
    <table>
      <thead>
        <tr>
          <th>画像</th>
          <th>スニーカー</th>
          <th>サイズ</th>
          <th>メーカー</th>
          <th>出品者</th>
        </tr>
      </thead>
      <tbody>
        <!-- ここに<tr><td>deadline</td><td>todo</td><tr>の形でデータが入る -->
        <tr>
          <td>ここに画像</td>
          <td><?= $record["item_name"] ?></td>
          <td><?= $record["size"] ?></td>
          <td><?= $record["maker"] ?></td>
          <td><?= $record["owner_id"] ?></td>
        <tr>
          <?= $output ?>
      </tbody>
    </table>
  </fieldset>
</body>

</html>