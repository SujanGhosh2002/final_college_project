<?php

include '../components/connect.php';

if(isset($_COOKIE['tutor_id'])){
   $tutor_id = $_COOKIE['tutor_id'];
}else{
   $tutor_id = '';
   header('location:login.php');
}

if(isset($_POST['submit'])){

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

   $pdf = $_FILES['pdf']['name'];
   $pdf = filter_var($pdf, FILTER_SANITIZE_STRING);
   $video_ext = pathinfo($pdf, PATHINFO_EXTENSION);
   $rename_pdf = unique_id().'.'.$video_ext;
   $pdf_tmp_name = $_FILES['pdf']['tmp_name'];
   $pdf_folder = '../uploaded_files/'.$rename_pdf;

   if($thumb_size > 2000000){
      $message[] = 'image size is too large!';
   }else{
      $add_playlist = $conn->prepare("INSERT INTO `document`( tutor_id, playlist_id, title, description, pdf, thumb) VALUES(?,?,?,?,?,?)");
      $add_playlist->execute([$tutor_id, $playlist, $title, $description, $rename_pdf, $rename_thumb]);
      move_uploaded_file($thumb_tmp_name, $thumb_folder);
      move_uploaded_file($pdf_tmp_name, $pdf_folder);
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
                  <p>pdf title <span>*</span></p>
                  <input type="text" name="title" maxlength="100" required placeholder="enter pdf title">
                  <p>pdf description <span>*</span></p>
                  <textarea name="description" required placeholder="write description" maxlength="1000" cols="30"
                     rows="10"></textarea>
                  <p>pdf playlist <span>*</span></p>
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
                  <p>select pdf <span>*</span></p>
                  <input type="file" name="pdf" accept="pdf/*" required>
                  <input type="submit" value="upload pdf" name="submit">
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