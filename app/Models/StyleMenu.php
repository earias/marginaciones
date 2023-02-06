<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StyleMenu extends Model
{
    protected $table = "style_menu";

    protected $primaryKey = 'id_style_menu';

    protected $fillable = ['title','sub','style','created_at','updated_at'];
}
