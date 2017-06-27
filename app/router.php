<?php

use ArmoredCore\Facades\Router;


// --- Auth Routes --- //
Router::get('/',			      'AuthController/login');
Router::get('auth/login',         'AuthController/login');
Router::post('auth/authenticate', 'AuthController/authenticate');
Router::get('auth/logout',        'AuthController/logout');

// --- Back Office Routes --- //
Router::get('back-office/user-list',          'BackOfficeController/getUserList');
Router::get('back-office/toggle-user-status', 'BackOfficeController/toggleUserStatus');


// --- User Routes --- //
Router::get('user/register', 'UsersController/register');
Router::post('user/store',  'UsersController/store');
Router::get('user/profile',  'UsersController/profile');
Router::post('user/update', 'UsersController/update');


// --- Movements Routes --- //
Router::get('account/movements',   'UsersController/getAccountMovements');


// --- Game Routes --- //
Router::get('game/',          'GameController/index');
Router::get('game/deal',      'GameController/deal');
Router::get('game/hand',      'GameController/hand');
Router::get('game/draw',      'GameController/draw');
Router::get('game/prize',     'GameController/prize');
Router::get('game/rules',     'GameController/rules');
Router::get('game/ranking',   'GameController/ranking');


// --- Store Routes --- //
Router::get('store/',             'StoreController/index');
Router::post('store/buy-credits', 'StoreController/buyCredits');