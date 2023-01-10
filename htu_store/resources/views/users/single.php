
<div class="mt-5 d-flex flex-row-reverse gap-3">
    <a href="/users/edit?id=<?= $data->user->id ?>" class="btn btn-warning">Edit</a>
    <a href="/users/delete?id=<?= $data->user->id ?>" class="btn btn-danger">Delete</a>
    <a href="/users" class="btn btn-success">Back</a>
</div>
    <div>
        <img src="<?= $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] ?>/resources/images/<?=$data->user->photo?>" alt="An image" width="200" height="100">
    </div>
<div class="my-5">
    <h1 class="text-center">
        <?= $data->user->display_name ?>
    </h1>
    <p class="text-center">
        User name: <?= $data->user->user_name ?>
    </p>
    <p class="text-center">
        User role: <?= $data->user->permissions; if (!$data->user->permissions): echo "No role"; ?>
        <?php endif; ?>
    </p>
    <p class="text-center">
        Email: <?= $data->user->email ?>
    </p>
</div>