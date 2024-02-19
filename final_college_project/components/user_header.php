<?php
if (isset($message)) {
    foreach ($message as $message) {
        echo '
      <div class="message">
         <span>' . $message . '</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
    }
}
?>

<a class="arrow" href="#top">
    <img id="icon2" src="../img/top-black.png" alt="top">
</a>
<nav id="top" class="navbar">
    <div class="left-nav">
        <i class="ri-book-open-fill"></i>
        <h1>edu</h1>
    </div>
    <div class="center-nav">
        <input type="search" placeholder="search courses...">
        <i class="ri-search-line"></i>
    </div>
    <div class="right-nav">
        <i class="ri-notification-fill"></i>
        <i class="ri-menu-fill"></i>
        <a class="btn" href="components/user_logout.php">logout</a>
        <img id="icon" src="../img/moon.png" alt="light theme icon" />
    </div>
</nav>