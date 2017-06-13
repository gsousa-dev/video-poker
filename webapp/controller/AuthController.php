<?php
use ActiveRecord\RecordNotFound;
use ArmoredCore\Controllers\BaseController;
use ArmoredCore\WebObjects\Post;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\Session;
use ArmoredCore\WebObjects\View;
/**
 * Created by PhpStorm.
 * User: Ruben
 * Date: 13/06/2017
 * Time: 19:48
 */

class AuthController
{
    public function authenticate()
    {
        $dados = Post::getAll();
        $verificar = User::all();
        $existe = false;
        $id = 0;
        $username = $dados['username'];
        $password = $dados['password'];

        foreach ($verificar as $value) {
            if ($value->username === $username) {
                $existe = true;
                $id = $value->id;
            }
        }

        if ($existe == true) {
            $user = User::find($id);
            $isPasswordCorrect = password_verify($password, $user->password);
            if ($isPasswordCorrect == true) {//se as credenciais derem certas
                Session::set("user_id", $user->id);
                $_SESSION['msg_auth'] = '';
                $_SESSION['auth'] = true;
                Redirect::toRoute('home/index');

            } else {
                $_SESSION['msg_auth'] = '<b><i class="fa fa-warning fa-l"></i> Erro de autenticação <i class="fa fa-warning fa-l"></i></b><br>Password errada!';
                $_SESSION['auth'] = false;
                $_SESSION['user_log'] = $username;
                $_SESSION['pass_log'] = $dados['password'];
                Redirect::toRoute('home/login');
            }
        } else {
            $_SESSION['msg_auth'] = '<b><i class="fa fa-warning fa-l"></i> Erro de autenticação <i class="fa fa-warning fa-l"></i></b><br>O username não existe!';
            $_SESSION['auth'] = false;
            $_SESSION['user_log'] = $username;
            $_SESSION['pass_log'] = $dados['password'];
            Redirect::toRoute('home/login');
        }
    }
}