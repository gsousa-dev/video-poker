<?php

use ActiveRecord\Model;

class User extends Model
{
    /**
     * Account Movements
     *
     * @return \App\Model\Movements []
     */
    static $has_many = [
        ['movements', 'foreign_key' => 'userId']
    ];
 
    /**
     * @return \App\Model\User
     */
    public static function findByUsername($username)
    {
        return static::find(['username' => $username]);
    }

    /**
     * @return boolean
     */
    public function validatePassword($password)
    {
        if (password_verify($password, $this->password)) {
            return true;
        }

        return false;
    }
}