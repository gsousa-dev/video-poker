<?php

use ArmoredCore\Facades\Router;


// --- Auth Routes --- //
Router::get('/',			      'AuthController/login');
Router::get('auth/login',         'AuthController/login');
Router::post('auth/authenticate', 'AuthController/authenticate');
Router::get('auth/logout',        'AuthController/logout');


// --- User Routes --- //
Router::get('users/index',    'UserController/index');
Router::get('user/dashboard', 'UsersController/dashboard');
Router::get('user/register',  'UsersController/create');
Router::post('users/store',   'UsersController/store');
Router::get('users/show',     'UsersController/show');
Router::get('users/edit',     'UsersController/edit');
Router::post('users/update',  'UsersController/update');
Router::post('users/delete',  'UsersController/destroy');

// --- Transaction Routes --- //
Router::get('account/movements', 'MovementsController/getAccountMovements');
Router::get('store/credits',     'MovementsController/store');
Router::post('store/buy-credits',      'MovementsController/buyCredits');


Router::get('transactions/index',   'TransactionController/index');
Router::get('transactions/create',  'TransactionController/create');
Router::post('transactions/store',  'TransactionController/store');
Router::get('transactions/show',    'TransactionController/show');
Router::get('transactions/edit',    'TransactionController/edit');
Router::post('transactions/update', 'TransactionController/update');
Router::post('transactions/delete', 'TransactionController/destroy');

// --- Game Routes --- //
Router::get('game/play',     'GameController/play');
Router::get('game/card-deck', 'GameController/getCardDeck');
Router::get('game/rules',     'GameController/rules');


Router::get('store/',             'StoreController/index');
Router::post('store/buy-credits', 'StoreController/buyCredits');

Router::post('store/test', 'StoreController/test');

