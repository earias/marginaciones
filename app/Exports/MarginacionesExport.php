<?php

namespace App\Exports;

use App\Marginaciones;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MarginacionesExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return Marginaciones::all();
        return Marginaciones::get([
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
        ]);
        
    }

    public function headings(): array
    {
        // return Marginaciones::all();
        return [
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
        
    }

}
