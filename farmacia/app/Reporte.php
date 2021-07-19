<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
    protected $table = 'venta';
    protected $fillable=['dia','mes','anio','inicial'];
    public $timestamps = false;
}
