<?php

use App\Controllers\AuthController;
use App\Controllers\DashboardController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', [DashboardController::class, 'index'], ['filter'  => 'auth']);
$routes->get('/login', [AuthController::class, 'login']);
$routes->get('/register', [AuthController::class, 'register']);
$routes->post('/doLogin', [AuthController::class, 'doLogin']);
$routes->post('/doRegister', [AuthController::class, 'doRegister']);
$routes->get('/logout', [AuthController::class, 'logout']);
$routes->get('/forgot_password', [AuthController::class, 'forgotPassword']);
$routes->post('/forgot_password', [AuthController::class, 'processForgotPassword']);
$routes->get('/reset_password/(:any)', [AuthController::class, 'resetPassword/$1']);
$routes->post('/reset_password', [AuthController::class, 'processResetPassword']);
$routes->post('/update_profile_picture', [DashboardController::class, 'update_profile_picture']);

