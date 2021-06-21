<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>todoリストログイン画面</title>
</head>

<body>
  <form action="Log_in_act.php" method="POST">
    <fieldset>
      <legend>todoリストログイン画面</legend>
      <div>
        username: <input type="text" name="user_name">
      </div>
      <div>
        password: <input type="text" name="password">
      </div>
      <div>
        <button>Login</button>
      </div>
      <a href="Sign_up.php">or register</a>
    </fieldset>
  </form>

</body>

</html>