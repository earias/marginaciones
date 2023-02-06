<?php

namespace App\Http\Controllers;

use DB;
use App\User;
use App\Models\Rol;
use App\Models\Style;
use App\models\UserRol;
use App\Models\StyleMenu;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdatePassRequest;
use App\Http\Requests\UpdateAvatarRequest;
use App\Http\Requests\UpdatePerfilRequest;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['users'] = User::paginate(1);
        return view('config.user.index',$data);
    }

    public function find(Request $request)
    {
        $data['users'] = User::Search($request->search)->orderBy('created_at','DESC')->paginate(5);
        return view('config.user.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['roles'] = Rol::where('status',1)->pluck('title','id');
        // return $data;
        return view('config.user.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        DB::beginTransaction();
 
        try {
            $user           = new User();
            $user->name     = $request->name;
            $user->email    = $request->email;
            $user->id_rol   = $request->rol;
            $user->password = Hash::make($request->password);
            $user->save();

            if (count($request->roles)) {
                setRoles($request->roles, $user->id);
            }
    
            DB::commit();

            $request->session()->flash('alert-success', 'Registro Ingresado Exitosamente');
            return redirect('usuario');

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
    public function show()
    {
        $data['styles']         = Style::pluck('title','id_style');
        $data['styles_menu']    = StyleMenu::all('title','id_style_menu','sub');
        return view('config.user.perfil',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {

        if( auth()->user()->id_rol ==1){
        $data['user']   = $user;
        $data['roles']  = Rol::where('status',1)->pluck('title','id');
        $data['lista']  = UserRol::where('id',$user->id)->pluck('id_rol');
        return view('config.user.edit',$data);
        }else{
            return "NO";
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,User $user)
    {
        DB::beginTransaction();
 
        try {
            
            $user->name     = $request->name;
            $user->email    = $request->email;
            $user->id_rol   = $request->rol;
            $user->save();

            if (count($request->roles)) {
                deleteRoles($user->id);
                setRoles($request->roles, $user->id);
            }
    
            DB::commit();

            $request->session()->flash('alert-success', 'Registro Actualizado Exitosamente');
            return redirect('usuario');

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

    public function update_avatar(UpdateAvatarRequest $request, $id)
    {
        $user = User::find($id);

        if($request->hasFile('avatar')){
            $slug           = substr(strtoupper(sha1(time())),0,6);
            $name           = $slug.'.'.$request->avatar->getClientOriginalExtension();
            $request->file('avatar')->move(public_path().'/img/avatar', $name);
            $user->avatar   = $name;
        }

        $user->save();

        $request->session()->flash('alert-success', 'Has cambiado tu foto de perfil');
        return redirect()->back();
    }

    public function update_perfil(UpdatePerfilRequest $request, $id)
    {
        $user                   = User::find($id);
        $user->name             = $request->nombre;
        $user->id_style         = $request->style;
        $user->id_style_menu    = $request->color;
        $user->save();

        $request->session()->flash('alert-success', 'Su configuración ha sido actualizada');
        return redirect()->back();
    }

    public function update_pass(UpdatePassRequest $request)
    {

        $user = User::find(Auth()->user()->id);

        if (!Hash::check($request->present_password, $user->password)) {
            $request->session()->flash('alert-error', 'Revisa la información ingresada');
            return redirect()->back()->withErrors(['present_password' => 'Contraseña incorrecta'])->withInput($request->input());
        }

        $user->password = Hash::make($request->password);
        $user->save();

        $request->session()->flash('alert-success', 'La contraseña se ha cambiado exitosamente, cierra sesión e ingresa nuevamente');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        DB::beginTransaction();
 
        try {
            deleteRoles($user->id);
            $user->delete();
    
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

    public function anular(User $user)
    {
        DB::beginTransaction();
 
        try {
            $user->status   = 0;
            $user->save();
    
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

    public function activar(User $user)
    {
        DB::beginTransaction();
 
        try {
            $user->status   = 1;
            $user->save();
    
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


    function register(Request $req)
    {
        $name = $req->input('name');
        $email = $req->input('email');
        $password = Hash::make($req->input('password'));
        DB::table('users')->insert([
            'name' =>   $name,
            'email' =>  $email ,
            'password'=> $password
          ]);
    }

    
    function login(Request $req)
    {
        $email =  $req->input('email');
        $password = $req->input('password');
 
        $user = DB::table('users')->where('email',$email)->first();
        if(!Hash::check($password, $user->password))
        {
            echo "Not Matched";
        }
        else
        {
            //$user = DB::table('users')->where('email',$email)->first();
           echo $user->email;
        }
    }
}
