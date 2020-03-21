<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pourcentage;

class PourcentageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ajouter()
    {
        return view('pourcentages.ajouter');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function inserer(Request $request)
    {
        Pourcentage::create([
            'pour' => $request->input('pour'),
            'pourcentage' => $request->input('pourcentage'),
            'statut' => 'activé',
        ]);

        return redirect('voire/pourcentages')->with('status', 'Pourcentage a été créé');
    }

    public function voire()
    {
        $pourcentages = Pourcentage::all();
        return view('pourcentages.voire', ['pourcentages' => $pourcentages]);
    }

    public function desactiver($id)
    {
        $pourcentage = Pourcentage::find($id);
        $pourcentage->statut = 'desactivé';
        $pourcentage->save();

        return redirect('voire/pourcentages')->with('status', 'Pourcentage a été desactivé');
    }

    public function activer($id)
    {
        $pourcentage = Pourcentage::find($id);
        $pourcentage->statut = 'activé';
        $pourcentage->save();

        return redirect('voire/pourcentages')->with('status', 'Pourcentage a été activé');
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
