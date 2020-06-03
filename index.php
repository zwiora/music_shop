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
    $sql = "SELECT * FROM `products` INNER JOIN instruments ON instruments.Instrument_id = products.Instrument INNER JOIN difficulty ON difficulty.Difficulty_id = products.Difficulty ORDER BY `Id` ASC";
    if ($result = $connection->query($sql)) {
        $i = 0;
        ?>

        <main class="index">
            <figure>
                <a href="discover.php?instr=0&dif=0">Discover</a>
            </figure>
            <section class="most_popular">
                <h2>Most popular</h2>
                <article>
                    <?php

                    while ($i < 3) {
                        $row = $result->fetch_assoc();
                        echo "<a href=\"product.php?id=" . $row['Id'] . "\" class=\"card\">
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
                    ?>
                </article>
            </section>
            <section class="our_favourite">
                <h2>Our favourite</h2>
                <article>
                    <?php

                    while ($i < 6) {
                        $row = $result->fetch_assoc();
                        echo "<a href=\"product.php?id=" . $row['Id'] . "\" class=\"card\">
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
                    ?>
                </article>
            </section>
            <section class="new_sheets">
                <h2>New sheets </h2>
                <article>
                    <?php

                    while ($i < 9) {
                        $row = $result->fetch_assoc();
                        echo "<a href=\"product.php?id=" . $row['Id'] . "\" class=\"card\">
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
                    ?>
                </article>
            </section>
        </main>

        <?php
    }
    $result->close();
}
require_once "elements/footer.php";

?>

<script src="https://kit.fontawesome.com/d189ad460d.js" crossorigin="anonymous"></script>
</body>
</html>
