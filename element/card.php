<a href="product.php" class="card">
    <figure><img src="img/product_preview/we_are_the_world.png" alt="scores">
        <figcaption>
            <h3>We are the world</h3>
            <h4>by Lionel Richie & Michael Jackson</h4>
            <h4>piano - intermediate</h4>
            <p>15,99zł</p>
        </figcaption>
    </figure>
</a>

SELECT * FROM `products` INNER JOIN instruments ON instruments.Instrument_id = products.Instrument INNER JOIN difficulty ON difficulty.Difficulty_id = products.Difficulty