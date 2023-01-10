<?php use Core\Helpers\Helper;?>
<h1 class="d-flex justify-content-around">HTU Store </h1>

    <div class="row my-5">
            <div class="htu-card-wrapper mb-5 col-12 col-md-6 col-lg-4 col-xl-3">
                <div class="card w-100">
                    <div class="card-body">
                        <h5 class="card-title text-center">
                            Total Items: <?= $data->items_count?>
                        </h5>
                        <div class="d-flex justify-content-center align-items-center">
                        </div>
                    </div>
                </div>
            </div>
            <div class="htu-card-wrapper mb-5 col-12 col-md-6 col-lg-4 col-xl-3">
                <div class="card w-100">
                    <div class="card-body">
                        <h5 class="card-title text-center">
                            Total users: <?= $data->users_count?>
                        </h5>
                        <div class="d-flex justify-content-center align-items-center">
                        </div>
                    </div>
                </div>
            </div>
            <div class="htu-card-wrapper mb-5 col-12 col-md-6 col-lg-4 col-xl-3">
                <div class="card w-100">
                    <div class="card-body">
                        <h5 class="card-title text-center">
                            Total Transactions: <?= $data->transaction_count?>
                        </h5>
                        <div class="d-flex justify-content-center align-items-center">
                        </div>
                    </div>
                </div>
            </div>
            <div class="htu-card-wrapper mb-5 col-12 col-md-6 col-lg-4 col-xl-3">
                <div class="card w-100">
                    <div class="card-body">
                        <h5 class="card-title text-center">
                            Total Sales: <?= $data->transaction_count?>
                        </h5>
                        <div class="d-flex justify-content-center align-items-center">
                        </div>
                    </div>
                </div>
            </div>
    </div>
<h1 class="d-flex justify-content-around mb-5">Top Five Expensive Items</h1>
<div class="row">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Item Name</th>
                <th scope="col">Price</th>
                <th scope="col">Available Quantity</th>
                <th scope="col">Item Cost</th>
                <?php if (Helper::check_permission(['Admin','Procurement'])) :?>
                <th scope="col">Action</th>
                <?php endif;?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data->items as $item) : ?>
                <tr>
                    <td><?= $item->item_name ?></td>
                    <td><?= $item->selling_price ?></td>
                    <td><?= $item->stock ?></td>
                    <td><?= $item->cost ?></td>
                    <?php if (Helper::check_permission(['Admin','Procurement'])) :?>
                    <td><a href="./item?id=<?= $item->id ?>" class="btn btn-primary">Check Item</a></td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>

</div>