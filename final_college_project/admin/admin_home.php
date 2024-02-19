<?php

include '../components/connect.php';

if (isset($_COOKIE['tutor_id'])) {
    $tutor_id = $_COOKIE['tutor_id'];
} else {
    $tutor_id = '';
    header('location:login.php');
}


$select_contents = $conn->prepare("SELECT * FROM `content` WHERE tutor_id = ?");
$select_contents->execute([$tutor_id]);
$total_contents = $select_contents->rowCount();

$select_playlists = $conn->prepare("SELECT * FROM `playlist` WHERE tutor_id = ?");
$select_playlists->execute([$tutor_id]);
$total_playlists = $select_playlists->rowCount();

$select_likes = $conn->prepare("SELECT * FROM `likes` WHERE tutor_id = ?");
$select_likes->execute([$tutor_id]);
$total_likes = $select_likes->rowCount();

$select_comments = $conn->prepare("SELECT * FROM `comments` WHERE tutor_id = ?");
$select_comments->execute([$tutor_id]);
$total_comments = $select_comments->rowCount();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Home</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="admin_style.css">
</head>

<body>
    <div class="main">

        <?php include '../components/admin_header.php'; ?>

        <div class="midile-part">

            <?php include '../components/admin_sidebar.php'; ?>

            <div class="midile-right">
                <div class="midile-contaner">
                    <div class="left-box">
                        <div class="left-box-left">

                            <div class="box-top">
                                <img src="../uploaded_files/<?= $fetch_profile['image']; ?>" alt="">
                            </div>
                            <div class="box-bottom">
                                <div class="btn">button1</div>
                                <div class="btn">button2</div>
                            </div>
                        </div>
                        <div class="left-box-right">
                            <address>id:-
                                <?= $fetch_profile['id']; ?>
                            </address>
                            <address>name:-
                                <?= $fetch_profile['name']; ?>
                            </address>
                            <address>profession:-
                                <?= $fetch_profile['profession']; ?>
                            </address>


                            <address>email-
                                <?= $fetch_profile['email']; ?>
                            </address>
                        </div>
                    </div>

                    <div class="right-box">
                        <div class="right-box-row">
                            <div class="right-box-left">
                                <div class="emoji">❤</div>
                                <div class="count">
                                    <h3>
                                        <?= $total_likes ?>
                                    </h3>
                                    <h3>like</h3>
                                </div>
                            </div>
                            <div class="right-box-right">
                                <div class="emoji">⬜</div>
                                <div class="count">
                                    <h3>
                                        <?= $total_playlists ?>
                                    </h3>
                                    <h3>playlist</h3>
                                </div>
                            </div>
                        </div>
                        <div class="right-box-row">
                            <div class="right-box-left">
                                <div class="emoji">▶</div>
                                <div class="count">
                                    <h3>
                                        <?= $total_contents ?>
                                    </h3>
                                    <h3>content</h3>
                                </div>
                            </div>
                            <div class="right-box-right">
                                <div class="emoji">💬</div>
                                <div class="count">
                                    <h3>
                                        <?= $total_comments ?>
                                    </h3>
                                    <h3>comment</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="midile-contaner">
                    <div class="left-box left-bottom-box">
                        <div class="left-bottom-box-top">
                            <div class="top-box-left">
                                <div class="box-top">
                                    <img src="../img/v3.png" alt="">
                                </div>
                                <div class="top-box-bottom">
                                    <h3>playlist</h3>
                                    <a class="btn" href="add_playlist.php">add</a>
                                </div>
                            </div>
                            <div class="top-box-right">
                                <div class="box-top">
                                    <img src="../img/v2.png" alt="">
                                </div>
                                <div class="top-box-bottom">
                                    <h3>video</h3>
                                    <a class="btn" href="add_content.php">add</a>
                                </div>
                            </div>
                        </div>
                        <div class="left-bottom-box-bottom">
                            <div class="bottom-box-top">⬜</div>
                            <div class="bottom-box-bottom">
                                <h3>document</h3>
                                <a class="btn" href="add_document.php">add</a>
                            </div>
                        </div>
                    </div>
                    <div class="right-box right-bottom-box-hight">
                        <div class="right-box-header">
                            <h3 class="btn">comment</h3>
                        </div>
                        <div class="right-box-content">
                            <div class="right-box-row">
                                <div class="right-bottom-box-left">
                                    <img src="../img/dp.png" alt="">
                                </div>
                                <div class="right-bottom-box-right">
                                    <h3>Sujan Ghosh</h3>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                        Reprehenderit quia, aut ratione ipsa modi omnis facere alias iure voluptatem.
                                        Sunt,
                                        dolorum dolores magni Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                                        Quae, id
                                        tempore. Minima reprehenderit voluptatum harum suscipit vero aspernatur eos
                                        nesciunt,
                                        nostrum sequi, sapiente quia impedit ab reiciendis, itaque fugiat ad? rerum
                                        quisquam
                                        architecto labore aliquid veritatis quidem.</p>
                                </div>
                            </div>
                            <div class="right-box-row">
                                <div class="right-bottom-box-left">
                                    <img src="../img/dp.png" alt="">
                                </div>
                                <div class="right-bottom-box-right">
                                    <h3>Sujan Ghosh</h3>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                        Reprehenderit quia, aut ratione ipsa modi omnis facere alias iure voluptatem.
                                        Sunt,
                                        dolorum dolores magni Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                                        Quae, id
                                        tempore. Minima reprehenderit voluptatum harum suscipit vero aspernatur eos
                                        nesciunt,
                                        nostrum sequi, sapiente quia impedit ab reiciendis, itaque fugiat ad? rerum
                                        quisquam
                                        architecto labore aliquid veritatis quidem.</p>
                                </div>
                            </div>
                            <div class="right-box-row">
                                <div class="right-bottom-box-left">
                                    <img src="../img/dp.png" alt="">
                                </div>
                                <div class="right-bottom-box-right">
                                    <h3>Sujan Ghosh</h3>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                        Reprehenderit quia, aut ratione ipsa modi omnis facere alias iure voluptatem.
                                        Sunt,
                                        dolorum dolores magni Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                                        Quae, id
                                        tempore. Minima reprehenderit voluptatum harum suscipit vero aspernatur eos
                                        nesciunt,
                                        nostrum sequi, sapiente quia impedit ab reiciendis, itaque fugiat ad? rerum
                                        quisquam
                                        architecto labore aliquid veritatis quidem.</p>
                                </div>
                            </div>
                            <div class="right-box-row">
                                <div class="right-bottom-box-left">
                                    <img src="../img/dp.png" alt="">
                                </div>
                                <div class="right-bottom-box-right">
                                    <h3>Sujan Ghosh</h3>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                        Reprehenderit quia, aut ratione ipsa modi omnis facere alias iure voluptatem.
                                        Sunt,
                                        dolorum dolores magni Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                                        Quae, id
                                        tempore. Minima reprehenderit voluptatum harum suscipit vero aspernatur eos
                                        nesciunt,
                                        nostrum sequi, sapiente quia impedit ab reiciendis, itaque fugiat ad? rerum
                                        quisquam
                                        architecto labore aliquid veritatis quidem.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer">
            <h4>Footer</h4>
        </footer>
    </div>
    <script src="admin_script.js"></script>
</body>

</html>