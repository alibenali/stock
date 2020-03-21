<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pourcentage;
use App\Famille;

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
        $familles = Famille::where('statut', 'activé')->get();
        $pourcentages = Pourcentage::where('statut', 'activé')->get();
        return view('home', ['pourcentages' => $pourcentages, 'familles' => $familles]);
    }
}
