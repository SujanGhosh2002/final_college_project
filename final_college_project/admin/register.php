<?php

include '../components/connect.php';

if (isset($_POST['submit'])) {


   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $profession = $_POST['profession'];
   $profession = filter_var($profession, FILTER_SANITIZE_STRING);
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
   $image_folder = '../uploaded_files/' . $rename;

   $select_tutor = $conn->prepare("SELECT * FROM `tutors` WHERE email = ?");
   $select_tutor->execute([$email]);

   if ($select_tutor->rowCount() > 0) {
      $message[] = 'email already taken!';
   } else {
      if ($pass != $cpass) {
         $message[] = 'confirm passowrd not matched!';
      } else {
         $insert_tutor = $conn->prepare("INSERT INTO `tutors`(name, profession, email, password, image) VALUES(?,?,?,?,?)");
         $insert_tutor->execute([$name, $profession, $email, $cpass, $rename]);
         move_uploaded_file($image_tmp_name, $image_folder);
         $message[] = 'new tutor registered! please login now';
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="admin_style.css">

</head>

<body style="padding-left: 0;">

   <?php
   if (isset($message)) {
      foreach ($message as $message) {
         echo '
      <div class="message form">
         <span>' . $message . '</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
      }
   }
   ?>

   <!-- register section starts  -->

   <section class="sign-up-in-box">

      <form class="signup-form" action="" method="post" enctype="multipart/form-data">
         <div class="form-header">
            <h3>Create Account</h3>
         </div>
         <div class="flex">
            <div class="form-group form-group-flex">
               <label for="">your name<span>*</span><br>
                  <input type="text" name="name" required class="form-input" maxlength="50"
                     placeholder="eneter your name">
               </label>
               <label for="">your profession<span>*</span><br>
                  <select name="profession" class="form-input" required>
                     <option value="" disabled selected>-- select your profession</option>
                     <option value="developer">developer</option>
                     <option value="desginer">desginer</option>
                     <option value="musician">musician</option>
                     <option value="biologist">biologist</option>
                     <option value="teacher">teacher</option>
                     <option value="engineer">engineer</option>
                     <option value="lawyer">lawyer</option>
                     <option value="accountant">accountant</option>
                     <option value="doctor">doctor</option>
                     <option value="journalist">journalist</option>
                     <option value="photographer">photographer</option>
                     <option value="photographer">other</option>
                  </select>
               </label>
               <label for="">your email<br>
                  <input type="email" name="email" required class="form-input" placeholder="email@example.com">
               </label>

            </div>
            <div class="form-group form-group-flex">
               <label for="">your password<br>
                  <input type="password" name="pass" required class="form-input" maxlength="20"
                     placeholder="email@example.com">
               </label>
               <label for="">confirm password<br>
                  <input type="password" name="cpass" required class="form-input" maxlength="20"
                     placeholder="enter your password">
               </label>
               <label for="">your image<br>
                  <input type="file" name="image" accept="image/*" required class="form-input"
                     placeholder="enter your image">
               </label>
            </div>
         </div>
         <div class="form-group">
            <button class="form-button btn" name="submit" type="submit">SignUp Now</button>
         </div>
         <div class="form-footer">
            already have an account? <a href="login.php">SignIn now</a>
         </div>
         </div>
      </form>

   </section>

   <!-- registe section ends -->












   <script>

      let darkMode = localStorage.getItem('dark-mode');
      let body = document.body;

      const enabelDarkMode = () => {
         body.classList.add('dark');
         localStorage.setItem('dark-mode', 'enabled');
      }

      const disableDarkMode = () => {
         body.classList.remove('dark');
         localStorage.setItem('dark-mode', 'disabled');
      }

      if (darkMode === 'enabled') {
         enabelDarkMode();
      } else {
         disableDarkMode();
      }

   </script>

</body>

</html>