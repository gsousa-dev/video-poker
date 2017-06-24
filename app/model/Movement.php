<?php

use ActiveRecord\Model;

class Movement extends Model
{
    static $belongs_to = [['user']];
}