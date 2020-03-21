<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fournisseur;
class FournisseurController extends Controller
{


    public function voire()
    {
        $fournisseurs = Fournisseur::all();
        return view('fournisseurs.voire', ['fournisseurs' => $fournisseurs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ajouter()
    {
        return view('fournisseurs.ajouter');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function inserer(Request $request)
    {
        Fournisseur::create([
            'nom_complet' => $request->input('nom_complet'),
            'contacte' => $request->input('contacte'), 
        ]);

        return redirect('voire/fournisseurs')->with('status', 'Famille a été créé');
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
