<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Arrac extends Model
{
    protected $connection = 'mysql_comanda';
    protected $table = 'arracoamentos';
    protected $fillable = ['cpf', 'dia_semana', 'data_arrac', 'refeicao'];
}
