<?php

use ArmoredCore\Facades\Router;

Router::get('/',			'HomeController/index');
Router::get('home/',		'HomeController/index');
Router::get('home/index',	'HomeController/index');
Router::get('home/start',	'HomeController/start');
Router::get('home/login',	'HomeController/login');
Router::post('home/sigin','AuthController/authenticate');


// --- User Routes --- //
Router::get('users/index',   'UserController/index');
Router::get('users/create',  'UserController/create');
Router::post('users/store',  'UserController/store');
Router::get('users/show',    'UserController/show');
Router::get('users/edit',    'UserController/edit');
Router::post('users/update', 'UserController/update');
Router::post('users/delete', 'UserController/destroy');
// Router::resource('users', 'UserController');


// --- Transaction Routes --- //
Router::get('transactions/index',   'TransactionController/index');
Router::get('transactions/create',  'TransactionController/create');
Router::post('transactions/store',  'TransactionController/store');
Router::get('transactions/show',    'TransactionController/show');
Router::get('transactions/edit',    'TransactionController/edit');
Router::post('transactions/update', 'TransactionController/update');
Router::post('transactions/delete', 'TransactionController/destroy');
// Router::resource('users', 'UserController');

// --- Game Routes --- //
Router::get('game/index', 'GameController/index');