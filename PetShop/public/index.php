<?php
// Start the session to manage cart data
session_start();

// Define a constant for the project root directory
define('PROJECT_ROOT', dirname(__DIR__));

// Main router for the Pet Shop Application

// Get the requested page and action, with defaults
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

// Define the path to controllers
$controllerPath = PROJECT_ROOT . '/controller/';

// Map page slugs to controller names
$controllerMap = [
    'home' => 'HomeController',
    'products' => 'ProductController',
    'orders' => 'OrderController',
    'cart' => 'CartController',
    'invoices' => 'InvoiceController',
    'admin' => 'AdminController'
];

// Determine the controller class
$controllerName = isset($controllerMap[$page]) ? $controllerMap[$page] : null;

if ($controllerName && file_exists($controllerPath . $controllerName . '.php')) {
    // Include the controller file
    require_once $controllerPath . $controllerName . '.php';

    // Check if the method exists in the controller
    if (method_exists($controllerName, $action)) {
        // Instantiate the controller and call the action method
        $controller = new $controllerName();
        $controller->$action();
    } else {
        // Action not found error
        include PROJECT_ROOT . '/view/layout/header.php';
        http_response_code(404);
        echo "<h1>404 - Action không tồn tại</h1>";
        echo "<p>Action '<strong>" . htmlspecialchars($action) . "</strong>' not found in controller '<strong>" . htmlspecialchars($controllerName) . "</strong>'.</p>";
        include PROJECT_ROOT . '/view/layout/footer.php';
    }
} else {
    // Controller not found error
    include PROJECT_ROOT . '/view/layout/header.php';
    http_response_code(404);
    echo "<h1>404 - Trang không tồn tại</h1>";
    echo "<p>Controller for page '<strong>" . htmlspecialchars($page) . "</strong>' not found.</p>";
    include PROJECT_ROOT . '/view/layout/footer.php';
}
