<?php

use ArmoredCore\Controllers\BaseController;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\Session;
use ArmoredCore\WebObjects\View;

class HomeController extends BaseController
{
    /**
     * @return \ArmoredCore\WebObjects\View
     */
    public function index()
    {
        return View::make('home.index');
    }

    /**
     *
     */
    public function start()
    {
        //View::attachSubView('titlecontainer', 'layout.pagetitle', ['title' => 'Quick Start']);
        return View::make('home.start');
    }

    /**
     *
     */
    public function login()
    {
        return View::make('home.login');
    }

    /**
     *
     */
    public function worksheet()
    {
        View::attachSubView('titlecontainer', 'layout.pagetitle', ['title' => 'MVC Worksheet']);

        return View::make('home.worksheet');
    }

    /**
     *
     */
    public function setsession()
    {
        $dataObject = MetaArmCoreModel::getComponents();
        Session::set('object', $dataObject);

        Redirect::toRoute('home/worksheet');
    }

    /**
     *
     */
    public function showsession()
    {
        $res = Session::get('object');
        var_dump($res);
    }

    /**
     *
     */
    public function destroysession()
    {
        Session::destroy();
        Redirect::toRoute('home/worksheet');
    }
}