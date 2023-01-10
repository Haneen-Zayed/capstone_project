
<?php

session_start();
header('Access-Control-Allow-Origin: *'); 
use Core\Model\User;
use Core\Router;

spl_autoload_register(function ($class_name) {
    if (strpos($class_name, 'Core') === false)
        return;
    $class_name = str_replace("\\", '/', $class_name); // \\ = \
    $file_path = __DIR__ . "/" . $class_name . ".php";
    require_once $file_path;
    
});

if (isset($_COOKIE['user_id']) && !isset($_SESSION['user'])) { // check if there is user_id cookie.
    // log in the user automatically
    $user = new User(); // get the user model
    $logged_in_user = $user->get_by_id($_COOKIE['user_id']); // get the user by id
    $_SESSION['user'] = array( // set up the user session that idecates that the user is logged in. 
        'username' => $logged_in_user->user_name,
        'display_name' => $logged_in_user->display_name,
        'user_id' => $logged_in_user->id,
        'is_admin_view' => true
    );
}


Router::get('/', 'front.index'); // Display home.php "welcome page"

//============= Routers For Admin ===================
// athenticated + role ['Admin']
Router::get('/users', "users.index"); // list of users (HTML)
//role ['Admin','Accountant','Seller','Procurement']
Router::get('/user', "users.single"); // Displays single user (HTML)
// athenticated + role ['Admin']
Router::get('/users/create', "users.create"); // Display the creation form (HTML)
Router::post('/users/store', "users.store"); // Creates the users (PHP)
// athenticated + role ['Admin','Accountant','Seller','Procurement']
Router::get('/users/edit', "users.edit"); // Display the edit form (HTML)
Router::post('/users/update', "users.update"); // Updates the users (PHP)
// athenticated + role ['Admin','Accountant','Seller','Procurement']
Router::get('/users/delete', "users.delete"); // Delete the user (PHP)


//============= Routers For Admin & Procurement ===================
// athenticated + role ['Admin','Procurement']
Router::get('/items', "items.index"); // list of items (HTML)
Router::get('/item', "items.single"); // Displays single item (HTML)
// athenticated + permissions [item:create]
Router::get('/items/create', "items.create"); // Display the creation form (HTML)
Router::post('/items/store', "items.store"); // Creates the items (PHP)
// athenticated + permissions [item:read, item:update]
Router::get('/items/edit', "items.edit"); // Display the edit form (HTML)
Router::post('/items/update', "items.update"); // Updates the items (PHP)
// athenticated + permissions [item:read, item:delete]
Router::get('/items/delete', "items.delete"); // Delete the item (PHP)

//============= Routers For Admin & Accountant ===================
// athenticated + permissions [transaction:read] + role ['Admin','Accountant']
Router::get('/transactions', "transactions.index"); // list of transactions (HTML)
//role ['Admin','Accountant','Seller']
Router::get('/transaction', "transactions.single"); // Displays single transaction (HTML)

//============= Routers For Admin, Accountant===================
// athenticated + permissions [transaction:create] + role ['Admin','Seller']
Router::get('/transactions/create', "transactions.create"); // Display the creation form (HTML)
// athenticated + permissions [transaction:read, transaction:update] + //role ['Admin','Accountant','Seller']
Router::get('/transactions/edit', "transactions.edit"); // Display the edit form (HTML)
Router::post('/transactions/update', "transactions.update"); // Updates the transactions (PHP)
// athenticated + permissions [transaction:read, transaction:delete] + //role ['Admin','Accountant','Seller']
Router::get('/transactions/delete', "transactions.delete"); // Delete the transaction (PHP)

// api requests
// api for get one item
Router::get('/api/item', 'endpoints.item');
// api for create new transaction + role ['Admin','Seller']
Router::post('/api/transaction/create', 'endpoints.create');
// api for decrease the stock available depend on the quantity in transaction
Router::post('/api/transaction/update', 'endpoints.dec_quantity');

// For web administrators
Router::get('/login', "authentication.login"); // Displays the login form
Router::get('/logout', "authentication.logout"); // Logs the user out
Router::post('/authenticate', "authentication.validate"); // Displays the login form

// athenticated
Router::get('/dashboard', "front.index"); // Displays the admin dashboard




Router::redirect();