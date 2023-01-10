
<?php

use Core\Helpers\Helper;
?>
<div class="mt-5 d-flex flex-row-reverse gap-3">
    <?php if (Helper::check_permission(['Admin','Procurement'])) : ?>
        <a href="/items/edit?id=<?= $data->item->id ?>" class="btn btn-warning">Edit</a>
    <?php  endif;
    if (Helper::check_permission(['Admin','Procurement'])) :
    ?>
        <a href="/items/delete?id=<?= $data->item->id ?>" class="btn btn-danger">Delete</a>
    <?php endif;
    if (Helper::check_permission(['Admin','Procurement'])) :
     ?>
    <a href="/items" class="btn btn-success">Back</a>
    <?php endif;?>
</div>

<div class="my-5">

    <h1 class="text-center">
        <?= $data->item->item_name ?>
    </h1>

    <p class="text-center">
        stock: <?= $data->item->stock ?>
    </p>
    <p class="text-center">
        Price: <?= $data->item->selling_price ?>
    </p>
    <p class="text-center">
        cost: <?= $data->item->cost ?>
    </p>
    <p class="text-center">
        created_at: <?= $data->item->created_at ?>
    </p>
    <p class="text-center">
        updated_at: <?= $data->item->updated_at ?>
    </p>
</div>