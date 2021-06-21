<?php
include('functions.php');

// var_dump($_POST);
// exit();

if (
  !isset($_POST['user_name']) || $_POST['user_name'] == '' ||
  !isset($_POST['mail']) || $_POST['mail'] == '' ||
  !isset($_POST['password']) || $_POST['password'] == '' ||
  !isset($_POST['address']) || $_POST['address'] == '' ||
  !isset($_POST['phone']) || $_POST['phone'] == ''
) {
  echo json_encode(["error_msg" => "no input"]);
  exit();
}

$user_name = $_POST["user_name"];
$mail = $_POST["mail"];
$password = $_POST["password"];
$address = $_POST["address"];
$phone = $_POST["phone"];

$pdo = connect_to_db();

// $sql = 'SELECT COUNT(*) FROM users_table WHERE username=:username';

// $stmt = $pdo->prepare($sql);
// $stmt->bindValue(':username', $username, PDO::PARAM_STR);
// $status = $stmt->execute();

// if ($status == false) {
//   $error = $stmt->errorInfo();
//   echo json_encode(["error_msg" => "{$error[2]}"]);
//   exit();
// }

// if ($stmt->fetchColumn() > 0) {
//   echo "<p>すでに登録されているユーザです．</p>";
//   echo '<a href="todo_login.php">login</a>';
//   exit();
// }

$sql = 'INSERT INTO users_table(id, user_name, mail, password, address, phone, created_at, updated_at)VALUES(NULL, :user_name, :mail, :password, :address, :phone, sysdate(), sysdate())';



$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_name', $user_name, PDO::PARAM_STR);
$stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);
$stmt->bindValue(':address', $address, PDO::PARAM_STR);
$stmt->bindValue(':phone', $phone, PDO::PARAM_STR);
$status = $stmt->execute();

if ($status == false) {
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  header("Location:Log_in.php");
  exit();
}
