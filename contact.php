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

?>

<main class="contact">
    <h1>Contact us</h1>
    <section class="most_popular">
        <article>
            <form method="post" action="#">
                <input type="text" placeholder="First name" name="firstName">
                <input type="text" placeholder="Second name" name="secondName">
                <input type="email" placeholder="E-mail" name="email" required>
                <input type="text" placeholder="Topic" name="topic" required>
                <textarea placeholder="Message" required></textarea>
                <input type="submit" value="Submit" class="bttn">
                <input type="reset" value="Reset" class="bttn">
            </form>
        </article>
    </section>
    <section class="similar">
        <h2>Check out our products</h2>
        <article>
            <?php

            require_once "script/connect.php";

            $connection = new mysqli($host, $dbUser, $dbPassword, $dbName);

            if (!$connection) {
                echo "Blad: " . mysqli_connect_error();
            } else {

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
