<div class="midile-left">
    <div class="left-top">
      <?php
                   $select_profile = $conn->prepare("SELECT * FROM `tutors` WHERE id = ?");
                   $select_profile->execute([$tutor_id]);
                   if($select_profile->rowCount() > 0){
                   $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
        ?>
    </div>
    

    <div class="left-top">
                    <div class="dp"><img src="../uploaded_files/<?= $fetch_profile['image']; ?>" alt="DP"></div>
                    <h2><?= $fetch_profile['name']; ?></h2>
                    <h5><?= $fetch_profile['profession']; ?></h5>
                </div>
                <div class="left-bottom">
                    <a href="#"><i class="ri-home-4-fill"></i>home</a>
                    <a href="#"><i class="ri-team-fill"></i></i>about us</a>
                    <a href="#"><i class="ri-graduation-cap-fill"></i>courses</a>
                    <a href="#"><i class="ri-message-2-fill"></i>teachers</a>
                    <a href="#"><i class="ri-mail-fill"></i>contact us</a>
                </div>    
</div>
<?php
      }
?>   