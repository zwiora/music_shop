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

?>

<main class="discover">
    <h1>Discover</h1>
    <aside class="filters">
        <h2>Filters</h2>
        <form action="#" method="get">
            <h3>Instrument</h3>
            <label for="instr_pfte"><input type="radio" id="instr_pfte" class="instr" name="instr"
                                           value="pfte">Piano</label>
            <label for="instr_vn"><input type="radio" id="instr_vn" class="instr" name="instr" value="vn">Violin</label>
            <label for="instr_vc"><input type="radio" id="instr_vc" class="instr" name="instr" value="vc">Cello</label>
            <label for="instr_fl"><input type="radio" id="instr_fl" class="instr" name="instr" value="fl">Flute</label>
            <label for="instr_sxf"><input type="radio" id="instr_sxf" class="instr" name="instr"
                                          value="sxf">Saxophone</label>
            <h3>Difficulty level</h3>
            <label for="dif_1"><input type="radio" id="dif_1" class="dif" name="dif" value="1">Begginer</label>
            <label for="dif_2"><input type="radio" id="dif_2" class="dif" name="dif" value="2">Basic</label>
            <label for="dif_3"><input type="radio" id="dif_3" class="dif" name="dif" value="3">Intermediate</label>
            <label for="dif_4"><input type="radio" id="dif_4" class="dif" name="dif" value="4">Advanced</label>
            <label for="dif_5"><input type="radio" id="dif_5" class="dif" name="dif" value="5">Expert</label>
            <input class="submit" type="submit" value="search">
        </form>
    </aside>
    <section class="discover_list">
        <article>
            <?php

            session_start();

            require_once "connect.php";

            $connection = new mysqli($host, $dbUser, $dbPassword, $dbName);

            if (!$connection) {
                echo "Blad: " . mysqli_connect_error();
            } else {
                $sql = "SELECT * FROM `products` INNER JOIN instruments ON instruments.Instrument_id = products.Instrument INNER JOIN difficulty ON difficulty.Difficulty_id = products.Difficulty";
                if ($result = $connection->query($sql)) {

                    while ($row = $result->fetch_assoc()) {
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
                    }

                    /* close result set */
                    $result->close();
                }
            }
            ?>
        </article>
    </section>
</main>

<?php

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


