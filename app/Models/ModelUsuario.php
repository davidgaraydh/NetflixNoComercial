<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelUsuario extends Model
{
    //estas lineas
    protected $table = 'tb_usuario';

    protected $primaryKey = 'idUsuario';

    public $timestamps = false;
}
