<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ad libitum</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="style/main.css">
</head>
<body>

<?php

require_once "element/header.php";
require_once "connect.php";

$connection = new mysqli($host, $dbUser, $dbPassword, $dbName);

$fullPrice = 0;

if (!$connection) {
    echo "Blad: " . mysqli_connect_error();
} else {


    ?>

    <main class="basket">
        <h1>Your list</h1>
        <section class="basket_list">
            <?php

            for ($i = 0; $i < $_SESSION['x']; $i++) {

                $sql = "SELECT * FROM `products` INNER JOIN instruments ON instruments.Instrument_id = products.Instrument INNER JOIN difficulty ON difficulty.Difficulty_id = products.Difficulty WHERE products.Id = " . $_SESSION['id' . $i];

                if ($result = $connection->query($sql)) {
                    $row = $result->fetch_assoc();

                    $fullPrice += $row['Price'];
                    ?>
                    <article>
                        <figure>
                            <?php
                            echo "<img src=\"img/product/" .$row['Image']."\" alt=\"scores\">"
                            ?>
                        </figure>
                        <main>
                            <h2><?= $row['Title'] ?></h2>
                            <h4>by <?= $row['Composer'] ?></h4>
                            <h4><?= $row['Instruments_name'] ?> - <?= $row['Difficulty_name'] ?></h4>
                            <h3><?= $row['Price'] ?> zł</h3>
                        </main>
                        <aside>
                            <p class="products_count">1</p>
                            <h2><?= $row['Price'] ?> zł</h2>
                        </aside>
                    </article>
                    <?php
                }
            }
            ?>
        </section>
        <section class="all">
            <main>
                <h2><?=  $_SESSION['x'] ?> products</h2>
                <h1><?=  $fullPrice ?> zł</h1>
                <input type="submit" class="buy" value="Buy">
            </main>
        </section>
        <section class="similar">
            <h2>You may also like</h2>
            <article>
                <?php

                for ($i = 0; $i < 4; $i++) {
                    include "element/card_small.php";
                }

                ?>
            </article>
        </section>
    </main>

    <?php
}

require_once "element/footer.php";

?>

<script src="https://kit.fontawesome.com/d189ad460d.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
</body>
</html>



