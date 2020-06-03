<?php

session_start();

$ready = false;

for ($i = 0; $i < $_SESSION['xDifferent']; $i++) {
    if ($_GET['id'] == $_SESSION['id' . $i]) {
        $_SESSION['number'.$i]++;
        $ready = true;
        break;
    }
}
if(!$ready){
    $_SESSION['id' . $_SESSION['xDifferent']] = $_GET['id'];
    $_SESSION['number'. $_SESSION['xDifferent']] = 1;
    $_SESSION['xDifferent']++;
}
$_SESSION['x']++;

header('Location: ../product.php?id=' . $_GET['id']);