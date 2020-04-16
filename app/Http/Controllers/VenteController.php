<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vente;
use App\Produit;
use App\Pourcentage;
use Auth;
use Carbon\carbon;

class VenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ajouter($id, $pourcentage)
    {
        $produit = Produit::find($id);
        $pourcentages = Pourcentage::all();
        $pourcentage = Pourcentage::find($pourcentage);
        return view('ventes.ajouter', ['produit' => $produit, 'pourcentages' => $pourcentages, 'pourcentage' => $pourcentage]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function inserer(Request $request ,$id, $pourcentage)
    {
        $prix_unite = ceil(ceil($request->input('prix_unite'))/10)*10;
        $prix_total = $prix_unite * $request->input('new_quantite');
        $prix_total = ceil(ceil($prix_total)/10)*10;

        Vente::create([
            'produit_id' => $id,
            'quantite' => $request->input('new_quantite'),
            'nbr_boites' => $request->input('nbr_boites'),
            'prix_unite' => $prix_unite,
            'prix_total' => $prix_total,
            'nom_acheteur' => $request->input('nom_acheteur'),
            'vendeur_id' => Auth::id(),
            'statut' => 'panier',
        ]);
        /*
        $produit = Produit::find($id);
        $produit->quantite = $produit->quantite - $request->input('new_quantite');
        $produit->nbr_colis = $produit->quantite / $produit->colis;
        if($produit->nbr_colis != $produit->quantite){
            $produit->nbr_colis = $produit->quantite / $produit->colis;
        }
        $produit->save();
        */

        return redirect('ventes/panier');
        
        }

    public function valider_tous()
    {
        $ventes = Vente::where('statut', 'panier')->get();
        foreach($ventes as $vente){
            $produit = Produit::find($vente->produit_id);
            $produit->quantite = $produit->quantite - $vente->quantite;
            $produit->nbr_colis = $produit->quantite / $produit->colis;
            if($produit->nbr_colis != $produit->quantite){
                $produit->nbr_colis = $produit->quantite / $produit->colis;
            }
            $produit->save();
        }
        

        Vente::where('statut', 'panier')->update(['statut' => 'vendu']);
        
        return view('ventes.bon', ['ventes' => $ventes]);
        
    }

    public function valider($id)
    {
        $vente = Vente::find($id);
        
        $produit = Produit::find($vente->produit_id);
        $produit->quantite = $produit->quantite - $vente->quantite;
        $produit->nbr_colis = $produit->quantite / $produit->colis;
        if($produit->nbr_colis != $produit->quantite){
        $produit->nbr_colis = $produit->quantite / $produit->colis;
        }
        $produit->save();

        Vente::find($id)->update(['statut' => 'vendu']);
        
        return redirect('ventes/panier');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function voire()
    {
        $ventes = Vente::all();
        $Todayventes = Vente::whereDate('created_at', Carbon::today())->get();
        $total = $Todayventes->sum('prix_total');

        return view('ventes.voire', ['ventes'=> $ventes,'total'=>$total]);
    }

    public function panier()
    {
        $ventes = Vente::where('statut', 'panier')->get();
        return view('ventes.panier', ['ventes'=> $ventes]);
    }

    public function bon()
    {
        return view('ventes.bon');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function annuler($id)
    {
        $vente = Vente::find($id);

        $produit = Produit::find($vente->produit_id);
        $produit->quantite = $produit->quantite + $vente->quantite;
        $produit->nbr_colis = $produit->quantite / $produit->colis;
        $produit->save(); 
        $vente->statut = 'Annulé';
        $vente->save();

        return redirect('voire/ventes')->with('status', 'Vente annulé');
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
