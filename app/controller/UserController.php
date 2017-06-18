<?php

use ArmoredCore\Controllers\BaseController;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\Session;
use ArmoredCore\WebObjects\View;
use ArmoredCore\Interfaces\ResourceControllerInterface;
use ArmoredCore\WebObjects\Post;

class UserController extends BaseController
{
    /**
     * @return \ArmoredCore\WebObjects\View
     */
    public function index() 
    {
    }

    /**
     * @return \ArmoredCore\WebObjects\View
     */
    public function create() 
    {
        return View::make('auth.register');
    }

    /**
     * @return mixed
     */
    public function store() 
    {
        $data = Post::getAll();

        $user = new User();
        $user->fullname = $data['fullName'];
        $user->birthday = $data['birthday'];
        $user->username = $data['username'];
        $user->email    = $data['email'];
        $user->password = password_hash($data['password'], PASSWORD_BCRYPT);
        
        if ($user->save()) {
            return View::make('auth.login');
        }

        return;
    }

    /**
     * @param $id
     * @return \ArmoredCore\WebObjects\View
     */
    public function show($id) 
    {
        if (isset($_SESSION['authenticated'])) {
            $user = User::find($id);        

            return View::make('users.profile', ['user' => $user]);
        }

        return Redirect::toRoute('auth/login');
    }

    /**
     * @param $id
     * @return \ArmoredCore\WebObjects\View
     */
    public function edit($id) 
    {
        $user = User::find($id);        
    }

    /**
     * @param $id
     * @return mixed
     */
    public function update($id) 
    {
        $user = User::find($id);        
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id) 
    {
        $user = User::find($id);
    }
}