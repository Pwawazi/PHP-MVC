<?php

require_once __DIR__.'/../vendor/autoload.php';

use app\base\Application;
use app\controllers\AppController;
use app\controllers\AuthController;
use app\models\User;

$config = [
    'userClass' => User::class
];

$routeList = array(
        '/register' => [AuthController::class, 'register'], 
        '/login' => [AuthController::class, 'login'],
        'logout' => [AuthController::class, 'logout'],
        '/profile', '/profile/{id:\d+}/{username}' => [AuthController::class, 'profile'], 
        '/shop', '/shop/{id}' => [AppController::class, 'shop'], 
        '/add-product' => [AppController::class, 'addProduct'], 
        '/cart' => [AppController::class, 'cart'], 
        '/users' => [AppController::class, 'users']
);

$app = new Application(dirname(__DIR__), $config, $routeList);

$app->router->get('/', [AppController::class, 'home']);

/**Auth Routes */
$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);
$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);
$app->router->get('/logout', [AuthController::class, 'logout']);
$app->router->get('/profile', [AuthController::class, 'profile']);
$app->router->get('/profile/{id:\d+}/{username}', [AuthController::class, 'profile']);

/** Application Routes */
$app->router->get('/shop', [AppController::class, 'shop']);
$app->router->post('/shop', [AppController::class, 'shop']);
$app->router->get('/shop/{id:\d+}', [AppController::class, 'shop']);
$app->router->get('/add-product', [AppController::class, 'addProduct']);
$app->router->post('/add-product', [AppController::class, 'addProduct']);
$app->router->get('/cart', [AppController::class, 'cart']);
$app->router->get('/users', [AppController::class, 'users']);



// $app->router->get('/para', function () {
//     return 'para';
// });

$app->router->get('/trials', [AuthController::class, 'trials']);

$app->router->get('/contact', [AppController::class, 'contact']);
$app->router->post('/contact', [AppController::class, 'handleContact']);


$app->run();