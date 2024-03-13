<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>

    <script src="<?= base_url('assets/js/vendor/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/vendor/popper.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/vendor/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/vendor/bootstrap-select.min.js') ?>"></script>
    <link rel="stylesheet" href="<?= base_url('assets/css/vendor/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/vendor/bootstrap-select.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/custom/global.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/custom/product_view.css') ?>">
    <script src="<?= base_url('assets/js/global/product_view.js') ?>"></script>
    <script src="<?= base_url('assets/js/global/global.js') ?>"></script>
</head>

<script>
    $(document).ready(function() {
        // $("#add_to_cart").click(function() {
        //     $("<span class='added_to_cart'>Added to cart succesfully!</span>")
        //         .insertAfter(this)
        //         .fadeIn()
        //         .delay(1000)
        //         .fadeOut(function() {
        //             $(this).remove();
        //         });
        //     return false;
        // });
    })
</script>

<body>
    <div class="wrapper">
        <?php
        if ($user) {
            $this->load->view('header/logged_in');
        } else {
            $this->load->view('header/logged_out');
        }
        ?>
        <aside>
            <a href="/dashboard"><img src="<?= base_url('assets/images/organic_shop_logo.svg') ?>" alt="Organic Shop"></a>
            <!-- <ul>
                <li class="active"><a href="#"></a></li>
                <li><a href="#"></a></li>
            </ul> -->
        </aside>
        <section>
            <form action="/products/search_products" method="post" class="search_form">
                <input type="text" name="search" placeholder="Search Products">
            </form>
            <a class="show_cart" href="/cart"></a>
            <a href="/dashboard">Go Back</a>
            <ul>
                <li>
                    <img src="<?= base_url("assets/images/products/" . $product['id'] . "/" . $product['pictures'] . "") ?>" alt="food">
                    <ul>
                        <li class="active"><button class="show_image"><img src="<?= base_url("assets/images/products/" . $product['id'] . "/" . $product['pictures'] . "") ?>" alt="food"></button></li>
                        <li><button class="show_image"><img src="<?= base_url("assets/images/products/" . $product['id'] . "/" . $product['pictures'] . "") ?>" alt="food"></button></li>
                        <li><button class="show_image"><img src="<?= base_url("assets/images/products/" . $product['id'] . "/" . $product['pictures'] . "") ?>" alt="food"></button></li>
                        <li><button class="show_image"><img src="<?= base_url("assets/images/products/" . $product['id'] . "/" . $product['pictures'] . "") ?>" alt="food"></button></li>
                    </ul>
                </li>
                <li>
                    <h2><?= $product['product_name'] ?></h2>
                    <ul class="rating">
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                    </ul>
                    <span>36 Rating</span>
                    <span class="amount">P <?= $product['price'] ?></span>
                    <p><?= $product['description'] ?></p>
                    <form action="/carts/add_to_cart" method="post" id="add_to_cart_form">
                        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                        <ul>
                            <li>
                                <label>Quantity</label>
                                <input name="quantity" type="text" min-value="1" value="1">
                                <ul>
                                    <li><button type="button" class="increase_decrease_quantity" data-quantity-ctrl="1"></button></li>
                                    <li><button type="button" class="increase_decrease_quantity" data-quantity-ctrl="0"></button></li>
                                </ul>
                            </li>
                            <li>
                                <label>Total Amount</label>
                                <span class="total_amount">P <?= $product['price'] ?></span>
                            </li>
                            <li><button type="submit" id="add_to_cart">Add to Cart</button></li>
                        </ul>
                    </form>
                </li>
            </ul>
            <section>
                <h3>Similar Items</h3>
                <ul>
                    <?php foreach ($similar_products as $product) { ?>
                        <li>
                            <a href="/products/<?= $product['category'] . '/' . $product['id']; ?>">
                                <img src="<?= base_url("assets/images/products/" . $product['id'] . "/" . $product['pictures'] . "") ?>" alt="#">
                                <h3><?= $product['product_name'] ?></h3>
                                <ul class="rating">
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                </ul>
                                <span>36 Rating</span>
                                <span class="price"><?= $product['price'] ?></span>
                            </a>
                        </li>
                    <?php           } ?>
                </ul>
            </section>
        </section>
        <div class="modal" id="success_modal" tabindex="-1" role="dialog">
            <div class="modal_dialog">
                <div class="modal-content">
                    <div class="modal-body">
                    <h3>Success</h3>
                    <p>Added to the cart successfully.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>