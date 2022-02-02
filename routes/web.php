<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/* Debut Produits routes */

Route::get('/etages', 'EtageController@index')->name('etages');
Route::post('/AddEtage', 'EtageController@store')->name('AddEtage');
Route::post('/AddProduit', 'ProduitController@AddProduit')->name('AddProduit');
Route::post('/SupprimerProduit/{idProduitSupprimer}', 'ProduitController@SupprimerProduit')->name('SupprimerProduit');
Route::post('/ModifierProduit/{idProduitModifier}', 'ProduitController@ModifierProduit')->name('ModifierProduit');


Route::get('/fournisseurs', 'FournisseurController@index')->name('fournisseur');
Route::post('/Addfournisseur', 'FournisseurController@Addfournisseur')->name('Addfournisseur');
Route::post('/ModifierFournisseur/{id}', 'FournisseurController@ModifierFournisseur')->name('ModifierFournisseur');
Route::post('/Supprimerfournisseur/{id}', 'FournisseurController@Supprimerfournisseur')->name('Supprimerfournisseur');




Route::get('/achats', 'FournisseurController@achats')->name('achats');
Route::post('/AddAchat', 'FournisseurController@AddAchat')->name('AddAchat');
Route::post('/Modifierachat/{id}', 'FournisseurController@Modifierachat')->name('Modifierachat');
Route::post('/Supprimerachat/{id}', 'FournisseurController@Supprimerachat')->name('Supprimerachat');

Route::get('/AchatsFournisseur/{id}', 'FournisseurController@AchatsFournisseur')->name('AchatsFournisseur');

Route::get('/MontantsFournisseur/{id}', 'FournisseurController@MontantsFournisseur')->name('MontantsFournisseur');

Route::post('/ChercherAchat', 'FournisseurController@ChercherAchat')->name('ChercherAchat');

Route::get('/getFournisseur',[EmpController::class,'getFournisseur']);
Route::get('/downloadPDF',[EmpController::class,'downloadPDF']);

Route::get('/TelechargerFournisseurCaracteristique/{idFournisseur}', 'FournisseurController@TelechargerFournisseurCaracteristique');
