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
        return View::make('game.index');
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
}