<?php

include 'components/connect.php';

if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = '';
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="user_home.css">
</head>

<body>
    <div class="main">

        <?php include 'components/user_header.php'; ?>

        <div class="midile-part">

            <?php include 'components/user_sidebar.php'; ?>

            <div class="midile-right">

            </div>
        </div>
        <footer class="footer">
            <h4>Footer</h4>
        </footer>
    </div>

    <?php include 'components/footer.php'; ?>
    <script src="script.js"></script>
</body>

</html>