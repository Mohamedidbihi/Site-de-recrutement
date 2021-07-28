<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CandidatController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DropDownRegionVilleController;
use App\Http\Controllers\Auth\RegisterEntrepriseController;
use App\Http\Controllers\DropDownSecteurMetier;

Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/AccueillEntreprise',[EntrepriseController::class , 'index'])->name('AccueillEntreprise')->middleware('entreprise');
Route::get('/PublierAnnonce',[EntrepriseController::class , 'PublierAnnonce'])->name('publierannonce')->middleware('entreprise');
Route::get('/MesAnnonces',[EntrepriseController::class , 'MesAnnonces'])->name('mesannonces')->middleware('entreprise');
Route::post('/PublierAnnonce',[EntrepriseController::class , 'store'])->middleware('entreprise');
Route::delete('/MesAnnonces/{offre}',[EntrepriseController::class,'destroy'])->name('annonce.destroy')->middleware('entreprise');
Route::get('/MesAnnonces/{id}/detail', [EntrepriseController::class,'detail'])->name('detail');


Route::get('/AccueillCandidat',[CandidatController::class , 'index'])->name('AccueillCandidat')->middleware('candidat');
Route::get('/AccueillCandidat/{offre}',[CandidatController::class,'show'])->name('Offre.infos')->middleware('candidat');
Route::post('/AccueillCandidat/{offre}/postuler',[CandidatController::class , 'postuler'])->name('Postuler')->middleware('candidat');


Route::get('/RegisterCandidat',[RegisterController::class , 'index'])->name('RegisterCandidat');
Route::post('/RegisterCandidat',[RegisterController::class , 'store']);

Route::get('/Dashboard',[AdminController::class , 'index'])->name('Dashboard')->middleware('admin');
Route::get('/Dashboard/offres',[AdminController::class , 'offres'])->middleware('admin');
Route::get('/Dashboard/offres/Ajitkhdem',[AdminController::class , 'ajitkhdem'])->name('ajitkhdem')->middleware('admin');
Route::post('/Dashboard/offres/Ajitkhdem/newoffre',[AdminController::class , 'CreateOffre'])->name('addoffre')->middleware('admin');
Route::put('/Dashboard/offres/activer/{id}',[AdminController::class , 'Activer'])->name('Activer')->middleware('admin');
Route::put('/Dashboard/offres/Refuser/{id}',[AdminController::class , 'Refuser'])->name('Refuser')->middleware('admin');
Route::put('/Dashboard/offres/En_attente/{id}',[AdminController::class , 'En_attente'])->name('En_attente')->middleware('admin');


  
Route::get('RecupVilles/{id}', [DropDownRegionVilleController::class,'getVilles']);
Route::get('RecupMetier/{id}', [DropDownSecteurMetier::class,'getMetiers']);


Route::get('/RegisterEntreprise',[RegisterEntrepriseController::class , 'index'])->name('RegisterEntreprise');
Route::post('/RegisterEntreprise',[RegisterEntrepriseController::class , 'store']);


Route::post('/logout',[LogoutController::class,'store'])->name('logout');

Route::get('/login',[LoginController::class,'index'])->name('login');
Route::post('/login',[LoginController::class,'store']);

