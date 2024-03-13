<ul class="image_preview_list">
<?php   for( $i=0; $i<5; $i++ ) { ?>
    <li>
        <img src="<?php $images['name'] ?>">
        <input name="image_index" value=""/>
        <button class="delete_image" data-image-index="<?= $i ?>"></button>
        <label for="main_image">
            <input type="checkbox" name="main_image">
            Mark as main image
        </label>
    </li>
<?php   }?>
</ul>