<?php

namespace App;

use App\Models\UserRol;
use App\Models\RolAccesos;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','id_rol','id_style','status','id_style_menu', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeSearch($query,$search){
        return $query->where('name','like','%'.$search.'%')->orWhere('email','like','%'.$search.'%');
    }

    public function rol()
    {
        return $this->hasOne('App\Models\Rol','id','id_rol');
    }

    public function style()
    {
        return $this->hasOne('App\Models\Style','id_style','id_style');
    }

    public function style_menu()
    {
        return $this->hasOne('App\Models\StyleMenu','id_style_menu','id_style_menu');
    }

    public function roles()
    {
        return $this->hasMany('App\Models\UserRol','id_rol','id_rol');
    }

    public function cont_roles()
    {
        return $this->hasMany('App\Models\UserRol','id_rol','id_rol')->count();
    }

    // utilizado para validar la entrada en el middleware
    public function accesosRol()
    {
        $menu = RolAccesos::select('sub_menu.id_menu','sub_menu.title','sub_menu.url','sub_menu.icon')
                            ->join('sub_menu','sub_menu.id','rol_accesos.id_submenu')
                            ->whereIn('rol_accesos.id_rol',$this->rolesPluck())
                            ->groupBy('sub_menu.id')
                            ->get();

        return $menu;
    }

    public function rolesPluck()
    {
        return $this->hasMany('App\Models\UserRol','id_user','id')->where('id_user',$this->id)->pluck('id_rol');
    }

    public function status(){
        if ($this->status == 1) {
            return '<p class="text-success">Activo</p>';
        }else{
            return '<p class="text-danger">Inactivo</p>';
        }
    }

    public function actions(){
        $acciones = '<div class="dropdown">
                        <span class="bx bx-dots-vertical-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu"></span>
                                <div class="dropdown-menu dropdown-menu-right" id="items">';

        // verificamos que tenga el permiso de editar 
        if (auth()->user()->rol->edit == 1) {
            $acciones .= '<a class="dropdown-item" href="usuario/edit/'.$this->id.'">
                            <i class="bx bx-edit-alt mr-1" ></i>Editar
                        </a>';
        }
        // codigo para anular o activar el registro
        // si tiene procedemos a verificar en que estado esta para anular o activar el registro
        if ($this->status == 1) {
            $acciones .= '<a class="dropdown-item" href="#" id="2" data-id="'.$this->id.'">
                            <i class="bx bx-block mr-1" ></i>Anular
                        </a>';
        }else{
            $acciones .= '<a class="dropdown-item" href="#" id="3" data-id="'.$this->id.'">
                            <i class="bx bx-check-circle mr-1" ></i>Activar
                        </a>';
        }

        // verificamos que tenga el permisos de eliminar
        if (auth()->user()->rol->delete == 1) {
            // con esta condicion verificamos si tiene submenu asignados

            if (!$this->cont_roles()) {
                // si no seteamos el boton de eliminar
                $acciones .= '<a class="dropdown-item" href="#" id="4" data-id="'.$this->id.'">
                                <i class="bx bx-trash mr-1"></i>Eliminar
                            </a>';
            }
        }

        $acciones .= ' </div>
                    </div>';

        return $acciones;
    }
}
