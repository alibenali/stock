<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/produit/{id}', 'ProduitController@voire')->name('voire.produit');
Route::get('/produits', 'ProduitController@voire_tous')->name('voire_tous.produit');
Route::get('/ajouter/produit', 'ProduitController@ajouter')->name('ajouter.produit');
Route::post('/inserer/produit', 'ProduitController@inserer')->name('inserer.produit');
Route::get('/fetch/produit', 'ProduitController@fetch')->name('fetch.produit');
Route::get('/modifier/produit/{id}', 'ProduitController@modifier')->name('modifier.produit');
Route::put('/modifier/produit/{id}', 'ProduitController@maj')->name('maj.produit');

Route::get('/voire/fournisseurs', 'FournisseurController@voire')->name('voire.fournisseurs');
Route::get('/ajouter/fournisseur', 'FournisseurController@ajouter')->name('ajouter.fournisseur');
Route::post('/inserer/fournisseur', 'FournisseurController@inserer')->name('inserer.fournisseur');

Route::get('/voire/familles', 'FamilleController@voire')->name('voire.familles');
Route::get('/ajouter/famille', 'FamilleController@ajouter')->name('ajouter.famille');
Route::post('/inserer/famille', 'FamilleController@inserer')->name('inserer.famille');
Route::post('/desactiver/famille/{id}', 'FamilleController@desactiver')->name('desactiver.famille');
Route::post('/activer/famille/{id}', 'FamilleController@activer')->name('activer.famille');

Route::get('/voire/pourcentages', 'PourcentageController@voire')->name('voire.pourcentages');
Route::get('/ajouter/pourcentage', 'PourcentageController@ajouter')->name('ajouter.pourcentage');
Route::post('/inserer/pourcentage', 'PourcentageController@inserer')->name('inserer.pourcentage');
Route::post('/desactiver/pourcentage/{id}', 'PourcentageController@desactiver')->name('desactiver.pourcentage');
Route::post('/activer/pourcentage/{id}', 'PourcentageController@activer')->name('activer.pourcentage');

Route::get('/voire/ventes/', 'VenteController@voire')->name('voire.ventes');
Route::get('/ventes/panier', 'VenteController@panier')->name('panier.ventes');
Route::get('/ajouter/vente/{produit}/{pourcentage}', 'VenteController@ajouter')->name('ajouter.vente');
Route::post('/inserer/vente/{produit}/{pourcentage}', 'VenteController@inserer')->name('inserer.vente');
Route::post('/annuler/vente/{produit}/', 'VenteController@annuler')->name('annuler.vente');
Route::post('/annuler_panier/vente/{produit}/', 'VenteController@annuler_panier')->name('annuler_panier.vente');

Route::post('/valider/vente/{id}/', 'VenteController@valider')->name('valider.vente');
Route::post('/valider_tous/vente/', 'VenteController@valider_tous')->name('valider_tous.vente');
Route::get('/ventes/bon', 'VenteController@bon')->name('bon.ventes');

Route::get('/voire/casses/', 'CasseController@voire')->name('voire.casses');
Route::get('/ajouter/casse/{produit}/', 'CasseController@ajouter')->name('ajouter.casse');
Route::post('/inserer/casse/{produit}/', 'CasseController@inserer')->name('inserer.casse');
Route::post('/annuler/casse/{produit}/', 'CasseController@annuler')->name('annuler.casse');


Route::get('/voire/achats', 'AchatController@voire')->name('voire.achats');
Route::get('/ajouter/achat', 'AchatController@ajouter')->name('ajouter.achat');
Route::post('/inserer/achat', 'AchatController@inserer')->name('inserer.achat');

Route::get('/voire/utilisateurs/', 'UtilisateurController@voire')->name('voire.utilisateurs');
Route::get('/modifier/utilisateur/{id}', 'UtilisateurController@modifier')->name('modifier.utilisateur');
Route::put('/maj/utilisateur/{id}', 'UtilisateurController@maj')->name('maj.utilisateur');


Auth::routes();

