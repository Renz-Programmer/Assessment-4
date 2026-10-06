<?php

use CodeIgniter\Router\RouteCollection;
use Config\Services;

$routes = Services::routes();

/**
 * @var RouteCollection $routes
 */

if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

// Home Route
$routes->get('/', 'Home::index');

// Login Routes
$routes->get('login', 'Auth::login');
$routes->post('login/auth', 'Auth::authenticate');
$routes->get('logout', 'Auth::logout');

// Protected Routes
$routes->group('', ['filter' => 'auth'], function ($routes) {

    // Customer Routes
    $routes->get('customers', 'CustomerController::index');
    $routes->get('customers/new', 'CustomerController::new');
    $routes->post('customers/create', 'CustomerController::create');
    $routes->get('customers/edit/(:num)', 'CustomerController::edit/$1');
    $routes->post('customers/update/(:num)', 'CustomerController::update/$1');

    // User Routes
    $routes->get('users', 'UserController::index');
    $routes->get('users/new', 'UserController::new');
    $routes->post('users/create', 'UserController::create');
    $routes->get('users/edit/(:num)', 'UserController::edit/$1');
    $routes->post('users/update/(:num)', 'UserController::update/$1');

});