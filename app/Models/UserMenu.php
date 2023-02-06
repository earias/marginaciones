<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserMenu extends Model
{
   	protected $table = "user_menu";

    protected $fillable = ['id_user','id_submenu'];


 	public function submenu()
    {
        return $this->hasOne('App\Models\SubMenu','id','id_submenu');
    }
}
