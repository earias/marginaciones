<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Rol;
use Illuminate\Http\Request;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['users_count'] = User::count();
        $data['roles_count'] = Rol::count();
        return view('home',$data);
    }
}
