<h1 class="d-flex justify-content-around">Stock management </h1>

    <div class="row my-5">
        <h3>Items count(<?= $data->items_count ?>)</h3>
        <hr>
        <?php foreach ($data->items as $item) : ?>
            <div class="htu-card-wrapper mb-5 col-12 col-md-6 col-lg-4 col-xl-3">
                <div class="card w-100">
                    <div class="card-body">
                        <h5 class="card-title text-center">
                            <?= $item->item_name?>
                        </h5>
                        <div>
                            <p>Cost: <?= $item->cost?> (JD)</p>
                            <p>Price: <?= $item->selling_price?> (JD)</p>
                            <p>Stock: <?= $item->stock?></p>
                            <p>Created_at: <?= $item->created_at?></p>
                            <p>Updated_at: <?= $item->updated_at?></p>
                        </div>
                        <div class="d-flex justify-content-center align-items-center">
                            <a href="/item?id=<?= $item->id ?>" class="btn btn-primary">Show Item</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>