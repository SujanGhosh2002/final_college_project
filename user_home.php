<?php

include 'components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="main">
    
    <?php include 'components/user_header.php'; ?>

    <div class="body">
        <div class="box">
            <span>popular course</span>
        </div>
        <div class="box">
            <div class="profile">
                <?php
                   $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
                   $select_profile->execute([$user_id]);
                   if($select_profile->rowCount() > 0){
                   $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
                ?>
                <img src="uploaded_files/<?= $fetch_profile['image']; ?>" width="40" height="40" alt="img">
                <h3><?= $fetch_profile['name']; ?></h3>
                <span>student</span>
                <a href="#">profile</a>
            </div>  
                 <?php
                  }
                ?>
        </div>
        <div class="box">
            <p>last watched</p>
            <video width="640" height="360" controls>
                <source src="your_video.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            <ul >
                <li><a href="#">like</a></li>
                <li><a href="#">comment</a></li>
               
            </ul>  
        </div>
        <div class="box">
            <p>best tutor</p>
            <ul>
                <li>
                    <img src="" alt="img">
                    <span>name1</span>
                </li>
                <li>
                    <img src="" alt="img">
                    <span>name1</span>
                </li>
                <li>
                    <img src="" alt="img">
                    <span>name1</span>
                </li>
            </ul>
        </div>
    </div>
</div>
                  
<?php include 'components/footer.php'; ?>
</body>
</html>