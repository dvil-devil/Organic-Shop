<h3>All <?= (!empty($category)) ? $category : "Products"  ?> (<?= $total_products ?>)</h3>
<ul class="product_list">
<?php   foreach ($products as $product) { ?>
        <li>
            <a href="products/<?= $product['category'] . '/' . $product['id']; ?>">
                <img src="../assets/images/products/<?= $product['id'] . '/' . $product['pictures'] ?>" alt="#">
                <h3><?= $product['product_name'] ?></h3>
                <ul class="rating">
                    <li></li><li></li><li></li><li></li><li></li>
                </ul>
                <span>36 Rating</span>
                <span class="price">P<?= $product['price']  ?></span>
            </a>
        </li>
<?php  } ?>
</ul>
<ul class="pagination">
    <?php if ($current_page > 1) { ?>
        <li><a class="pages" href="page/<?= $current_page - 1 ?>" data-page="<?= $current_page - 1 ?>">Previous</a></li>
    <?php }
    for ($i = 1; $i <= $total_pages; $i++) { ?>
        <li class="<?= ($i == $current_page) ? 'active' : "" ?>"><a class="pages" href="page/<?= $i ?>" data-page="<?= $i ?>"><?= $i ?></a></li>
    <?php  }
    if ($current_page < $total_pages) { ?>
        <li><a class="pages" href="page/<?= $current_page + 1 ?>" data-page="<?= $current_page + 1 ?>">Next</a></li>
    <?php } ?>
</ul>