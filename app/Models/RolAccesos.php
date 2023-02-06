<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RolAccesos extends Model
{
    protected $table = "rol_accesos";

    protected $fillable = ['id_rol','id_submenu','created_at','updated_at'];


 	public function submenu()
    {
        return $this->hasOne('App\Models\SubMenu');
    }

    public function rol()
    {
        return $this->hasOne('App\Models\Rol');
    }


}
