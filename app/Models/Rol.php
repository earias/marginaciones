<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'rol';

    protected $fillable = ['title','show','create','edit','cancel','delete','description','status','created_at','updated_at'];

    public function scopeSearch($query,$search){
        return $query->where('title','like','%'.$search.'%');
    }

    public function asignaciones(){
        return $this->hasMany('App\Models\RolAccesos','id_rol','id');
    }

    public function estado(){
        if ($this->status == 1) {
            return '<p class="text-success">Activo</p>';
        }else{
            return '<p class="text-danger">Inactivo</p>';
        }
    }

    public function cont_asign_user(){
        return $this->hasMany('App\Models\UserRol','id_rol','id')->count();
    }

    public function cont_asign_accesos(){
        return $this->hasMany('App\Models\RolAccesos','id_rol','id')->count();
    }

    public function acciones(){
        $acciones = '<div class="dropdown">
                        <span class="bx bx-dots-vertical-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu"></span>
                                <div class="dropdown-menu dropdown-menu-right" id="items">';

        // verificamos que tenga el permiso de editar 
        if (auth()->user()->rol->edit == 1) {
            $acciones .= '<a class="dropdown-item" href="/rol/edit/'.$this->id.'">
                            <i class="bx bx-edit-alt mr-1" ></i>Editar
                        </a>';
        }
        // codigo para anular o activar el registro
        // si tiene procedemos a verificar en que estado esta para anular o activar el registro
        if ($this->status == 1) {
            $acciones .= '<a class="dropdown-item" href="#" href="#" id="2" data-id="'.$this->id.'">
                            <i class="bx bx-block mr-1" ></i>Anular
                        </a>';
        }else{
            $acciones .= '<a class="dropdown-item" href="#" href="#" id="3" data-id="'.$this->id.'">
                            <i class="bx bx-check-circle mr-1" ></i>Activar
                        </a>';
        }

        // verificamos que tenga el permisos de eliminar
        if (auth()->user()->rol->delete == 1) {
            // con esta condicion verificamos si tiene submenu asignados

            if (!$this->cont_asign_user()) {
                // si no seteamos el boton de eliminar
                $acciones .= '<a class="dropdown-item" href="#" href="#" id="4" data-id="'.$this->id.'">
                                <i class="bx bx-trash mr-1"></i>Eliminar
                            </a>';
            }
        }

        $acciones .= ' </div>
                    </div>';

        return $acciones;
    }

    public function permisos(){

    	$permisos = '<div class="btn-group  btn-group-xs permisos">';

        if ($this->create == 1) {
            $permisos .= '<button class="btn btn-success" type="button" data-toggle="tooltip" data-placement="top" title="" data-original-title="Crear">C</button>';
        }

    	if ($this->show == 1) {
    		$permisos .= '<button class="btn btn-dark" type="button" data-toggle="tooltip" data-placement="top" title="" data-original-title="Leer">L</button>';
    	}

    	if ($this->edit == 1) {
    		$permisos .= '<button class="btn btn-warning" type="button" data-toggle="tooltip" data-placement="top" title="" data-original-title="Modificar">M</button>';
    	}
        
    	if ($this->delete == 1) {
    		$permisos .= '<button class="btn btn-danger" type="button" data-toggle="tooltip" data-placement="top" title="" data-original-title="Eliminar">E</button>';
    	}

    	$permisos .= '</div>';

    	return $permisos;
    }

}
