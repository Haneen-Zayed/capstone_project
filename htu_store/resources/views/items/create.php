<h1>Create Item</h1>

<div class="container my-5 col-12 col-md-6 col-lg-4 col-xl-3">
<form action="/items/store" method="POST" class="w-100">
    <div class="mb-3">
        <label for="item_name" class="form-label">Item name</label>
        <input type="text" class="form-control" name="item_name" required>
    </div>
    <div class="mb-3">
        <label for="item_cost" class="form-label">Item cost</label>
        <input type="number" step="any" class="form-control" name="cost" required>
    </div>
    <div class="mb-3">
        <label for="selling_price" class="form-label">Selling price</label>
        <input type="number" step="any" class="form-control" name="selling_price" required>
    </div>
    <div class="mb-3">
        <label for="stock" class="form-label">Stock</label>
        <input type="number" class="form-control" name="stock" required>
    </div>
    <button type="submit" class="btn btn-success mt-4">Create</button>
</form>
</div>
