<?php

include '../components/connect.php';

if(isset($_COOKIE['tutor_id'])){
   $tutor_id = $_COOKIE['tutor_id'];
}else{
   $tutor_id = '';
   header('location:login.php');
}

if(isset($_POST['submit'])){

   $status = $_POST['status'];
   $status = filter_var($status, FILTER_SANITIZE_STRING);
   $title = $_POST['title'];
   $title = filter_var($title, FILTER_SANITIZE_STRING);
   $description = $_POST['description'];
   $description = filter_var($description, FILTER_SANITIZE_STRING);
   $playlist = $_POST['playlist'];
   $playlist = filter_var($playlist, FILTER_SANITIZE_STRING);

   $thumb = $_FILES['thumb']['name'];
   $thumb = filter_var($thumb, FILTER_SANITIZE_STRING);
   $thumb_ext = pathinfo($thumb, PATHINFO_EXTENSION);
   $rename_thumb = unique_id().'.'.$thumb_ext;
   $thumb_size = $_FILES['thumb']['size'];
   $thumb_tmp_name = $_FILES['thumb']['tmp_name'];
   $thumb_folder = '../uploaded_files/'.$rename_thumb;

   $video = $_FILES['video']['name'];
   $video = filter_var($video, FILTER_SANITIZE_STRING);
   $video_ext = pathinfo($video, PATHINFO_EXTENSION);
   $rename_video = unique_id().'.'.$video_ext;
   $video_tmp_name = $_FILES['video']['tmp_name'];
   $video_folder = '../uploaded_files/'.$rename_video;

   if($thumb_size > 2000000){
      $message[] = 'image size is too large!';
   }else{
      $add_playlist = $conn->prepare("INSERT INTO `content`( tutor_id, playlist_id, title, description, video, thumb, status) VALUES(?,?,?,?,?,?,?)");
      $add_playlist->execute([$tutor_id, $playlist, $title, $description, $rename_video, $rename_thumb, $status]);
      move_uploaded_file($thumb_tmp_name, $thumb_folder);
      move_uploaded_file($video_tmp_name, $video_folder);
      $message[] = 'new course uploaded!';
   }

   

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Dashboard</title>
   <link href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css" rel="stylesheet" />
   <link rel="stylesheet" href="admin_style.css">
</head>

<body>
   <div class="main">

      <?php include '../components/admin_header.php'; ?>

      <div class="midile-part">

         <?php include '../components/admin_sidebar.php'; ?>


         <div class="midile-right">
            <section>

               <h1>upload content</h1>

               <form action="" method="post" enctype="multipart/form-data">
                  <p>video status <span>*</span></p>
                  <select name="status" required>
                     <option value="" selected disabled>-- select status</option>
                     <option value="active">active</option>
                     <option value="deactive">deactive</option>
                  </select>
                  <p>video title <span>*</span></p>
                  <input type="text" name="title" maxlength="100" required placeholder="enter video title">
                  <p>video description <span>*</span></p>
                  <textarea name="description" required placeholder="write description" maxlength="1000" cols="30"
                     rows="10"></textarea>
                  <p>video playlist <span>*</span></p>
                  <select name="playlist" required>
                     <option value="" disabled selected>--select playlist</option>
                     <?php
                      $select_playlists = $conn->prepare("SELECT * FROM `playlist` WHERE tutor_id = ?");
                       $select_playlists->execute([$tutor_id]);
                      if($select_playlists->rowCount() > 0){
                       while($fetch_playlist = $select_playlists->fetch(PDO::FETCH_ASSOC)){
                     ?>
                     <option value="<?= $fetch_playlist['id']; ?>">
                        <?= $fetch_playlist['title']; ?>
                     </option>
                     <?php
                       }
                     ?>
                     <?php
                       }else{
                     echo '<option value="" disabled>no playlist created yet!</option>';
                     }
                     ?>
                  </select>
                  <p>select thumbnail <span>*</span></p>
                  <input type="file" name="thumb" accept="image/*" required>
                  <p>select video <span>*</span></p>
                  <input type="file" name="video" accept="video/*" required>
                  <input type="submit" value="upload video" name="submit">
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