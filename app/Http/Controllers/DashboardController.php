<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    public function index(){

        $title = config('app.name'); // Récupérer le nom de l'application
        $items = Item :: where('user_id',auth()->id())->get();
        $roles=auth()->user()->getRoleNames();


        return view('dashboard.index', compact('title', 'items', 'roles'));

    }

    public function manager(){
        $title = config('app.name');

        $roles=auth()->user()->getRoleNames();
        $users=User::all();
        return view('dashboard.manager', compact('title', 'roles','users'));
    }
}
