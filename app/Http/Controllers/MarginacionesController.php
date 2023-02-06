<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Imports\MarginacionesImport;
use App\Imports\MarginacionesExport;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Marginaciones;
use Carbon\Carbon;
use Excel;

class MarginacionesController extends Controller
{

    public function index()
    {
        $data['Marginaciones'] = Marginaciones::orderBy('id','DESC')->paginate(4);
        // return response()->json([
        //     'status'=> 200,
        //     'marginaciones'=>$marginaciones,
        // ]);
        // return $data;
        return view('config.marginaciones.index', $data);
    }

    public function find(Request $request)
    {
        $data['Marginaciones'] = Marginaciones::Search($request->search)->orderBy('id','ASC')->paginate(4);
        
        return view('config.marginaciones.index',$data);
    }

    public function reporte()
    {
        
   
        $data['Marginaciones'] = DB::table('marginaciones')
                 ->select('user', DB::raw('count(*) as total'))
                 ->groupBy('user')
                 ->orderBy('total','DESC')
                 ->get();
               
        return view('config.marginaciones.reporte', $data);
    }

    public function store(Request $request, Marginaciones $marginaciones)
    {
        //return $request;

            $validator = validator::make($request->all(),[
                'libro' => 'required|max:3',
                'partida' => 'required',
                'folio'=>'required',
                'annio'=>'required|max:4|min:4',
                'tipo' => 'required',
                'texto'=>'required',
                'libromarg' => 'required',
                'marginacion' => 'required',
                'habilitado' => 'required',
                'textoh' => 'required',
                'iniciales' => 'required',
                'jefe' => 'required',
                'user' => 'required',
              
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'validate_err'=> $validator->messages(),
                ]);
            } 
                else 
            {
            
            $marginacion = new Marginaciones();
            $marginacion->libro = $request->input('libro');
            $marginacion->partida = $request->input('partida');
            $marginacion->folio = $request->input('folio');
            $marginacion->annio = $request->input('annio');
            $marginacion->tipo = $request->input('tipo');
            $marginacion->texto = $request->input('texto');
            $marginacion->libromarg = $request->input('libromarg');
            $marginacion->marginacion = $request->input('marginacion');
            $marginacion->habilitado = $request->input('habilitado');
            $marginacion->textoh = $request->input('textoh');
            $marginacion->iniciales = $request->input('iniciales');
            $marginacion->jefe = $request->input('jefe');
            $marginacion->user = $request->input('user');
            $marginacion->save();
        
            
            return response()->json([
                'status'=> 200,
                'message'=>'Agregado exitosamente',
            ]);
        
        }
    }
        public function edit($marginacion_id)
        {
            $marginaciones = Marginaciones::find($marginacion_id);
            return response()->json([
                'status'=> 200,
                'marginaciones'=>$marginaciones,
            ]);
        }

        public function update(Request $request, $marginacion_id)
        {
            $marginacion = Marginaciones::find($marginacion_id);
            $marginacion->libro = $request->input('libro');
            $marginacion->partida = $request->input('partida');
            $marginacion->folio = $request->input('folio');
            $marginacion->annio = $request->input('annio');
            $marginacion->tipo = $request->input('tipo');
            $marginacion->texto = $request->input('texto');
            $marginacion->libromarg = $request->input('libromarg');
            $marginacion->marginacion = $request->input('marginacion');
            $marginacion->habilitado = $request->input('habilitado');
            $marginacion->textoh = $request->input('textoh');
            $marginacion->iniciales = $request->input('iniciales');
            $marginacion->jefe = $request->input('jefe');
            $marginacion->user = $request->input('user');
            $marginacion->update();
        
            
            return response()->json([
                'status'=> 200,
                'message'=>'Modificado exitosamente',
            ]);
        }

        public function destroy($id){
            $marginacion = Marginaciones::find($id);
            $marginacion -> delete();
            return response()->json([
                'status'=> 200,
                'message'=>'Registro eliminado',
            ]);
        }

        public function importar()
    {
        $data['Marginaciones'] = Marginaciones::whereDate('created_at', Carbon::today())->orderBy('id', 'DESC')->paginate(4);
        
       return view('config.marginaciones.importar', $data);
    }
   
    /**
    * @return \Illuminate\Support\Collection
    */
    public function fileImport(Request $request) 
    {
        try {
            Excel::import(new MarginacionesImport, $request->file('file')->store('temp'));
            // return response()->json([
            //     'status'=> 200,
            //     'message'=>'Modificado exitosamente',
            // ]);
            // return back()->with('success', 'Importacion exitosa!');
            return back();

        } catch (\Exception $e) {

            DB::rollback();
            return redirect()->back()->withErrors(['type'=>'error','title'=> 'Error, Intente nuevamente'], 200);
    }
}

    /**
    * @return \Illuminate\Support\Collection
    */
    public function fileExport(Request $request) 
    {        
        return Excel::download(new MarginacionesExport, 'marginaciones-collection.xlsx');
    }
    }