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

session_start();

require_once "connect.php";

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
                <a href="discover.php">Discover</a>
            </figure>
            <section class="most_popular">
                <h2>Most popular</h2>
                <article>
                    <?php

                    while ($i < 3) {
                        $row = $result->fetch_assoc();
                        echo "<a href=\"product.php?id=".$row['Id']."\" class=\"card\">
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
                        echo "<a href=\"product.php?id=".$row['Id']."\" class=\"card\">
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
                        echo "<a href=\"product.php?id=".$row['Id']."\" class=\"card\">
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

    /* close result set */
    $result->close();

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
