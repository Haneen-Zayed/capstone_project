<h1>Create User</h1>

<form action="/users/store" method="POST" enctype="multipart/form-data" class="w-50">
    <div class="mb-3">
        <label for="display-name" class="form-label">Display Name</label>
        <input type="text" class="form-control" id="display-name" name="display_name" required>
    </div>
    <div class="mb-3">
        <label for="user-email" class="form-label">Email</label>
        <input type="email" class="form-control" id="user-email" name="email" required>
    </div>
    <div class="mb-3">
        <label for="user-username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username-email" name="user_name" required>
    </div>
    <div class="mb-3">
        <label for="user-password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password-email" name="password" required>
    </div>
    <div class="mb-3">
        <label for="user-password" class="form-label">Photo</label>
        <input type="file" name="fileToUpload" id="fileToUpload">
    </div>
    <div class="mb-3">
        <label for="user-role" class="form-label">Role</label>
        <select class="form-select" aria-label="Role" name="role"> 
            <option value=""></option> 
            <option value="Admin">Admin</option> 
            <option value="Accountant">Accountant</option>
            <option value="Seller">Seller</option>
            <option value="Procurement">Procurement</option>
        </select>
    </div>
    <button type="submit" class="btn btn-success mt-4">Create</button>
    <a href="/users" class="btn btn-danger ms-3 mt-4">Cancel</a>
</form>