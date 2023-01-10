<h1 class="d-flex justify-content-around">Transactions management</h1>
<div id="dataTableContainer">
        <table class="table table-hover">
            <h3>Transaction List (<?= $data->transactions_count ?>)</h3>
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
                <td><?=$counter++?></td>
                <td><?=$transaction->item_name?></td>
                <td><?=$transaction->item_quantity?></td>
                <td><?=$transaction->item_price?></td>
                <td><?=$transaction->total_price?></td>
                <td><a href="/transactions/delete?id=<?=$transaction->id ?>"
                 class="btn btn-danger">Delete</a>
                 <a href="/transactions/edit?id=<?= $transaction->id ?>"
                  class="btn btn-warning">Edit</a>
                  <a href="/transaction?id=<?= $transaction->id ?>" class="btn btn-primary">Show</a></td>
              </tr>
            <?php endforeach; ?>
            </tbody>
        </table>


    </div>
