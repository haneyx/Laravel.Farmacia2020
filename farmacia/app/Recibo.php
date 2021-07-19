<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recibo extends Model
{
    protected $table = 'sunat';
    protected $fillable=['sb','nb','sf','nf'];
    public $timestamps = false;
}
