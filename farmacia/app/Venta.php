<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table = 'producto';
    protected $fillable=['fecha','ticket','atiende'];// ,campo2,campo3
    public $timestamps = false;
}
