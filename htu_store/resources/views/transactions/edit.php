<h1>Update Transaction</h1>
<div class="container my-5 col-12 col-md-6 col-lg-4 col-xl-3">
<form action="/transactions/update" method="POST" class="w-100">
    <input type="hidden" name="id" value="<?= $data->transaction->id ?>" required>
    <div class="mb-3">
        <label for="transaction_name" class="form-label">Item name: <?= $data->transaction->item_name?></label>
        <input type="hidden" class="form-control" name="item_name" value="<?= $data->transaction->item_name?>">
    </div>
    <div class="mb-3">
        <label for="selling_price" class="form-label">Total price: <?= $data->transaction->total_price?></label>
        <input type="hidden" step="any" class="form-control" name="total_price" value="<?= $data->transaction->total_price?>" >
    </div>
    <div class="mb-3">
        <label for="selling_price" class="form-label">Selling price: <?= $data->transaction->item_price?></label>
        <input type="hidden" step="any" class="form-control" name="item_price" value="<?= $data->transaction->item_price?>" >
    </div>
    <div class="mb-3">
        <label for="stock" class="form-label">Quantity</label>
        <input type="number" class="form-control" name="item_quantity" value="<?= $data->transaction->item_quantity?>" min="1" >
    </div>
    <button type="submit" class="btn btn-success mt-4">Update</button>
</form>
</div>
