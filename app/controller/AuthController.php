<?php

use ActiveRecord\RecordNotFound;
use ArmoredCore\Controllers\BaseController;
use ArmoredCore\WebObjects\Post;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\Session;
use ArmoredCore\WebObjects\View;

class AuthController extends BaseController
{
    /**
     * @return \ArmoredCore\WebObjects\View
     */
    public function login() 
    {
        if (isset($_SESSION['user'])) {
            return Redirect::toRoute('user/profile');
        }

        return View::make('auth.login');
    }

    public function authenticate()
    {
        if (!isset($_SESSION['user'])) {
            $username = Post::get('username');
            $password = Post::get('password');

            $user = User::find_by_username($username);

            if ($user) {
                // User exists
                if ($user->isblocked) {
                    // User is blocked
                    return View::make('auth.login', ['userIsBlocked' => 'true']);                    
                }

                // User is not blocked
                if ($user->validatePassword($password)) {
                    // User logged in successfully
                    Session::set('user', $user);

                    return Redirect::toRoute('game/');
                }
            }

            // User does not exist or password is incorrect
            return View::make('auth.login', ['loginFailed' => 'true']);
        }

        return View::make('auth.login');
    }

    /**
     * @return \ArmoredCore\WebObjects\Redirect;
     */
    public function logout()
    {
        Session::destroy();

        return Redirect::toRoute('auth/login');
    }
}