<?php

use ArmoredCore\Controllers\BaseController;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\Session;
use ArmoredCore\WebObjects\View;
use ArmoredCore\Interfaces\ResourceControllerInterface;
use ArmoredCore\WebObjects\Post;

class BackOfficeController extends BaseController
{
    /**
     * @return mixed
     */
    public function getUserList($page = 1) 
    {
        if (isset($_SESSION['user'])) {
            // User is logged in

            // Get authenticated user
            $user = User::find(Session::get('user')->id);

            if ($user->isadmin) { // User has admin privileges

                // Get all the users except the authenticated user
                $users = User::find('all', [
                    'conditions' => ['id <> ?', $user->id]
                ]);

                // Total Number of users
                $total_users = count($users);

                // Users we want to show per page
                $users_per_page = 5;
                
                // Total Number of Pages
                $total_pages = ceil($total_users / $users_per_page);

                if ($page < 1) {
                    // Go to the first page
                    $page = 1;
                } else if ($page > $total_pages) {
                    // Go to the last page
                    $page = $total_pages;
                }

                // First index of each page
                $index = ($users_per_page * $page) - ($users_per_page -1);

                return View::make('back-office.user-list', [
                    'users' => $users,
                    'page'  => $page,
                    'pages' => $total_pages,
                    'index' => $index
                ]);                           
            }
            // User doesn't have admin privileges, so we redirect him to his profile
            return Redirect::toRoute('user/profile');
        }
        // No user is logged in
        return Redirect::toRoute('auth/login');
    }

    public function toggleUserStatus($id)
    {
        // Get the specified user resource
        $user = User::find_by_id($id);

        if (isset($_SESSION['user']) && $user) {
            // Some user is logged in
            // AND
            // The targeted user resource exists

            // Get authenticated user
            $authenticatedUser = Session::get('user');

            if ($authenticatedUser->isadmin) {
                // Authenticated user is an admin, so he has the privilege to change user status
                $user->toggleStatus();

                return Redirect::toRoute('back-office/user-list');
            }
        }

        // No user is logged in 
        // OR 
        // The specified user resource doesn't exist
        return Redirect::toRoute('auth/login');
    }

}