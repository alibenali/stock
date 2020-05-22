<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Caisse;
use App\Vente;
use Auth;

class CaisseController extends Controller
{


    
    public function ajouter()
    {
        return view('caisse.ajouter');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function inserer(Request $request)
    {

    	$transitions = Caisse::all();
        $ventes = Vente::all();

		$caisse =  $transitions->sum('caisse.montant') + $ventes->sum('ventes.prix_totale');

        Caisse::create([
            'objectif' => $request->input('objectif'),
            'type' => $request->input('type'),
            'montant' => $request->input('montant'),
            'responsable_id' => Auth::id(),
            'caisse_avant' => $caisse,
            'caisse_apres' => $caisse + $request->input('montant'),
        ]);

        return redirect('voire/caisse')->with('status', 'Caisse a été mis a jour');
    }

    public function voire()
    {
        $transitions = Caisse::all();
        $ventes = Vente::all();
		$caisse =  0;

		foreach ($ventes as $vente) {
			$caisse = $caisse + $vente->prix_total;
		}

		foreach ($transitions as $transition) {
			if($transition->type == 'revenue'){
				$caisse = ceil($caisse + $transition->montant);
			}else{
				$caisse = ceil($caisse - $transition->montant);
			}
		}

        return view('caisse.voire', ['transitions' => $transitions, 'caisse' => $caisse]);
    }


}
