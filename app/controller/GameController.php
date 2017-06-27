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
                unset($_SESSION['bet']);
                unset($_SESSION['hand']);

                return View::make('game.index', [
                    'user' => $user
                ]);
            }

            // User doesn't have enough credits to even enter the game so we send him to the store
            return Redirect::toRoute('store/');
        }

        return Redirect::toRoute('auth/login');
    }


    /**
     * 
     */
    public function deal($bet)
    {
        if (isset($_SESSION['user']) && $bet) {
            $user = User::find(Session::get('user')->id);

            $deck = $this->getDeck();
            $hand = array_slice($deck, 0, 5);             

            for ($card = 0; $card < 5; $card++) { 
                $hand[$card] = substr($hand[$card], strpos($hand[$card], '\video-poker'));
                $hand[$card] = str_replace('/', '\\', $hand[$card]);
            }

            $_SESSION['bet'] = $bet;
            $_SESSION['hand'] = $hand;

            $movement = Movement::create([
                'type'        => 'bet',
                'description' => 'bet x' . $bet,
                'credit'      => 0,
                'debit'       => $bet,
                'balance'     => $user->balance - $bet,
                'userId'      => $user->id
            ]);

            $user->balance -= $bet;
            $user->save();

            return Redirect::toRoute('game/hand');
        }

        return Redirect::toRoute('auth/login');
    }

    public function hand()
    {
        if (isset($_SESSION['user'])) {

            if (isset($_SESSION['hand']) && isset($_SESSION['bet'])) {
                return View::make('game.index');
            }

            return Redirect::toRoute('game/');
        }

        return Redirect::toRoute('auth/login');
    }

    public function draw($cards = null)
    {
        if ($cards) {
            $cardsToDraw = str_split($cards);
            $hand = $_SESSION['hand'];
            $deck = $this->getDeck();

            foreach ($cardsToDraw as $cardToDraw) {
                foreach($_SESSION['hand'] as $handCard) {
                    do {
                        $randomCard = $deck[rand(0, 51)];
                        $_SESSION['hand'][$cardToDraw] = $randomCard;
                    } while ($this->has_dupes($_SESSION['hand']));
                }
            }
        }

        return Redirect::toRoute('game/prize');   
    }

    public function prize()
    {
        if (isset($_SESSION['hand'])) {
            $hand = $_SESSION['hand'];

            foreach ($hand as $card) {
                
            }

            return View::make('game.index');
        }

        return Redirect::toRoute('game/');
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

    /**
     * @return array
     */
    private function getDeck()
    {
        chdir('../public/img/cards/front/');
        $directory = getcwd() . '/';       
        $deck = glob($directory . '*.png');
        shuffle($deck);

        for ($card = 0; $card < count($deck); $card++) { 
            $deck[$card] = substr($deck[$card], strpos($deck[$card], '\video-poker'));
            $deck[$card] = str_replace('/', '\\', $deck[$card]);
        }
 
        return $deck;
    }

    private function has_dupes($array) 
    {
        return count($array) !== count(array_unique($array));
    }
}