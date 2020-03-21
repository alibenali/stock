<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Famille;

class FamilleController extends Controller
{

    
    public function ajouter()
    {
        return view('familles.ajouter');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function inserer(Request $request)
    {
        Famille::create([
            'nom' => $request->input('nom'),
            'statut' => 'activé',
        ]);

        return redirect('voire/familles')->with('status', 'Famille a été créé');
    }

    public function voire()
    {
        $familles = Famille::all();
        return view('familles.voire', ['familles' => $familles]);
    }

    public function desactiver($id)
    {
        $famille = Famille::find($id);
        $famille->statut = 'desactivé';
        $famille->save();

        return redirect('voire/familles')->with('status', 'Famille a été desactivé');
    }

    public function activer($id)
    {
        $famille = Famille::find($id);
        $famille->statut = 'activé';
        $famille->save();

        return redirect('voire/familles')->with('status', 'Famille a été activé');
    }
}
