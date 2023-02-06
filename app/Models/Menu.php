<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
   	protected $table = "menu";

    protected $fillable = ['title','description','url','icon','order','status','created_at','updated_at'];


    public function cont_submenu(){
    	return $this->hasMany('App\Models\SubMenu','id_menu','id')->count();
    }

    public function scopeSearch($query,$search){
        return $query->where('title','like','%'.$search.'%')->orWhere('description','like','%'.$search.'%')->orWhere('url','like','%'.$search.'%');
    }

    public function status(){
        if ($this->status == 1) {
            return '<p class="text-success" id="'.$this->id.'">Activo</p>';
        }else{
            return '<p class="text-danger" id="'.$this->id.'">Inactivo</p>';
        }
    }

    public function actions(){
        $acciones = '<div class="dropdown">
                        <span class="bx bx-dots-vertical-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu"></span>
                                <div class="dropdown-menu dropdown-menu-right" id="items">';

        if ($this->status == 1) {
        	$acciones .= '<a class="dropdown-item" href="/menu/add/'.$this->id.'">
                            <i class="bx bx-list-ul mr-1"></i>Submenu
                        </a>';
        }
    	// verificamos que tenga el permiso de editar 
    	if (auth()->user()->rol->edit == 1) {
    		$acciones .= '<a class="dropdown-item"  href="/menu/edit/'.$this->id.'">
                            <i class="bx bx-edit-alt mr-1" ></i>Editar
                        </a>';
    	}
        // codigo para anular o activar el registro
        // si tiene procedemos a verificar en que estado esta para anular o activar el registro
        if ($this->status == 1) {
            $acciones .= '<a class="dropdown-item action-'.$this->id.'" href="#" id="2" data-id="'.$this->id.'">
                            <i class="bx bx-block mr-1"></i><span id="text_'.$this->id.'"> Anular </span>
                        </a>';
        }else{
            $acciones .= '<a class="dropdown-item action-'.$this->id.'" href="#" id="3" data-id="'.$this->id.'">
                            <i class="bx bx-check-circle mr-1" ></i><span id="text_'.$this->id.'"> Activar </span>
                        </a>';
        }

        // verificamos que tenga el permisos de eliminar
    	if (auth()->user()->rol->delete == 1) {
    		// con esta condicion verificamos si tiene submenu asignados

    		if (!$this->cont_submenu()) {
    			// si no seteamos el boton de eliminar
    			$acciones .= '<a class="dropdown-item action-'.$this->id.'" href="#" id="4" data-id="'.$this->id.'">
                                <i class="bx bx-trash mr-1"></i>Eliminar
                            </a>';
    		}
    	}

    	$acciones .= ' </div>
                    </div>';

    	return $acciones;
    }

}
