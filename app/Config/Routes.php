<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/about', 'Pages::about');
$routes->get('/contact', 'Pages::contact');
$routes->get('/faq', 'Pages::faq');

$routes->get('/articles', 'Articles::index');
$routes->get('/articles/(:any)', 'Articles::detail/$1');

$routes->group('admin', ['filter' => 'auth'], function ($routes) {
    $routes->get('articles', 'Articles::admin_index');
    $routes->get('article/add', 'Articles::add');
    $routes->post('article/add', 'Articles::add');
    $routes->get('article/edit/(:num)', 'Articles::edit/$1');
    $routes->post('article/edit/(:num)', 'Articles::edit/$1');
    $routes->get('article/delete/(:num)', 'Articles::delete/$1');
});

$routes->group('users', function ($routes) {
    $routes->get('login', 'UserController::login');
    $routes->post('login', 'UserController::login');
    $routes->get('logout', 'UserController::logout');
    $routes->post('logout', 'UserController::logout');
});
