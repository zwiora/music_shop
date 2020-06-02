<?php

session_start();

$_SESSION['x']++;

header('Location: ../product.php?id='.$_GET['id']);