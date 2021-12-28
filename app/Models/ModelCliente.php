<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelCliente extends Model
{
   
    //estas lineas
    protected $table = 'tb_cliente';

    protected $primaryKey = 'idCliente';

    public $timestamps = false;

}
