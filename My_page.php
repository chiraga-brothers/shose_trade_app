<?php
session_start();
include("functions.php");
check_session_id();

$pdo = connect_to_db();

$sql = "SELECT * FROM item_table";

$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

// var_dump($status);
// exit();

$session_id = $_SESSION['id'];


if ($status == false) {
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $output = "";
  foreach ($result as $record) {
    $output .= "<tr>";
    $output .= "<td>{$record["owner_id"]}</td>";
    $output .= "<td>{$record["item_name"]}</td>";
    $output .= "<td>{$record["maker"]}</td>";
    $output .= "<td>{$record["size"]}</td>";
    $output .= "<td><a href='todo_edit.php?id={$record["id"]}'>商品情報編集</a></td>";
    $output .= "<td><a href='todo_delete.php?id={$record["id"]}'>出品取り消し</a></td>";
    $output .= "</tr><tr>";
    $output .= "<td></td><td></td><td></td><td></td><td></td><td><img src='{$record["image"]}' height=150px></td>";
    $output .= "</tr><tr>";
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
  <title>マイページ</title>
  <style>
    a {
      margin: 0 10px;
    }
  </style>
</head>

<body>
  <p>現在のuser_id<?= $session_id ?></p>
  <a href="My_list.php">自分の出品中の商品一覧ページへ</a>
  <fieldset>
    <legend>商品一覧</legend>
    <a href="Item_input.php">新規出品</a>
    <a href="Log_out.php">ログアウト</a>
    <table>
      <thead>
        <tr>
          <th>出品者ID</th>
          <th>商品名</th>
          <th>メーカー</th>
          <th>サイズ</th>
          <th></th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?= $output ?>
      </tbody>
    </table>
  </fieldset>
</body>

</html>