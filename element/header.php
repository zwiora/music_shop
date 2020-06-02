<?php
session_start();
if(!isset($_SESSION['x'])){
    $_SESSION['x'] = 0;
}
?>

<header class="header">
    <h1>
        <a href="index.php">Ad libitum</a>
    </h1>
    <nav>
        <a href="index.php">home</a>
        <a href="discover.php?instr=0&dif=0">discover</a>
        <label for="search">
            <input id="search" type="text">
            <button><i class="fas fa-search"></i></button>
        </label>
        <a href="basket.php" class="basket">
            <i class="fas fa-shopping-cart"></i>
            <?= $_SESSION['x'] ?>
        </a>
    </nav>
</header>
