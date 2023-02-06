<?php

namespace App\Imports;

use App\Marginaciones;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class MarginacionesImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    use Importable;

    public function model(array $row)
    {
        return new Marginaciones([
            //
            'id' => $row['id'],
            'libro' => $row['libro'],
            'partida' => $row['partida'],
            'folio' => $row['folio'],
            'annio' => $row['annio'],
            'tipo' => $row['tipo'],
            'texto' => $row['texto'],
            'libromarg' => $row['libromarg'],
            'marginacion' => $row['marginacion'],
            'habilitado' => $row['habilitado'],
            'textoh' => $row['textoh'],
            'iniciales' => $row['iniciales'],
            'jefe' => $row['jefe'],
            'user' => $row['user'], 
        ]);
    }
}
