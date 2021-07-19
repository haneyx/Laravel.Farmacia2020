<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'producto';
    protected $fillable=['codigo','detalle','pcompra','pventa','stock','expmes','expanio'];
    public $timestamps = false;
}
