<?php
// var_dump($_POST);
// exit();

include('functions.php');

if (
    !isset($_POST['user_name']) || $_POST['user_name'] == '' ||
    !isset($_POST['mail']) || $_POST['mail'] == '' ||
    !isset($_POST['password']) || $_POST['password'] == '' ||
    !isset($_POST['addres']) || $_POST['addres'] == '' ||
    !isset($_POST['phone']) || $_POST['phone'] == ''
) {
    exit('Param Error');
}
// exit('ok');


$user_name = $_POST["user_name"];
$mail = $_POST["mail"];
$password = $_POST["password"];
$addres = $_POST["addres"];
$phone = $_POST["phone"];
// exit('ok');

// DB接続
$dbn = 'mysql:dbname=chiraga;charset=utf8;port=3306;host=localhost';
$user = 'root';
$pwd = '';

// DB接続
try {
    $pdo = new PDO($dbn, $user, $pwd);
} catch (PDOException $e) {
    echo json_encode(["db error" => "{$e->getMessage()}"]);
    exit();
}
// exit('ok');

$sql = 'INSERT INTO users_table (id, user_name, mail, password, addres, phone, created_at, updated_at)VALUES  (NULL, :user_name, :mail, :password, :addres, :phone, sysdate(), sysdate())';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_name', $user_name, PDO::PARAM_STR);
$stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);
$stmt->bindValue(':addres', $addres, PDO::PARAM_STR);
$stmt->bindValue(':phone', $phone, PDO::PARAM_STR);
$status = $stmt->execute();

// exit('ok');

if ($status == false) {
    $error = $stmt->errorInfo();
    exit('sqlError:' . $error[2]);
} else {
    header('Location:my_page.php');
}
