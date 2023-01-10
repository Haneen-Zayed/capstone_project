<?php

use Core\Helpers\Helper;
?>
<div class="mt-5 d-flex flex-row-reverse gap-3">
    <?php  if (Helper::check_permission(['Admin','Accountant','Seller'])) : ?>
        <a href="/transactions/edit?id=<?= $data->transaction->id ?>" class="btn btn-warning">Edit</a>
    <?php  endif;
         if (Helper::check_permission(['Admin','Accountant','Seller'])) :
    ?>
        <a href="/transactions/delete?id=<?= $data->transaction->id ?>" class="btn btn-danger">Delete</a>
    <?php endif; 
    if (Helper::check_permission(['Admin','Accountant'])) :?>
    <a href="/transactions" class="btn btn-success">Back</a>
    <?php endif;
    if (Helper::check_permission(['Seller'])) :?>
        <a href="/transactions/create" class="btn btn-success">Back</a>
        <?php endif;?>
</div>

<div class="my-5">

    <h1 class="text-center">
        <?= $data->transaction->item_name ?>
    </h1>

    <p class="text-center">
        quantity: <?= $data->transaction->item_quantity ?>
    </p>
    <p class="text-center">
        Price: <?= $data->transaction->item_price ?>
    </p>
    <p class="text-center">
        Total Price: <?= $data->transaction->total_price ?>
    </p>
    <p class="text-center">
        created_at: <?= $data->transaction->created_at ?>
    </p>
    <p class="text-center">
        updated_at: <?= $data->transaction->updated_at ?>
    </p>
</div>