<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elearning</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="style.css">
</head>

<body>
<?php

include 'components/connect.php';
?>
    <div class="main">
        <a class="arrow" href="#top">
            <img id="icon2" src="img/top-black.png" alt="top">
        </a>
        <nav id="top" class="navbar">
            <div class="left-nav">
                <i class="ri-book-open-fill"></i>
                <h1>edu</h1>
            </div>
            <ul class="center-nav">
                <li><a href="#">Home</a></li>
                <li><a href="#">About</a></li>
                <li class="dropdown">
                    <a href="#" class="dropbtn">study material</a>
                    <div class="dropdown-content">
                        <a href="#">Service 1</a>
                        <a href="#">Service 2</a>
                        <a href="#">Service 3</a>
         <?php
         $select_playlists = $conn->prepare("SELECT * FROM `playlist`");
         $select_playlists->execute();
         if($select_playlists->rowCount() > 0){
            while($fetch_playlist = $select_playlists->fetch(PDO::FETCH_ASSOC)){
         ?>
         <a href="#"><?= $fetch_playlist['title']; ?></a>
         
         <?php
            }
         ?>
         <?php
         }else{
            echo '<option value="" disabled>no playlist created yet!</option>';
         }
         ?>
                    </div>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropbtn">catagories</a>
                    <div class="dropdown-content">
                        <a href="#">Service 1</a>
                        <a href="#">Service 2</a>
                        <a href="#">Service 3</a>
                    </div>
                </li>
                <li><a href="#">Contact</a></li>
            </ul>
            <div class="right-nav">
                <button class="btn" onclick="redirectToSignUpPage()">Sign Up</button>
                <button class="btn" onclick="redirectToSignInPage()">Sign In</button>
                <img id="icon" src="img/moon.png" alt="light theme icon" />
            </div>
        </nav>
        <div class="midile-part">
            <div class="contenar1">
                <div class="box">
                    <h2>enjoy over 100 <br> courses free</h2>
                    <a class="btn" href="#">YES, I Want</a>
                </div>
            </div>
            <div class="contenar2">
                <h3 class="c2top btn">Popular Categories</h3>
                <div class="box2">
                    <h2>enjoy over 100 <br> courses free</h2>
                    <a class="btn" href="#">YES, I Want</a>
                </div>
                <div class="box2">
                    <h2>enjoy over 100 <br> courses free</h2>
                    <a class="btn" href="#">YES, I Want</a>
                </div>
                <h3 class="c2bottom btn">Popular Categories</h3>
            </div>
            <div class="contenar3">
                <h3 class="c3top btn">Popular Categories</h3>
                <div class="grid-container">
                    <div class="grid-item">
                        <i class="ri-pencil-fill"></i>
                        <h3>design</h3>
                        <p>Lorem ipsum dolor sit amet <br> consectetur adipisicing elit. Eveniet,<br> ullam!</p>
                        <a class="btn" href="#">explore</a>
                    </div>
                    <div class="grid-item">
                        <i class="ri-code-s-slash-fill"></i>
                        <h3>devlopment</h3>
                        <p>Lorem ipsum dolor sit amet <br> consectetur adipisicing elit. Eveniet,<br> ullam!</p>
                        <a class="btn" href="#">explore</a>
                    </div>
                    <div class="grid-item">
                        <i class="ri-line-chart-fill"></i>
                        <h3>marketing</h3>
                        <p>Lorem ipsum dolor sit amet <br> consectetur adipisicing elit. Eveniet,<br> ullam!</p>
                        <a class="btn" href="#">explore</a>
                    </div>
                    <div class="grid-item">
                        <i class="ri-settings-4-fill"></i>
                        <h3>software</h3>
                        <p>Lorem ipsum dolor sit amet <br> consectetur adipisicing elit. Eveniet,<br> ullam!</p>
                        <a class="btn" href="#">explore</a>
                    </div>
                    <div class="grid-item">
                        <i class="ri-bar-chart-2-fill"></i></i>
                        <h3>business</h3>
                        <p>Lorem ipsum dolor sit amet <br> consectetur adipisicing elit. Eveniet,<br> ullam!</p>
                        <a class="btn" href="#">explore</a>
                    </div>
                    <div class="grid-item">
                        <i class="ri-music-2-fill"></i></i>
                        <h3>music</h3>
                        <p>Lorem ipsum dolor sit amet <br> consectetur adipisicing elit. Eveniet,<br> ullam!</p>
                        <a class="btn" href="#">explore</a>
                    </div>
                </div>
            </div>
            <div class="contenar4">
                <h3 class="c3top btn">teachers</h3>
                <div class="grid-container">
                   
                    
                    <?php
                        $select_profile = $conn->prepare("SELECT image,name,profession FROM `tutors`");
                        $select_profile->execute();
                         if($select_profile->rowCount() > 0){
                        while($fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC)){
                     ?>
                      <div class="grid-item">
                        <div class="dp"><img src="uploaded_files/<?= $fetch_profile['image']; ?>" alt="DP"></div>
                        <h2><?= $fetch_profile['name']; ?></h2>
                        <p>Yo, i'm <?= $fetch_profile['name']; ?>. I'm a <?= $fetch_profile['profession']; ?> in Midnapur College.</p>
                        <a href="#">read more</a>
                      </div>
                    <?php
                           }
                    ?>
                    <?php
                     }
                     ?>
                       
                    
                </div>
            </div>
        </div>
        <footer class="footer">
            <h4>Footer</h4>
        </footer>
        <script src="script.js"></script>
</body>


</html>