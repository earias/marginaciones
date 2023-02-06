<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Style extends Model
{
    protected $table = "style";

    protected $primaryKey = 'id_style';

    protected $fillable = ['title','style','created_at','updated_at'];
}
