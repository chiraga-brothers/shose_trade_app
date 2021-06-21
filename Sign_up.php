<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ユーザ登録画面</title>
</head>

<body>
  <form action="Sign_up_act.php" method="POST">
    <fieldset>
      <legend>ユーザ登録画面</legend>
      <div>
        username: <input type="text" name="user_name">
      </div>
      <div>
        mail: <input type="text" name="mail">
      </div>
      <div>
        password: <input type="text" name="password">
      </div>
      <div>
        address: <input type="text" name="address">
      </div>
      <div>
        phone: <input type="text" name="phone">
      </div>
      <div>
        <button>Register</button>
      </div>
      <a href="Log_in.php">or login</a>
    </fieldset>
  </form>

</body>

</html>