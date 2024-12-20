<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VisiteurController;
use App\Http\Controllers\FraisController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/visiteur/initpwds', [VisiteurController::class,"initPassword" ]);
Route::post('/visiteur/login', [VisiteurController::class, 'logIn']);
Route::get('/visiteur/logout', [VisiteurController::class, 'logOut'])->name('sécurisée');
Route::get('/visiteur/unauth', [VisiteurController::class, 'Unauthorized'])->name('login');
Route::get('/frais/{idFrais}', [FraisController::class, 'listerFrais'])->middleware('auth:sanctum');
Route::post('/frais/ajout', [FraisController::class, 'ajoutFrais'])->middleware('auth:sanctum');
Route::post('/frais/modif', [FraisController::class], 'modifFrais')->middleware('auth:sanctum');
Route::delete('/frais/suppr', [FraisController::class], 'suppFrais')->middleware('auth:sanctum');
Route::get('frais/liste/{idVisiteur}', [FraisController::class], 'listerById')->middleware('auth:sanctum');

