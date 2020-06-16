<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Caisse;
use App\CaisseFamille;
use App\Vente;
use Auth;

class CaisseController extends Controller
{


    
    public function ajouter($id=0)
    {
        $familles = CaisseFamille::all();

        return view('caisse.ajouter', ['familles'=>$familles,'id'=>$id]);
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
        $famille = CaisseFamille::where('id', $request->input('famille'))->first();
        $famille_totale = $famille->totale;

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
            $famille_totale = ceil($famille_totale - $montant);

        }else{
            $caisse_apres = $caisse + $montant;
            $famille_totale = ceil($famille_totale + $montant);
        }

        Caisse::create([
            'famille_id' => $request->input('famille'),
            'objectif' => $request->input('objectif'),
            'type' => $request->input('type'),
            'montant' => $request->input('montant'),
            'responsable_id' => Auth::id(),
            'caisse_avant' => $caisse,
            'caisse_apres' => $caisse_apres,
        ]);

        $famille->totale = $famille_totale;
        $famille->save();

        return redirect('voire/caisse')->with('status', 'Caisse a été mis a jour');
    }

    public function voireTransitions($famille)
    {
        $transitions = Caisse::where('famille_id',$famille)->get();
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

        return view('caisse.voireTransitions', ['transitions' => $transitions, 'caisse' => $caisse]);
    }

    public function voire()
    {
        $familles = CaisseFamille::all();
        $transitions = Caisse::all();
        $ventes = Vente::where('statut','vendu')->get();
        $verssements = Vente::where('statut','verssement')->orWhere('statut', 'verssement terminé')->get();
        $caisse =  0;

        foreach ($ventes as $vente) {
            $caisse = $caisse + $vente->prix_total;
        }

        foreach ($verssements as $verssement) {
            $caisse = $caisse + $verssement->verssement;
        }

        foreach ($transitions as $transition) {
            if($transition->type == 'revenue'){
                $caisse = ceil($caisse + $transition->montant);
            }else{
                $caisse = ceil($caisse - $transition->montant);
            }
        }
        return view('caisse.voire', ['familles' => $familles, 'caisse' => $caisse]);
    }


}
