<?php

namespace App;

use Faker\Guesser\Name;
use Illuminate\Database\Eloquent\Model;

class Marginaciones extends Model
{
    //
  
    protected $table = 'marginaciones';
    protected $fillable = [
        'libro',
        'partida',
        'folio',
        'annio',
    ];
}
