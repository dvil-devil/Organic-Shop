<?php foreach ($cart_items as $product) { ?>
    <li>
        <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
        <img src="../assets/images/products/<?= $product['product_id'] . '/' . $product['pictures'] ?>" alt="#">
        <h3>Vegetable</h3>
        <span class="price"><?= $product['price'] ?></span>
        <ul>
            <li>
                <label>Quantity</label>
                <input name="quantity" type="text" min-value="1" value="<?= $product['quantity'] ?>">
                <ul>
                    <li><button type="button" class="increase_decrease_quantity" data-quantity-ctrl="1"></button></li>
                    <li><button type="button" class="increase_decrease_quantity" data-quantity-ctrl="0"></button></li>
                </ul>
            </li>
            <li>
                <label>Total Amount</label>
                <span id="<?= $product['product_id'] ?>" class="total_amount"><?= $product['price']*$product['quantity']  ?></span>
            </li>
            <li>
                <button type="button" class="remove_item"></button>
            </li>
        </ul>
        <div>
            <p>Are you sure you want to remove this item?</p>
            <button type="button" class="cancel_remove">Cancel</button>
            <button type="button" class="remove">Remove</button>
        </div>
    </li>
<?php } ?>