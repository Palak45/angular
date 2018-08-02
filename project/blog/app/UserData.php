<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserData extends Model
{
    public $fillable=['id','name','email','password','created_at','updated_at'];

    public $table='users';
}
