<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Casse;
use App\Produit;
use Auth;

class CasseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ajouter($produit_id)
    {
        return view('casses.ajouter', ['produit_id' => $produit_id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function inserer(Request $request)
    {
        Casse::create([
            'produit_id' => $request->input('produit'),
            'utilisateur_id' => Auth::id(),
            'quantite' => $request->input('quantite'),
            'observation' => $request->input('observation'),
            'statut'    => 'cassé',

        ]);

        $produit = Produit::find($request->input('produit'));
        $produit->quantite = $produit->quantite - $request->input('quantite');
        $produit->nbr_colis = $produit->quantite / $produit->colis;
        $produit->prix_achat = $produit->prix_achat + ($produit->prix_achat/$produit->quantite);
        $produit->save();

        return redirect('voire/casses')->with('status', 'Casse a été créé');

    }


    public function voire()
    {
        $casses = Casse::all();
        return view('casses.voire', ['casses' => $casses]);
    }

    
    
    public function annuler($id)
    {
        $casse = Casse::find($id);

        $produit = Produit::find($casse->produit_id);
        $produit->quantite = $produit->quantite + $casse->quantite;
        $produit->nbr_colis = $produit->quantite / $produit->colis;
        $produit->save(); 
        $casse->statut = 'Annulé';
        $casse->save();

        return redirect('voire/casses')->with('status', 'Casse annulé');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
