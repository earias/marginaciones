<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Rol;
use App\Models\SubMenu;
use App\Models\RolAccesos;
use Illuminate\Http\Request;
use App\Http\Requests\RolRequest;
use App\Http\Requests\RolUpdateRequest;

class RoleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['roles'] = Rol::orderBy('created_at','DESC')->paginate(5);
        return view('config.rol.index',$data);
    }

    public function find(Request $request)
    {
        $data['roles'] = Rol::Search($request->search)->orderBy('created_at','DESC')->paginate(5);
        return view('config.rol.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['submenus'] = SubMenu::where('status',1)->pluck('title','id');
        return view('config.rol.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RolRequest $request)
    {
        DB::beginTransaction();
 
        try {
            $rol                = new Rol();
            $rol->title         = $request->titulo;
            $rol->description   = $request->descripcion;
            $rol->show          = $request->get('show',0);
            $rol->create        = $request->get('create',0);
            $rol->edit          = $request->get('edit',0);
            $rol->cancel        = $request->get('cancel',0);
            $rol->delete        = $request->get('delete',0);
            $rol->save();

            if (count($request->permisos)) {
                setAccesos($request->permisos, $rol->id);
            }
    
            DB::commit();

            $request->session()->flash('alert-success', 'Registro ingresado exitosamente');
            return redirect('rol');

        } catch (\Exception $e) {

            DB::rollback();
            $request->session()->flash('alert-error', 'Error: Intente nuevamente');
            return redirect()->back();

        } catch (\Throwable $e) {

            DB::rollback();
            $request->session()->flash('alert-error', 'Error: Intente nuevamente');
            return redirect()->back();

        }catch (\ModelNotFoundException $exception) {

            DB::rollback();
            $request->session()->flash('alert-error', 'Error: Intente nuevamente');
            return redirect()->back();

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Rol $rol)
    {
        $data['rol']        = $rol;
        $data['lista']      = RolAccesos::where('id_rol', $rol->id)->pluck('id_submenu'); 
        $data['submenus']   = SubMenu::where('status',1)->pluck('title','id');
        return view('config.rol.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rol $rol)
    {        
        DB::beginTransaction();
 
        try {
            $rol->title         = $request->titulo;
            $rol->description   = $request->descripcion;
            $rol->show          = $request->get('show',0);
            $rol->create        = $request->get('create',0);
            $rol->edit          = $request->get('edit',0);
            $rol->cancel        = $request->get('cancel',0);
            $rol->delete        = $request->get('delete',0);
            $rol->save();

            if (count($request->permisos)) {
                deleteAccesos($rol->id);
                setAccesos($request->permisos, $rol->id);
            }
    
            DB::commit();

            $request->session()->flash('alert-success', 'Registro ingresado exitosamente');
            return redirect('rol');

        } catch (\Exception $e) {

            DB::rollback();
            $request->session()->flash('alert-error', 'Error: Intente nuevamente');
            return redirect()->back();

        } catch (\Throwable $e) {

            DB::rollback();
            $request->session()->flash('alert-error', 'Error: Intente nuevamente');
            return redirect()->back();

        }catch (\ModelNotFoundException $exception) {

            DB::rollback();
            $request->session()->flash('alert-error', 'Error: Intente nuevamente');
            return redirect()->back();

        }
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rol $rol)
    {
        DB::beginTransaction();
 
        try {
            deleteAccesos($rol->id);
            $rol->delete();
    
            DB::commit();

            return response()->json(['type'=>'success','title'=> 'Registro Eliminado Exitosamente'], 200);

        } catch (\Exception $e) {

            DB::rollback();
            return response()->json(['type'=>'error','title'=> 'Error, Intente nuevamente'], 200);

        } catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['type'=>'error','title'=> 'Error, Intente nuevamente'], 200);

        }catch (\ModelNotFoundException $exception) {

            DB::rollback();
            return response()->json(['type'=>'error','title'=> 'Error, Intente nuevamente'], 200);

        }
    }

    public function anular(Rol $rol)
    {
        DB::beginTransaction();
 
        try {
            $rol->status   = 0;
            $rol->save();
    
            DB::commit();

            return response()->json(['type'=>'success','title'=> 'Registro Anulado Exitosamente'], 200);

        } catch (\Exception $e) {

            DB::rollback();
            return response()->json(['type'=>'error','title'=> 'Error, Intente nuevamente'], 200);

        } catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['type'=>'error','title'=> 'Error, Intente nuevamente'], 200);

        }catch (\ModelNotFoundException $exception) {

            DB::rollback();
            return response()->json(['type'=>'error','title'=> 'Error, Intente nuevamente'], 200);

        }
    }

    public function activar(Rol $rol)
    {
        DB::beginTransaction();
 
        try {
            $rol->status   = 1;
            $rol->save();
    
            DB::commit();

            return response()->json(['type'=>'success','title'=> 'Registro Activado Exitosamente'], 200);

        } catch (\Exception $e) {

            DB::rollback();
            return response()->json(['type'=>'error','title'=> 'Error, Intente nuevamente'], 200);

        } catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['type'=>'error','title'=> 'Error, Intente nuevamente'], 200);

        }catch (\ModelNotFoundException $exception) {

            DB::rollback();
            return response()->json(['type'=>'error','title'=> 'Error, Intente nuevamente'], 200);

        }
    }
}
