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

$fullPrice = 0;

if (!$connection) {
    echo "Blad: " . mysqli_connect_error();
} else {
    ?>

    <main class="basket">
        <h1>Your list</h1>
        <section class="basket_list">
            <?php

            for ($i = 0; $i < $_SESSION['xDifferent']; $i++) {

                $sql = "SELECT * FROM `products` INNER JOIN instruments ON instruments.Instrument_id = products.Instrument INNER JOIN difficulty ON difficulty.Difficulty_id = products.Difficulty WHERE products.Id = " . $_SESSION['id' . $i];

                if ($result = $connection->query($sql)) {
                    $row = $result->fetch_assoc();

                    $fullPrice += $row['Price'] * $_SESSION['number' . $i];
                    ?>
                    <article>
                        <figure>
                            <?php
                            echo "<img src=\"img/product/" . $row['Image'] . "\" alt=\"scores\">"
                            ?>
                        </figure>
                        <main>
                            <h2><?= $row['Title'] ?></h2>
                            <h4>by <?= $row['Composer'] ?></h4>
                            <h4><?= $row['Instruments_name'] ?> - <?= $row['Difficulty_name'] ?></h4>
                            <h3><?= $row['Price'] ?> zł</h3>
                        </main>
                        <aside>
                            <p class="products_count"><?= $_SESSION['number' . $i] ?></p>
                            <h2><?= $row['Price'] * $_SESSION['number' . $i] ?> zł</h2>
                        </aside>
                    </article>
                    <?php
                }
            }
            ?>
        </section>
        <section class="all">
            <main>
                <h2><?= $_SESSION['x'] ?> products</h2>
                <h1><?= $fullPrice ?> zł</h1>
                <input type="submit" class="buy" value="Buy">
            </main>
        </section>
        <section class="similar">
            <h2>You may also like</h2>
            <article>
                <?php

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

                ?>
            </article>
        </section>
    </main>

    <?php
}

require_once "elements/footer.php";

?>

<script src="https://kit.fontawesome.com/d189ad460d.js" crossorigin="anonymous"></script>
</body>
</html>



