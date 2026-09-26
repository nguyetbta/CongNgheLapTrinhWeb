
<?php include '../view/header.php'; ?>

<main>
    <aside>
        <h1>Categories</h1>

        <?php
        include __DIR__ . '/view/categories_nav.php';
        ?>
    </aside>

    <section>
        <h1><?php echo htmlspecialchars($category_name); ?></h1>

        <ul class="nav">
            <!-- Display links for products in selected category -->
            <?php foreach ($products as $product) : ?>
            <li>
                <a href="?action=view_product&amp;product_id=<?php
                    echo $product['productID'];
                ?>">
                    <?php
                    echo htmlspecialchars($product['productName']);
                    ?>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
    </section>
</main>

<?php include '../view/footer.php'; ?>