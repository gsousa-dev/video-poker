<?php

use ArmoredCore\Controllers\BaseController;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\Session;
use ArmoredCore\WebObjects\View;
use ArmoredCore\WebObjects\Post;

class StoreController extends BaseController
{
    /**
     * @return \ArmoredCore\WebObjects\View
     */
    public function index() 
    {
        if (isset($_SESSION['user'])) {
            $user = User::find($_SESSION['user']->id);
            
            return View::make('store.index', ['user' => $user]);
        }

        return Redirect::toRoute('auth/login');
    }

    /**
     * @return string 
     */
    public function buyCredits()
    {
        header("Content-type: application/json");

        $description = Post::get('description');
        $credits     = Post::get('credits');

        if (!isset($_SESSION['user'])) {
            // User isn't logged in            
            echo 401;
            return;
        }

        // User is logged in
        $user = User::find(Session::get('user')->id);

        $movement = Movement::create([
            'type'        => 'buy',
            'description' => $description,
            'credit'      => $credits,
            'debit'       => 0,
            'balance'     => $user->balance + $credits,
            'userId'      => $user->id
        ]);

        $user->balance += $credits;
        $user->save();

        echo 200;
    }
}