<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BenefitController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GalleriesController;
use App\Http\Controllers\RegulationController;


// Templating
Route::get('/', [DashboardController::class, 'index']);
Route::get('/galleries', [GalleriesController::class, 'index']);
Route::get('/profile', [ProfileController::class, 'index']);
Route::get('/inbox', [ContactController::class, 'index']);
Route::get('/inbox/{id}', [ContactController::class, 'show']);
Route::get('/inbox/delete/{id}', [ContactController::class, 'destroy']);
Route::resource('/galleries',GalleriesController::class)->except('show');
Route::resource('/benefits',BenefitController::class)->except('show');
Route::resource('/regulations',RegulationController::class)->except('show');
Route::resource('/contacts',ContactController::class)->except('show'); 
Route::resource('/profile',ProfileController::class)->except('show'); 
Route::resource('/categories',CategoryController::class)->except('show'); 
Route::resource('/programs',ProgramController::class)->except('show');
