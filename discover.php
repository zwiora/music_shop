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

<main class="discover">
    <h1>Discover</h1>
    <aside class="filters">
        <h2>Filters</h2>
        <form action="#" method="get">
            <h3>Instrument</h3>
            <?php

            echo
            "<label for=\"instr_pfte\"><input type=\"radio\" id=\"instr_pfte\" class=\"instr\" name=\"instr\" 
                                           value=\"1\" ";
            if (@$_GET['instr'] == 1) echo 'checked';
            echo ">Piano</label>
            <label for=\"instr_vn\"><input type=\"radio\" id=\"instr_vn\" class=\"instr\" name=\"instr\" value=\"2\" ";
            if (@$_GET['instr'] == 2) echo 'checked';
            echo ">Violin</label>
            <label for=\"instr_vc\"><input type=\"radio\" id=\"instr_vc\" class=\"instr\" name=\"instr\" value=\"3\" ";
            if (@$_GET['instr'] == 3) echo 'checked';
            echo ">Cello</label>
            <label for=\"instr_fl\"><input type=\"radio\" id=\"instr_fl\" class=\"instr\" name=\"instr\" value=\"4\" ";
            if (@$_GET['instr'] == 4) echo 'checked';
            echo ">Flute</label>
            <label for=\"instr_sxf\"><input type=\"radio\" id=\"instr_sxf\" class=\"instr\" name=\"instr\"
                                          value=\"5\" ";
            if (@$_GET['instr'] == 5) echo 'checked';
            echo ">Saxophone</label>
            <h3>Difficulty level</h3>
            <label for=\"dif_1\"><input type=\"radio\" id=\"dif_1\" class=\"dif\" name=\"dif\" value=\"1\" ";
            if (@$_GET['dif'] == 1) echo 'checked';
            echo ">Begginer</label>
            <label for=\"dif_2\"><input type=\"radio\" id=\"dif_2\" class=\"dif\" name=\"dif\" value=\"2\" ";
            if (@$_GET['dif'] == 2) echo 'checked';
            echo ">Basic</label>
            <label for=\"dif_3\"><input type=\"radio\" id=\"dif_3\" class=\"dif\" name=\"dif\" value=\"3\" ";
            if (@$_GET['dif'] == 3) echo 'checked';
            echo ">Intermediate</label>
            <label for=\"dif_4\"><input type=\"radio\" id=\"dif_4\" class=\"dif\" name=\"dif\" value=\"4\" ";
            if (@$_GET['dif'] == 4) echo 'checked';
            echo ">Advanced</label>
            <label for=\"dif_5\"><input type=\"radio\" id=\"dif_5\" class=\"dif\" name=\"dif\" value=\"5\" ";
            if (@$_GET['dif'] == 5) echo 'checked';
            echo ">Expert</label>
            <input class=\"bttn\" type=\"submit\" value=\"search\">
            <a href='discover.php' class=\"bttn\">clear</a>";
            ?>
        </form>
    </aside>
    <section class="discover_list">
        <article>
            <?php

            require_once "script/connect.php";

            $connection = new mysqli($host, $dbUser, $dbPassword, $dbName);

            if (!$connection) {
                echo "Blad: " . mysqli_connect_error();
            } else {
                $sql = "SELECT * FROM `products` INNER JOIN instruments ON instruments.Instrument_id = products.Instrument INNER JOIN difficulty ON difficulty.Difficulty_id = products.Difficulty";
                if (@$_GET['instr'] != 0) {
                    $sql = $sql . " WHERE products.Instrument = " . $_GET['instr'];

                    if (@$_GET['dif'] != 0) {
                        $sql = $sql . " && products.Difficulty = " . $_GET['dif'];
                    }
                } else if (@$_GET['dif'] != 0) {
                    $sql = $sql . " WHERE products.Difficulty = " . $_GET['dif'];
                }

                if ($result = $connection->query($sql)) {

                    while ($row = $result->fetch_assoc()) {
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
                    }
                    $result->close();
                }
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


