<?php

namespace App\Models;

use App\Models\UserRol;
use Illuminate\Database\Eloquent\Model;

class UserRol extends Model
{
    protected $table = "user_rols";

    protected $fillable = ['id_user','id_rol'];

 	public function rol()
    {
        return $this->hasOne('App\Models\Rol','id','id_rol');
    }

    public function user()
    {
        return $this->hasOne('App\User','id','id_user');
    }
}
