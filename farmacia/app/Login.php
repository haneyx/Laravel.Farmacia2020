<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    protected $table = 'usuario';
    protected $fillable=['user','pass','inicial'];
    public $timestamps = false;
}
