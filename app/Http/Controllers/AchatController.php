<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Achat;
use App\Produit;
use App\Fournisseur;

class AchatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ajouter()
    {
        $fournisseurs = Fournisseur::all();
        return view('achats.ajouter', ['fournisseurs' => $fournisseurs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function inserer(Request $request)
    {
        Achat::create([
            'fournisseur_id' => $request->input('fournisseur'),
            'produit_id' => $request->input('produit'),
            'quantite'   => $request->input('quantite'),
            'prix_achat'   => $request->input('prix_achat'),
            'statut'     => 'terminé',
        ]);

        $produit = Produit::find($request->input('produit'));
        $produit->quantite = $produit->quantite + $request->input('quantite');
        $produit->nbr_colis = $produit->quantite / $produit->colis;
        $produit->prix_achat = $request->input('prix_achat');
        $produit->save();

        return redirect('ajouter/achat')->with('status', 'Achat bien ajouter');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function voire()
    {
        $achats = Achat::all();
        return view('achats.voire', ['achats' => $achats]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
