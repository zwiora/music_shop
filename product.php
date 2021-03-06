<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ad libitum</title>
    <link rel="stylesheet" href="style/main.css">
</head>
<body>

<?php

require_once "elements/header.php";
require_once "script/connect.php";

$connection = new mysqli($host, $dbUser, $dbPassword, $dbName);

if (!$connection) {
    echo "Blad: " . mysqli_connect_error();
} else {
$sql = "SELECT * FROM `products` INNER JOIN instruments ON instruments.Instrument_id = products.Instrument INNER JOIN difficulty ON difficulty.Difficulty_id = products.Difficulty WHERE products.Id = " . $_GET["id"];
if ($result = $connection->query($sql)) {
$row = $result->fetch_assoc();

?>

<main class="product">
    <section class="basic_info">
        <header>
            <h1><?= $row['Title'] ?></h1>
            <p>by <?= $row['Composer'] ?></p>
        </header>
        <main>
            <figure>
                <img src="img/product/<?= $row['Image'] ?>" alt="scores">
            </figure>
            <article class="product_info ">
                <h2 class="p3"><?= $row['Price'] ?> zł</h2>
                <?php
                echo "<a href=\"script/addToBasket.php?id=" . $row['Id'] . " \">Add to basket</a>";
                ?>
                <ul>
                    <li class="li1"><?= $row['Instruments_name'] ?></li>
                    <li class="li1"><?= $row['Difficulty_name'] ?></li>
                    <li><?= $row['Details'] ?></li>
                </ul>
            </article>
        </main>
    </section>
    <section class="similar">
        <h2>Similar products</h2>
        <article>
            <?php
            $result->close();
            }

            $sql = "SELECT * FROM `products` INNER JOIN instruments ON instruments.Instrument_id = products.Instrument INNER JOIN difficulty ON difficulty.Difficulty_id = products.Difficulty ORDER BY `Id` ASC";
            if ($result = $connection->query($sql)) {

                $i = 0;

                while ($i < 4) {
                    $row = $result->fetch_assoc();
                    echo "<a href=\"product.php?id=" . $row['Id'] . "\" class=\"card-small\">
    <figure><img src=img/product_preview/" . $row['Image'] . " alt=\"scores\">
        <figcaption>
            <h3>" . $row['Title'] . "</h3>
            <h4>by " . $row['Composer'] . "</h4>
            <h4>" . $row['Instruments_name'] . " - " . $row['Difficulty_name'] . "</h4>
            <p>" . $row['Price'] . " zł</p>
        </figcaption>
    </figure>
</a>";
                    $i++;
                }
            }
            $result->close();
            }
            ?>
        </article>
    </section>
</main>

<?php

require_once "elements/footer.php";

?>

<script src="https://kit.fontawesome.com/d189ad460d.js" crossorigin="anonymous"></script>
</body>
</html>

