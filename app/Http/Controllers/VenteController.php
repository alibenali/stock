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
        
        $random = rand(9999999999,9999999999999999);
        Vente::where('statut', 'panier')->update(['statut' => 'vendu', 'bon_id' => $random]);
        
        return view('ventes.bon', ['ventes' => $ventes, 'bon' =>$random]);
        
    }

    public function verssement(Request $request)
    {
        $ventes = Vente::where('statut', 'panier')->get();
        foreach($ventes as $vente){
            $produit = Produit::find($vente->produit_id);
            //$produit->quantite = $produit->quantite - $vente->quantite;
            //$produit->nbr_colis = $produit->quantite / $produit->colis;
            if($produit->nbr_colis != $produit->quantite){
                //$produit->nbr_colis = $produit->quantite / $produit->colis;
            }
            $produit->save();
        }
        
        $random = rand(9999999999,9999999999999999);
        $verssement = ceil($request->input('montant') / $ventes->count());

        Vente::where('statut', 'panier')->update(['statut' => 'verssement', 'bon_id' => $random, 'verssement' => $verssement, 'bon_id' => $random]);
                
        $verssement = Vente::whereBetween('bon_id', [$random-5, $random+5])->sum('ventes.verssement');
        return view('ventes.bon', ['ventes' => $ventes, 'prefacturation' => true, 'verssement' => $verssement, 'bon' => $random]);
        
    }

    public function ajouter_verssement(Request $request,$bon_id){
        $ventes = Vente::where('bon_id', $bon_id)->where('statut', 'verssement')->get();
        $verssement = ceil($request->input('montant') / $ventes->count());
        foreach($ventes as $vente){
            $nouveauVerssement = $vente->replicate();
            $nouveauVerssement->verssement = $verssement;
            $nouveauVerssement->bon_id = $nouveauVerssement->bon_id+1;
            $nouveauVerssement->save();

        }
        $min = $vente->bon_id - 5;
        $max = $vente->bon_id + 5;
        $verssement = Vente::whereBetween('bon_id', [$min, $max])->sum('ventes.verssement');
        $prix_total = Vente::where('bon_id', $bon_id)->sum('ventes.prix_total');
        if($verssement == $prix_total){
            Vente::whereBetween('bon_id', [$min, $max])->update(['statut' => 'verssement terminé']);
            $ventes = Vente::where('bon_id', $bon_id)->get();
            foreach($ventes as $vente){
                $produit = Produit::find($vente->produit_id);
                $produit->quantite = $produit->quantite - $vente->quantite;
                $produit->nbr_colis = $produit->quantite / $produit->colis;
                if($produit->nbr_colis != $produit->quantite){
                    $produit->nbr_colis = $produit->quantite / $produit->colis;
                }
                $produit->save();
        }
        }
        $verssement = Vente::whereBetween('bon_id', [$bon_id-5, $bon_id+5])->sum('ventes.verssement');
        return view('ventes.bon', ['ventes' => $ventes, 'prefacturation' => true, 'verssement' => $verssement, 'bon' => $bon_id+1]);
    }

    public function imprimer_panier(){

        $ventes = Vente::where('statut', 'panier')->get();
        $random = rand(9999999999,9999999999999999);
        Vente::where('statut', 'panier')->update(['statut' => 'pre facturation', 'bon_id' => $random]);
        return view('ventes.bon', ['ventes' => $ventes, 'prefacturation' => true, 'bon' => $random]);
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
        $Todayventes = Vente::whereDate('created_at', Carbon::today())->where('statut', 'vendu')->get();
        $TodayVerssement = Vente::whereDate('created_at', Carbon::today())->where(function($query) {
                $query->where('statut', 'verssement')
                      ->Orwhere('statut', 'verssement terminé');
            })->get();

        $total = $Todayventes->sum('prix_total');
        $totalVerssement = $TodayVerssement->sum('verssement');

        return view('ventes.voire', ['ventes'=> $ventes,'total'=>$total, 'totalVerssement' => $totalVerssement]);
    }

    public function panier()
    {
        $ventes = Vente::where('statut', 'panier')->get();
        return view('ventes.panier', ['ventes'=> $ventes]);
    }



    public function panier_bon($bon_id)
    {
        $ventes = Vente::where('bon_id', $bon_id)->where('statut', 'verssement')->get();
        $min = $bon_id-5;
        $verssement = Vente::whereBetween('bon_id', [$min, $bon_id+5])->where('statut', 'verssement')->sum('ventes.verssement');
        return view('ventes.panier_verssement', ['ventes'=> $ventes, 'bon_id'=> $bon_id, 'total_verse' =>$verssement]);
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
        $min = $vente->bon_id - 5;
        $max = $vente->bon_id + 5;

        if($vente->statut == 'vendu' OR $vente->statut == 'verssement terminé'){
            $produit = Produit::find($vente->produit_id);
            $produit->quantite = $produit->quantite + $vente->quantite;
            $produit->nbr_colis = $produit->quantite / $produit->colis;
            $produit->save(); 
            $vente->statut = 'Annulé';
            $vente->save();

            Vente::whereBetween('bon_id', [$min, $max])->update(['statut' => 'Annulé']);

        }elseif($vente->statut == 'verssement'){
            $produit = Produit::find($vente->produit_id);
            $vente->statut = 'Annulé';
            $vente->save();
        }

        return redirect('voire/ventes')->with('status', 'Vente annulé');
    }


    public function annuler_panier($id)
    {
        $vente = Vente::find($id);
        $vente->statut = 'Annulé';
        $vente->save();

        return redirect('ventes/panier')->with('status', 'Vente annulé');
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
