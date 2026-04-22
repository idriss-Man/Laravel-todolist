<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){

        $title = config('app.name'); // Récupérer le nom de l'application
        $items = Item :: where('user_id',auth()->id())->get();
        return view('dashboard.index', compact('title', 'items'));

    }
}
