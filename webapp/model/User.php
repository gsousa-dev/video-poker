<?php

/**
 * Created by PhpStorm.
 * User: Ruben
 * Date: 13/06/2017
 * Time: 19:26
 */

use \ActiveRecord\Model;

class User extends Model
{
    static $validates_presence_of = array(
        array('name'),
        array('isbn', 'message' => 'YooaaH it must be provided')
    );


}