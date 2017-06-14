<?php

use ArmoredCore\Controllers\BaseController;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\Session;
use ArmoredCore\WebObjects\View;
use ArmoredCore\Interfaces\ResourceControllerInterface;

class UserController extends BaseController
{
    /**
     * @return \ArmoredCore\WebObjects\View;
     */
    public function index() 
    {
    }

    /**
     * @return \ArmoredCore\WebObjects\View;
     */
    public function create() 
    {
    }

    /**
     * @return mixed
     */
    public function store() 
    {
    }

    /**
     * @param $id
     * @return \ArmoredCore\WebObjects\View;
     */
    public function show($id) 
    {
        $user = User::find($id);        
    }

    /**
     * @param $id
     * @return \ArmoredCore\WebObjects\View;
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