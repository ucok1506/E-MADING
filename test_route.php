<?php
// Test file untuk cek route
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

// Cek route list
$routes = Route::getRoutes();
foreach ($routes as $route) {
    if (str_contains($route->uri(), 'artikel/create')) {
        echo "Route found: " . $route->uri() . " -> " . $route->getActionName() . "\n";
        echo "Methods: " . implode(', ', $route->methods()) . "\n";
        echo "Middleware: " . implode(', ', $route->middleware()) . "\n";
    }
}
?>