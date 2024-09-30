<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
$routes->get('/', 'Crud::index');                   // Route to load the main employee CRUD view
$routes->get('Crud/fetchAll', 'Crud::fetchAll');     // Route to fetch all employees
$routes->post('Crud/create', 'Crud::create');        // Route to create a new employee
$routes->post('Crud/update/(:num)', 'Crud::update/$1'); // Route to update employee by ID
$routes->post('Crud/delete/(:num)', 'Crud::delete/$1'); // Route to delete employee by ID
$routes->get('Crud/fetchSingle/(:num)', 'Crud::fetchSingle/$1');   //fetching single data by ID
