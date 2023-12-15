<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

//Students
$routes->get('login', 'LoginController::index');
$routes->post('login_user', 'LoginController::login_user');
$routes->post('students/add_student', 'StudentController::add_student');
$routes->put('students/modify_student/(:segment)', 'StudentController::modify_student/$1');
$routes->delete('students/delete_student/(:segment)', 'StudentController::delete_student/$1');
$routes->post('students/export_to_excel', 'StudentController::export_to_excel');
$routes->post('register_user', 'RegisterController::register_user');

$routes->group('', ['filter' => 'LoginCheck'], function ($routes) {
    $routes->get('students/dashboard', 'StudentController::index');
    $routes->get('students/create_student', 'StudentController::create_student');
    $routes->get('students/edit_student/(:segment)', 'StudentController::edit_student/$1');
    $routes->get('register', 'RegisterController::index');
});
