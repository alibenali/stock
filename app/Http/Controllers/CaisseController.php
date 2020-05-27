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
        $objectifs = Caisse::select('objectif')->selectRaw('count(objectif) as objectifs')->groupBy('objectif')->orderBy('objectifs', 'desc');

        return view('caisse.ajouter', ['objectifs' => $objectifs]);
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
        $montant = $request->input('montant');

        $caisse = 0;
		foreach ($ventes as $vente) {
            $caisse = $caisse + $vente->prix_total;
        }

        foreach ($transitions as $transition) {
            if($transition->type == 'revenue'){
                $caisse = ceil($caisse + $montant);
            }else{
                $caisse = ceil($caisse - $montant);
            }
        }

        if($request->input('type') == 'depense'){
            $caisse_apres = $caisse - $montant;
        }else{
            $caisse_apres = $caisse + $montant;
        }

        Caisse::create([
            'objectif' => $request->input('objectif'),
            'type' => $request->input('type'),
            'montant' => $request->input('montant'),
            'responsable_id' => Auth::id(),
            'caisse_avant' => $caisse,
            'caisse_apres' => $caisse_apres,
        ]);

        return redirect('voire/caisse')->with('status', 'Caisse a été mis a jour');
    }

    public function voire()
    {
        $transitions = Caisse::all();
        $ventes = Vente::where('statut','vendu')->get();
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
