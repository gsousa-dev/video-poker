<?php

use ActiveRecord\RecordNotFound;
use ArmoredCore\Controllers\BaseController;
use ArmoredCore\WebObjects\Post;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\Session;
use ArmoredCore\WebObjects\View;

class GameController
{
    /**
     * @return \ArmoredCore\WebObjects\View
     */
    public function index() 
    {
        return View::make('game.index');
    }
}