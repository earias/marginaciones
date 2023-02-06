<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Requests\MenuRequest;
use App\Http\Requests\MenuUpdateRequest;

class MenuController extends Controller
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
        $data['menus']      = Menu::orderBy('created_at','DESC')->paginate(5);
        return view('config.menu.index',$data);
    }

    public function find(Request $request)
    {
        $data['menus']      = Menu::Search($request->search)->orderBy('created_at','DESC')->paginate(10);
        return view('config.menu.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('menu.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuRequest $request)
    {
        DB::beginTransaction();
 
        try {
            $menu               = new Menu();
            $menu->title        = $request->titulo;
            $menu->description  = $request->descripcion;
            $menu->icon         = $request->icono;
            $menu->url          = $request->url; 
            $menu->id_module    = $request->modulo;
            $menu->save();
    
            DB::commit();

            $request->session()->flash('alert-success', 'Registro Ingresado Exitosamente');
            return redirect('menu');

        } catch (\Exception $e) {

            DB::rollback();
            $request->session()->flash('alert-error', 'Error: Intente nuevamente');
            return redirect('menu');

        } catch (\Throwable $e) {

            DB::rollback();
            $request->session()->flash('alert-error', 'Error: Intente nuevamente');
            return redirect('menu');

        }catch (\ModelNotFoundException $exception) {

            DB::rollback();
            $request->session()->flash('alert-error', 'Error: Intente nuevamente');
            return redirect('menu');

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
    public function edit(Menu $menu)
    {
        $data['menu']       = $menu;
        $data['modulos']    = Module::pluck('title','id');
        return view('config.menu.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MenuUpdateRequest $request,Menu $menu)
    {
        DB::beginTransaction();
 
        try {
            $menu->icon         = $request->icono;
            $menu->title        = $request->titulo;
            $menu->url          = $request->url;
            $menu->description  = $request->descripcion;
            $menu->id_module    = $request->modulo;
            $menu->save();
    
            DB::commit();

            $request->session()->flash('alert-success', 'Registro Actualizado Exitosamente');
            return redirect('menu');

        } catch (\Exception $e) {

            DB::rollback();

            $request->session()->flash('alert-error', 'Error: Intente Nuevamente');
            return redirect()->back();

        } catch (\Throwable $e) {

            DB::rollback();
            $request->session()->flash('alert-error', 'Error: Intente Nuevamente');
            return redirect()->back();

        }catch (\ModelNotFoundException $exception) {

            DB::rollback();
            $request->session()->flash('alert-error', 'Error: Intente Nuevamente');
            return redirect()->back();

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        DB::beginTransaction();
 
        try {
            $menu->delete();
    
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

    public function anular(Menu $menu)
    {
        DB::beginTransaction();
 
        try {
            $menu->status   = 0;
            $menu->save();
    
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

    public function activar(Menu $menu)
    {
        DB::beginTransaction();
 
        try {
            $menu->status   = 1;
            $menu->save();
    
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
