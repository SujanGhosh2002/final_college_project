<?php

include 'components/connect.php';

if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = '';
}

if (isset($_POST['submit'])) {

    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $pass = sha1($_POST['pass']);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);

    $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ? LIMIT 1");
    $select_user->execute([$email, $pass]);
    $row = $select_user->fetch(PDO::FETCH_ASSOC);

    if ($select_user->rowCount() > 0) {
        setcookie('user_id', $row['id'], time() + 60 * 60 * 24 * 30, '/');
        header('location:user_home.php');
    } else {
        echo
            '<div >
      <p>incorrect email or password!</p>
      </div>
      ';
    }

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="sign-up-in-box">
        <form class="signin-form" action="" method="post" enctype="multipart/form-data">
            <div class="form-header">
                <h3>Welcome Back</h3>
            </div>
            <div class="form-group">
                <label for="">your email<span>*</span><br>
                    <input type="email" name="email" class="form-input" maxlength="50" placeholder="email@example.com">
                </label>
            </div>
            <div class="form-group">
                <label for="">your password<span>*</span><br>
                    <input type="password" class="form-input" name="pass" placeholder="enter your password">
                </label>
            </div>
            <div class="form-group">
                <button class="form-button btn" name="submit" type="submit">SignIn Now</button>
            </div>
            <div class="form-footer">
                Don't have an account? <a href="signup.php">SignUp now</a>
            </div>
        </form>>
    </div>
</body>

</html>