<?php

namespace App;

use Faker\Guesser\Name;
use Illuminate\Database\Eloquent\Factory;
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
        'tipo',
        'texto',
        'libromarg',
        'marginacion',
        'habilitado',
        'textoh',
        'iniciales',
        'jefe',
        'user',
    ];

    public function messages()
    {
        return ;
    }
    public function scopeSearch($query,$search){
        return $query->where('id','like','%'.$search.'%')->orWhere('texto','like','%'.$search.'%');
    }


}
