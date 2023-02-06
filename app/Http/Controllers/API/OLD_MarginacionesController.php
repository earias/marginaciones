<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Marginaciones;

class MarginacionesController extends Controller
{
    public function index()
    {
        $marginaciones = Marginaciones::all();
        return response()->json([
            'status'=> 200,
            'marginaciones'=>$marginaciones,
        ]);
    }

    public function store(Request $request)
    {

   
            $marginacion = new Marginaciones();
            $marginacion->libro = $request->input('libro');
            $marginacion->partida = $request->input('partida');
            $marginacion->folio = $request->input('folio');
            $marginacion->libro = $request->input('libro');
            $marginacion->save();
            return $marginacion;
            
            return response()->json([
                'status'=> 200,
                'message'=>'Agregado exitosamente',
            ]);
        }

    public function edit($marginacion_id)
    {
        $marginaciones = Marginaciones::find($marginacion_id);
        return response()->json([
            'status'=> 200,
            'marginaciones'=>$marginaciones,
        ]);
    }

    }