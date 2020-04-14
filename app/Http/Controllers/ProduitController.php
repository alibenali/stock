<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produit;
use App\Fournisseur;
use App\Famille;
use App\Achat;
use App\Pourcentage;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    public function fetch(Request $request)
    {
        $recherche = $request->input('searchInputValue');
        $famille = $request->input('famille');
 
        $list = Produit::where('designation', 'like' , '%'.$recherche.'%')->join('familles', function ($join) use($famille) {
            $join->on('familles.id', '=', 'produits.famille_id')
                 ->where('familles.nom', 'like', '%'.$famille.'%');
        });
        
         
        $NumberOfProducts = count($list->get()); 
        if($NumberOfProducts == 0){
            $recherche = explode(' ', $recherche);
            $list = Produit::Where(function ($query) use($recherche, $famille) {
                for ($i = 0; $i < count($recherche); $i++){
                   $query->where('designation', 'like',  '%' . $recherche[$i] .'%');
                   $query->Orwhere('familles.nom', 'like',  '%' . $recherche[$i] .'%');
                   
                }
           })->join('familles', function ($join) use($famille) {
            $join->on('familles.id', '=', 'produits.famille_id')
                 ->where('familles.nom', 'like', '%'.$famille.'%');
        })->limit(1000);
                
    }
        
        $NumberOfProducts = count($list->get()); 
        
        if($NumberOfProducts == 0){
            $list = Produit::join('familles', function ($join) use($famille) {
                $join->on('familles.id', '=', 'produits.famille_id')
                     ->where('familles.nom', 'like', '%'.$famille.'%');
            })->Orwhere(function ($query) use($recherche, $famille) {
                for ($i = 0; $i < count($recherche); $i++){
                   $query->Orwhere('produits.id', 'like',  '%' . $recherche[$i] .'%');
                   $query->Orwhere('quantite', 'like',  '%' . $recherche[$i] .'%');
                }
           })->limit(1000);
            
        }
        
        $list = $list->select('produits.id As id', 'produits.*', 'familles.nom')->get();

        
        $pourcentage = Pourcentage::find($request->input('pourcentage_pour'));

        return view('produits.tableau', ['list' => $list, 'pourcentage' => $pourcentage]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ajouter()
    {
        $familles = Famille::where('statut', 'activé')->get();
        return view('produits.ajouter', ['fournisseurs' => Fournisseur::all(), 'familles' => $familles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function inserer(Request $request)
    {
        $produit = Produit::create([
            'fournisseur_id' => $request->input('fournisseur'),
            'famille_id' => $request->input('famille'),
            'designation' => $request->input('designation'),
            'quantite' => $request->input('quantite'),
            'colis' => $request->input('colis'),
            'nbr_colis' => $request->input('nbr_colis'),
            'prix_achat' => $request->input('prix_achat'),
        ]);

        Achat::create([
            'fournisseur_id' => $request->input('fournisseur'),
            'produit_id' => $produit->id,
            'quantite'   => $request->input('quantite'),
            'prix_achat'   => $request->input('prix_achat'),
            'statut'     => 'terminé',
        ]);

        return redirect('ajouter/produit')->with('status','Produit ajouté');;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function voire_tous()
    {
        $produits = Produit::all();
        return view('produits.voire_tous', ['produits' => $produits]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function modifier($id)
    {
        $produit = Produit::find($id);
        $familles = Famille::where('statut', 'activé')->get();
        return view('produits.modifier', ['produit' => $produit,'fournisseurs' => Fournisseur::all(), 'familles' => $familles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function maj(Request $request, $id)
    {
        Produit::find($id)->update($request->all());
        return redirect('modifier/produit/'.$id)->with('status', 'Produit a été bien modifier');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function voire($id)
    {
        $produit = Produit::find($id);
        $familles = Famille::where('statut', 'activé')->get();
        return view('produits.voire', ['produit' => $produit,'fournisseurs' => Fournisseur::all(), 'familles' => $familles]);
    }
}
