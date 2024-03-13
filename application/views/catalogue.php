<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>

    <link rel="shortcut icon" href="../assets/images/organic_shop_fav.ico" type="image/x-icon">

    <script src="../assets/js/vendor/jquery.min.js"></script>
    <script src="../assets/js/vendor/popper.min.js"></script>
    <script src="../assets/js/vendor/bootstrap.min.js"></script>
    <script src="../assets/js/vendor/bootstrap-select.min.js"></script>
    <link rel="stylesheet" href="../assets/css/vendor/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/vendor/bootstrap-select.min.css">
    <link rel="stylesheet" href="../assets/css/custom/global.css">
    <link rel="stylesheet" href="../assets/css/custom/product_dashboard.css">
    
    <script src="../assets/js/global/dashboard.js"></script>
    <script src="../assets/js/global/global.js"></script>
</head>

<script>
    $(document).ready(function() {
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
            <a href="dashboard"><img src="../assets/images/organic_shop_logo.svg" alt="Organic Shop"></a>
            <!-- <ul>
                <li class="active"><a href="#"></a></li>
            </ul> -->
        </aside>
        <section>
            <form action="/products/search_products" method="post" class="search_form">
                <input type="text" name="search" placeholder="Search Products">
            </form>
            <a class="show_cart" href="/cart"></a>
            <form action="/products/filter_by_category" method="post" class="categories_form">
                <h3>Categories</h3>
                <input type="hidden" name="category">
                <ul>
                    <li>
                        <button type="submit" class="active">
                            <span><?= $total ?></span><img src="../assets/images/organic foods.png" alt="#"><h4>All Products</h4>
                        </button>
                    </li>
<?php           foreach($categories as $category){?>
                    <li>
                        <button type="submit" data-category="<?= $category['category'] ?>">
                            <span><?= $category['count_category'] ?></span><img src="../assets/images/<?= $category['category'] ?>.jpg" alt="#"><h4><?= ucfirst($category['category']) ?></h4>
                        </button>
                    </li>
<?php           }?>
                </ul>
            </form>
            <div class="products_container">
              
            </div>
        </section>
    </div>
<?php   if($this->session->flashdata("success")){?>
        <div class="alert">
            <p class="message_box success"><?= $this->session->flashdata("success")?></p>
        </div>
<?php   }?>
</body>
</html>