<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CaisseFamille;

class CaisseFamilleController extends Controller
{
    public function ajouter(){
		return view('caisseFamille.ajouter');
    }

    public function inserer(Request $request){

    	$caisseFamille = new CaisseFamille;
    	$caisseFamille->nom = $request->input('nom');
    	$caisseFamille->totale = 0;
    	$caisseFamille->statut = 'active';

    	$caisseFamille->save();

		return redirect('voire/caisse');
    }
}
