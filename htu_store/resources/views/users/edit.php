<?php
use Core\Helpers\Helper;
?>
<h1>Edit User</h1>
<div>
<img src="<?= $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] ?>/resources/images/<?=$data->user->photo?>" alt="An image" width="200" height="100">
</div>
<?php if (Helper::check_permission(['Admin'])) :?>
<!-- For admin -->
<form action="/users/update" method="POST" enctype="multipart/form-data" class="w-50">
    <input type="hidden" name="id" value="<?= $data->user->id ?>" required>
    <div class="mb-3">
        <label for="display-name" class="form-label">Display Name</label>
        <input type="text" class="form-control" id="display-name" name="display_name" value="<?= $data->user->display_name ?>" required>
    </div>
    <div class="mb-3">
        <label for="user-email" class="form-label">Email</label>
        <input type="email" class="form-control" id="user-email" name="email" value="<?= $data->user->email ?>" required>
    </div>
    <div class="mb-3">
        <label for="user-username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username-email" name="user_name" value="<?= $data->user->user_name ?>" required>
    </div>
    <div class="mb-3">
        <label for="user-password" class="form-label">Password</label>
        <input type="password" class="form-control" id="user-password" name="password" required>
    </div>
    <div class="mb-3">
        <label for="user-password" class="form-label">Photo</label>
        <input type="file" name="fileToUpload" id="fileToUpload" value="<?= $data->user->photo ?>">
    </div>
    <div class="mb-3">
        <label for="user-role" class="form-label">Role</label>
        <select class="form-select" aria-label="Role" name="role">
        <option value="<?= $data->user->permissions?>"></option> 
            <option value="Admin">Admin</option> 
            <option value="Accountant">Accountant</option>
            <option value="Seller">Seller</option>
            <option value="Procurement">Procurement</option>
        </select>
    </div>
    <button type="submit" class="btn btn-warning mt-4">Update</button>
    <a href="/user?id=<?= $data->user->id ?>" class="btn btn-danger ms-3 mt-4">Cancel</a>
</form>
<?php endif; ?>

<?php if (Helper::check_permission(['Accountant','Seller','Procurement'])) :?>
<!-- For users -->
<form action="/users/update" method="POST" enctype="multipart/form-data" class="w-50">
    <input type="hidden" name="id" value="<?= $data->user->id ?>" required>
    <div class="mb-3">
        <label for="display-name" class="form-label">Display Name</label>
        <input type="text" class="form-control" id="display-name" name="display_name" value="<?= $data->user->display_name ?>" required>
    </div>
    <div class="mb-3">
        <label for="user-email" class="form-label">Email</label>
        <input type="email" class="form-control" id="user-email" name="email" value="<?= $data->user->email ?>" required>
    </div>
    <div class="mb-3">
        <label for="user-username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username-email" name="user_name" value="<?= $data->user->user_name ?>" required>
    </div>
    <div class="mb-3">
        <label for="user-password" class="form-label">Password</label>
        <input type="password" class="form-control" id="user-password" name="password" required>
    </div>
    <div class="mb-3">
        <label for="user-password" class="form-label">Photo</label>
        <input type="file" name="fileToUpload" id="fileToUpload" value="<?= $data->user->photo ?>">
    </div>
    <div>
    <input type="hidden" name="role" id="user-role" value="<?= $data->user->permissions ?>">
    </div>
    <button type="submit" class="btn btn-warning mt-4">Update</button>
    <a href="/user?id=<?= $data->user->id ?>" class="btn btn-danger ms-3 mt-4">Cancel</a>
</form>
<?php endif; ?>