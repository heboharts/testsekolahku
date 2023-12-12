<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->resource('users');
$routes->resource('courses');
$routes->resource('usercourse');
$routes->resource('sekolahku');
