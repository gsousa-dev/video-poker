<?php

use ArmoredCore\Controllers\BaseController;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\Session;
use ArmoredCore\WebObjects\View;
use ArmoredCore\Interfaces\ResourceControllerInterface;

class MovementsController extends BaseController
{
    /**
     * @param $page
     * @return mixed
     */
    public function getAccountMovements($page = 1) 
    {
        if (isset($_SESSION['user'])) {
            $account = User::find($_SESSION['user']->id);

            // Total Number of movements for the current account
            $total_movements = count($account->movements);

            // Movements we want to show per page
            $movements_per_page = 5;
            
            // Total Number of Pages
            $total_pages = ceil($total_movements / $movements_per_page);

            if ($page < 1) {
                // Go to the first page
                $page = 1;
            } else if ($page > $total_pages) {
                // Go to the last page
                $page = $total_pages;
            }

            // First index of each page
            $index = ($movements_per_page * $page) - ($movements_per_page -1);

            $movements = Movement::find_all_by_userId($account->id, [
                'limit' => $movements_per_page,
                'offset' => $index - 1,
                'order' => 'created_at desc'
            ]);

            return View::make('account.movements', [
                'accountMovements' => $movements,
                'page' => $page,
                'pages' => $total_pages,
                'index' => $index
            ]);
        }

        return Redirect::toRoute('auth/login');
    }
}