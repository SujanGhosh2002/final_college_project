<?php

include '../components/connect.php';

if (isset($_COOKIE['tutor_id'])) {
   $tutor_id = $_COOKIE['tutor_id'];
} else {
   $tutor_id = '';
   header('location:login.php');
}

if (isset($_POST['submit'])) {


   $title = $_POST['title'];
   $title = filter_var($title, FILTER_SANITIZE_STRING);
   $description = $_POST['description'];
   $description = filter_var($description, FILTER_SANITIZE_STRING);
   $status = $_POST['status'];
   $status = filter_var($status, FILTER_SANITIZE_STRING);

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $ext = pathinfo($image, PATHINFO_EXTENSION);
   $rename = unique_id() . '.' . $ext;
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = '../uploaded_files/' . $rename;

   $add_playlist = $conn->prepare("INSERT INTO `playlist`( tutor_id, title, description, thumb, status) VALUES(?,?,?,?,?)");
   $add_playlist->execute([$tutor_id, $title, $description, $rename, $status]);

   move_uploaded_file($image_tmp_name, $image_folder);

   $message[] = 'new playlist created!';

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Add Playlist</title>
   <link href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css" rel="stylesheet" />
   <link rel="stylesheet" href="admin_style.css">

</head>

<body>
   <div class="main">

      <?php include '../components/admin_header.php'; ?>

      <div class="midile-part">

         <?php include '../components/admin_sidebar.php'; ?>


         <div class="midile-right colomn">

            <section class="sign-up-in-box">

               <div class="form-header">
                  <h3>Create Playlist</h3>
               </div>

               <form action="" method="post" enctype="multipart/form-data">
                  <p>playlist status <span>*</span></p>
                  <select name="status" required>
                     <option value="" selected disabled>-- select status</option>
                     <option value="active">active</option>
                     <option value="deactive">deactive</option>
                  </select>
                  <p>playlist title <span>*</span></p>
                  <input type="text" name="title" maxlength="100" required placeholder="enter playlist title">
                  <p>playlist description <span>*</span></p>
                  <textarea name="description" required placeholder="write description" maxlength="1000" cols="30"
                     rows="10"></textarea>
                  <p>playlist thumbnail <span>*</span></p>
                  <input type="file" name="image" accept="image/*" required>
                  <input type="submit" value="create playlist" name="submit" class="btn">
               </form>

            </section>
         </div>
      </div>
      <footer class="footer">
         <h4>Footer</h4>
      </footer>
   </div>
</body>

</html>