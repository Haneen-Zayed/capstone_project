
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HTU Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] ?>/resources/css/styles.css">
</head>

<body id="my-element" class="container my-5">
    <div class="d-flex justify-content-between">
        <h1>Selling dashboard</h1>     
        <div>
            <strong>Total Sales</strong>
            <span id="total-sales"><?=$data->transactions_count?></span>
        </div>
    </div>
    <hr>
    <form id="userInputContainer" class="my-4 d-flex justify-content-between">
        <div class="input-group flex-nowrap">
            <span class="input-group-text" id="addon-wrapping">Items</span>
            <select id="items" class="form-select" aria-label="Default select example" required>
                <option selected></option>
                <?php foreach ($data->items as $item) : ?>
                    <option value="<?= $item->id?>"><?= $item->item_name?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="input-group flex-nowrap">
            <span class="input-group-text">Quantity</span>
            <input id="quantity" type="number" class="form-control" aria-describedby="addon-wrapping" min="1" required>
            <input id="user-id" type="hidden" name="user-id" value="<?= $_SESSION['user']['user_id']?>">
        </div>
        <button id="add-item" class="btn btn-success">Add</button>
    </form>
    <hr>
    <div id="dataTableContainer">
        <table class="table table-hover">
            <h5 >Approval of the request</h5>
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Item name</th>
                    <th scope="col">Available Quantity</th>
                    <th scope="col">Price Per Unit</th>
                </tr>
            </thead>
            <tbody id="tbody1">
            </tbody>
        </table>
        <hr>      
    <div id="dataTableContainer">
        <table class="table table-hover">
            <h5 >All transactions</h5>
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Item name</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price Per Unit</th>
                    <th scope="col">Total Price</th>
                    <th scope="col">Edite/ Delete/ Show</th>
                </tr>
            </thead>
        <tbody>
            <?php $counter=1?>   
            <?php foreach ($data->transactions as $transaction) : ?>
                <tr>
                <td data-id="<?=$counter?>"><?=$counter?></td>
                <td><?=$transaction->item_name?></td>
                <td><?=$transaction->item_quantity?></td>
                <td><?=$transaction->item_price?></td>
                <td><?=$transaction->total_price?></td>
                <td>
                    <a data-id="edit<?=$counter?>"
                     href="/transactions/delete?id=<?= $transaction->transaction_id ?>"
                  class="btn btn-danger">Delete</a>
                 <a data-id="edit<?=$counter?>"
                  href="/transactions/edit?id=<?= $transaction->transaction_id ?>"
                  class="btn btn-warning">Edit</a>
                  <a data-id="show<?=$counter?>"
                   href="/transaction?id=<?= $transaction->transaction_id ?>" class="btn btn-primary">Show</a>
                </td>
                <?php $counter++?>
              </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.1.js"
        integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
        crossorigin="anonymous"></script>
        <script src="<?= $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] ?>/resources/js/app.js"></script>
</body>
</html>