<?php
// var_dump($_POST);
// exit();

session_start();
include('functions.php');

$username = $_POST['user_name'];
$password = $_POST['password'];

$pdo = connect_to_db();

$sql = 'SELECT * FROM users_table WHERE user_name=:user_name AND password=:password ';

// exit('ok');

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_name', $username, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);
$status = $stmt->execute();

// exit('ok');

if ($status == false) {
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    $val = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$val) {
        echo '<p>ログインに誤りがあります。</p>';
        echo '<a href="log_in.php">login</a>';
        exit();
    } else {
        $_SESSION = array();
        $_SESSION['session_id'] = session_id();
        $_SESSION['user_name'] = $val['user_name'];
        header('Location:my_page.php');
        exit();
    }
}
