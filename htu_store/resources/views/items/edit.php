<h1>Update Item</h1>

<div class="container my-5 col-12 col-md-6 col-lg-4 col-xl-3">
<form action="/items/update" method="POST" class="w-100">
    <input type="hidden" name="id" value="<?= $data->item->id ?>" required>
    <div class="mb-3">
        <label for="item_name" class="form-label">Item name</label>
        <input type="text" class="form-control" name="item_name" value="<?= $data->item->item_name?>" required>
    </div>
    <div class="mb-3">
        <label for="item_cost" class="form-label">Item cost</label>
        <input type="number" step="any" class="form-control" name="cost" value="<?= $data->item->cost?>" required>
    </div>
    <div class="mb-3">
        <label for="selling_price" class="form-label">Selling price</label>
        <input type="number" step="any" class="form-control" name="selling_price" value="<?= $data->item->selling_price?>" required>
    </div>
    <div class="mb-3">
        <label for="stock" class="form-label">Stock</label>
        <input type="number" class="form-control" name="stock" value="<?= $data->item->stock?>" required>
    </div>
    <button type="submit" class="btn btn-success mt-4">Update</button>
</form>
</div>
