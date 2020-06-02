<?php

session_start();

$_SESSION['id'.$_SESSION['x']] = $_GET['id'];
$_SESSION['x']++;

header('Location: ../product.php?id='.$_GET['id']);