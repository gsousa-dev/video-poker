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

class AuthController extends BaseController
{
    public function index(){
        Redirect::toRoute('home/index');
    }

    public function login()
    {
        $msg = $_SESSION['msg_auth'];
        View::make('home.login', ['msg' => $msg]);
    }


    public function authenticate(){
        $dados = Post::getAll();
        $utilizadores = User::all();
        $existe = false;
        $id = 0;
        $username = $dados['username'];
        $password = $dados['password'];

        foreach ($utilizadores as $utilizador) {//vai verificar se existe na BD
            if ($utilizador->username === $username /*&& $value->password == $password*/) {
                $existe = true;
                $id = $utilizador->id;
            }
        }

        if ($existe == true) {
            $user = User::find($id);
            $isPasswordCorrect = password_verify($password, $user->password);
            if ($isPasswordCorrect == true) {//se as credenciais derem certas
                Session::set("user_id", $user->id);
                $msg = '';
                View::make('home.login', ['msg' => $msg]);

            } else {
                $msg = '<b><b> Atenção! </b><br>Password inserida incorreta!';
                View::make('home.login', ['msg' => $msg]);
            }
        } else {
            $msg = '<b> Atenção! </b><br>Username inserido incorreto!';
            View::make('home.login', ['msg' => $msg]);
        }
    }
}