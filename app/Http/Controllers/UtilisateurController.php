<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UtilisateurController extends Controller
{

    public function voire(){
        $users = User::all();
        return view('utilisateurs.voire', ['users' => $users]);
    }
    
    public function modifier($id){
        $user = User::find($id);
        return view('utilisateurs.modifier', ['user' => $user]);
    }

    public function maj(Request $request,$id){
        $user = User::find($id);
        $user->nom_complet = $request->input('nom_complet');
        $user->nom_utilisateur = $request->input('nom_utilisateur');
        $user->role = $request->input('role');
        $user->save();
        return redirect('voire/utilisateurs')->with('status', 'Changement a été appliqué');
    }
}
