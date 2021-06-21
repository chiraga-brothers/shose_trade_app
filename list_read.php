<?php
session_start();
include("functions.php");
// check_session_id();

$pdo = connect_to_db();

$sql = "SELECT * FROM item_table";

$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

if ($status == false) {
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $output = "";
  foreach ($result as $record) {
    $output .= "<tr>";
    $output .= "<td>ここに画像</td>";
    $output .= "<td>{$record["item_name"]}</td>";
    $output .= "<td>{$record["size"]}</td>";
    $output .= "<td>{$record["maker"]}</td>";
    $output .= "<td>{$record["owner_id"]}</td>";
    $output .= "<td><a href='item_read.php?id={$record["id"]}'>詳細画面</a></td>";
    // $output .= "<td><a href='todo_delete.php?id={$record["id"]}'>delete</a></td>";
    // $output .= "<td><img src='{$record["image"]}' height=150px></td>";
    $output .= "</tr>";
  }
  unset($value);
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>出品リスト（一覧画面）</title>
</head>

<body>
  <fieldset>
    <legend>出品リスト（一覧画面）</legend>
    <!-- <a href="todo_input.php">入力画面</a> -->
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
        <?= $output ?>
      </tbody>
    </table>
  </fieldset>
</body>

</html>