<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Menu;
use App\Models\Submenu;
use Illuminate\Http\Request;
use App\Http\Requests\SubMenuRequest;
use App\Http\Requests\SubMenuUpdateRequest;

class SubMenuController extends Controller
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
    public function index(Menu $menu)
    {   
        $data['menu']       = $menu;
        $data['submenus']   = Submenu::where('id_menu',$menu->id)->orderBy('created_at','DESC')->paginate(10);
        return view('config.submenu.index',$data);
    }

    public function find(Request $request)
    {
        $data['menu']     = Menu::find($request->id_menu);
        $data['submenus'] = SubMenu::Search($request->search)->orderBy('created_at','DESC')->paginate(10);
        return view('config.submenu.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Menu $menu)
    {
        // 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubMenuRequest $request)
    {
        DB::beginTransaction();
 
        try {
            // recuperamos el menu
            $menu                   = Menu::find($request->id_menu);

            $submenu                = new SubMenu();
            $submenu->title         = $request->titulo;
            $submenu->description   = $request->descripcion;
            $submenu->url           = $request->url;
            $submenu->icon          = $request->icono;
            $submenu->type          = $request->tipo;
            $submenu->order         = $request->orden;
            $submenu->id_menu       = $request->id_menu;
            $submenu->save();
    
            DB::commit();

            $request->session()->flash('alert-success', 'Registro ingresado exitosamente');
            return redirect('menu/add/'.$menu->id);

        } catch (\Exception $e) {

            DB::rollback();
            $request->session()->flash('alert-error', 'Error: Intente nuevamente');
            return redirect('menu/add/'.$menu->id);

        } catch (\Throwable $e) {

            DB::rollback();
            $request->session()->flash('alert-error', 'Error: Intente nuevamente');
            return redirect('menu/add/'.$menu->id);

        }catch (\ModelNotFoundException $exception) {

            DB::rollback();
            $request->session()->flash('alert-error', 'Error: Intente nuevamente');
            return redirect('menu/add/'.$menu->id);

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
    public function edit(SubMenu $submenu)
    {
        $data['submenu'] = $submenu;
        return view('config.submenu.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SubMenuUpdateRequest $request, SubMenu $submenu)
    {
        DB::beginTransaction();
 
        try {
            // recuperamos el menu
            $menu                   = Menu::find($request->id_menu);

            $submenu->title         = $request->titulo;
            $submenu->description   = $request->descripcion;
            $submenu->url           = $request->url;
            $submenu->icon          = $request->icono;
            $submenu->type          = $request->tipo;
            $submenu->id_menu       = $request->id_menu;
            $submenu->order         = $request->orden;
            $submenu->save();
    
            DB::commit();

            $request->session()->flash('alert-success', 'Registro ingresado exitosamente');
            return redirect('menu/add/'.$menu->id);

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
    public function destroy(SubMenu $submenu)
    {
        DB::beginTransaction();
 
        try {
            $submenu->delete();
    
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

    public function anular(SubMenu $submenu)
    {
        DB::beginTransaction();
 
        try {
            $submenu->status = 0;
            $submenu->save();
    
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

    public function activar(SubMenu $submenu)
    {
        DB::beginTransaction();
 
        try {
            $submenu->status = 1;
            $submenu->save();
    
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
