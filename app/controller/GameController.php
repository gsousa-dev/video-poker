<?php

use ActiveRecord\RecordNotFound;
use ArmoredCore\Controllers\BaseController;
use ArmoredCore\WebObjects\Post;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\Session;
use ArmoredCore\WebObjects\View;
use ArmoredCore\WebObjects\Asset;

class GameController
{
    /**
     * @return \ArmoredCore\WebObjects\View
     */
    public function index() 
    {
        if (isset($_SESSION['user'])) {
            $user = User::find(Session::get('user')->id);

            if ($user->balance > 0) {
                // User has enough credits to enter the game
                return View::make('game.index');
            }

            // User doesn't have enough credits to even enter the game so we send him to the store
            return Redirect::toRoute('store/');
        }

        return Redirect::toRoute('auth/login');
    }

    /**
     * @return
     */
    public function getCardDeck() 
    {

        // $directory = '/public/img/cards/front/';
        $directory = Asset::image('cards/front/');
        $cards = glob($directory . '*.png');

        echo $directory . '<br>';

        print_r($cards);
        // echo json_encode($cards);
    }

    /**
     * @return \ArmoredCore\WebObjects\View
     */
    public function rules()
    {
        return View::make('game.rules');
    }

    /**
     * @return \ArmoredCore\WebObjects\View
     */
    public function ranking()
    {
        $players = User::find('all', [
            'limit' => 10,
            'order' => 'winnings desc'
        ]);

        return View::make('game.ranking', [
            'players' => $players
        ]);
    }
}