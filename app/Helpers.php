<?php 

use App\Models\Menu;
use App\Models\SubMenu;
use App\Models\UserRol;
use App\Models\RolAccesos;

function lista_menu()
{
	$items = Menu::all();
	return $items;
}

function lista_submenu()
{
	$items = SubMenu::where('type',1)->all();
	return $items;
}

function user_menu(){
	return RolAccesos::select('sub_menu.id_menu','menu.title','menu.icon')
							->join('sub_menu','sub_menu.id','rol_accesos.id_submenu')
							->join('menu','menu.id','sub_menu.id_menu')
							->whereIn('sub_menu.type',[1])
							->whereIn('id_rol',auth()->user()->rolesPluck())
							->groupBy('sub_menu.id_menu')->get();
}

function user_submenu(){
	return RolAccesos::select('sub_menu.id','sub_menu.id_menu','sub_menu.title','sub_menu.url','sub_menu.icon')
                            ->join('sub_menu','sub_menu.id','rol_accesos.id_submenu')
                            ->whereIn('sub_menu.type',[1])
                            ->whereIn('id_rol',auth()->user()->rolesPluck())
                            ->groupBy('sub_menu.id')->get();
}

// funcion para insertar los accesos del usuario
function setRoles($roles, $id_user){
	foreach ($roles as $value) {
		$new_rol 			= new UserRol();
		$new_rol->id_user   = $id_user;
		$new_rol->id_rol 	= $value;
		$new_rol->save();
	}
}

function setAccesos($accesos, $id_rol){
	foreach ($accesos as $value) {
		$new_rol 				= new RolAccesos();
		$new_rol->id_rol 		= $id_rol;
		$new_rol->id_submenu 	= $value;
		$new_rol->save();
	}
}

// funcion para eliminar los roles del usuario
function deleteRoles($id_user){

	$roles = UserRol::where('id_user',$id_user)->get();

	foreach ($roles as $value) {
		$new_rol = UserRol::find($value->id);
		$new_rol->delete();
	}
}

function deleteAccesos($id_rol){

	$roles = RolAccesos::where('id_rol',$id_rol)->get();

	foreach ($roles as $value) {
		$new_rol = RolAccesos::find($value->id);
		$new_rol->delete();
	}
}