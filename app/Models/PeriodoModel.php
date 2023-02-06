<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeriodoModel extends Model
{
    protected $fillable = [
        'name', 'description','status',
    ];




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
