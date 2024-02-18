<?php

include 'components/connect.php';

if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = '';
}

if (isset($_POST['submit'])) {


    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $pass = sha1($_POST['pass']);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);
    $cpass = sha1($_POST['cpass']);
    $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $ext = pathinfo($image, PATHINFO_EXTENSION);
    $rename = unique_id() . '.' . $ext;
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'uploaded_files/' . $rename;

    $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
    $select_user->execute([$email]);

    if ($select_user->rowCount() > 0) {
        echo
            '<div>
      <p>email already taken!</p>
      </div>';
    } else {
        if ($pass != $cpass) {
            echo
                '<div>
         <p>confirm passowrd not matched!<p>
         </div>';
        } else {
            $insert_user = $conn->prepare("INSERT INTO `users`( name, email, password, image) VALUES(?,?,?,?)");
            $insert_user->execute([$name, $email, $cpass, $rename]);
            move_uploaded_file($image_tmp_name, $image_folder);

            $verify_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ? LIMIT 1");
            $verify_user->execute([$email, $pass]);
            $row = $verify_user->fetch(PDO::FETCH_ASSOC);

            if ($verify_user->rowCount() > 0) {
                setcookie('user_id', $row['id'], time() + 60 * 60 * 24 * 30, '/');
                header('location:user_home.php');
            }
        }
    }

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="sign-up-in-box">
        <form class="signup-form" action="" method="post" enctype="multipart/form-data">
            <div class="form-header">
                <h3>Create Account</h3>
            </div>
            <div class="form-group form-group-flex">
                <label for="">your name<br>
                    <input type=" text" name="name" required class="form-input" placeholder="enter your name">
                </label>
                <label for="">your password<br>
                    <input type="password" name="pass" required class="form-input" placeholder="enter your password">
                </label>
            </div>
            <div class="form-group form-group-flex">
                <label for="">your email<br>
                    <input type="email" name="email" required class="form-input" placeholder="email@example.com">
                </label>
                <label for="">confirm password<br>
                    <input type="password" name="cpass" required class="form-input" placeholder="enter your password">
                </label>
            </div>
            <div class="form-group">
                <label for="">your image<br>
                    <input type="file" name="image" accept="image/*" required class="form-input"
                        placeholder="enter your image">
                </label>
            </div>
            <div class="form-group">
                <button class="form-button btn" name="submit" type="submit">SignUp Now</button>
            </div>
            <div class="form-footer">
                already have an account? <a href="signin.php">SignIn now</a>
            </div>
        </form>
    </div>
</body>

</html>