<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuario';
    protected $fillable=['dni','nombre','tipo','apellidos','pass'];// ,campo2,campo3
    public $timestamps = false;
}
