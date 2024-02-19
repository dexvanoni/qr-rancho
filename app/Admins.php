<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admins extends Model
{
    protected $connection = 'mysql_comanda';
    protected $table = 'admins';
}
